<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstimateTripRequest;
use App\Http\Requests\StoreReservationRequest;
use App\Mail\NewLeadNotification;
use App\Models\Lead;
use App\Models\TransportationSetting;
use App\Support\RoutePlanner;
use App\Support\TripEstimator;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use RuntimeException;

class ReservationController extends Controller
{
    public function create(): View
    {
        return view('reservations.create', [
            'services' => config('transportation.services', []),
            'settings' => TransportationSetting::current(),
        ]);
    }

    public function estimate(EstimateTripRequest $request, RoutePlanner $routePlanner, TripEstimator $tripEstimator): JsonResponse
    {
        try {
            $route = $routePlanner->plan($request->string('pickup_address')->toString(), $request->string('destination_address')->toString());
        } catch (RuntimeException $exception) {
            return response()->json(['message' => $exception->getMessage()], 422);
        }

        $settings = TransportationSetting::current();
        $estimate = $tripEstimator->calculate($route['distance_meters'], $route['duration_seconds'], $settings);

        if ($estimate['distance_miles'] > $settings->maximum_distance_miles) {
            return response()->json([
                'message' => "This route is beyond the current {$settings->maximum_distance_miles}-mile online request limit. Please request a callback instead.",
            ], 422);
        }

        $payload = [
            'pickup_address' => $request->string('pickup_address')->toString(),
            'destination_address' => $request->string('destination_address')->toString(),
            'route' => $route,
            'estimate' => $estimate,
            'expires_at' => now()->addMinutes(30)->timestamp,
        ];

        return response()->json([
            ...$estimate,
            'origin' => $route['origin'],
            'destination' => $route['destination'],
            'geometry' => $route['geometry'],
            'disclaimer' => $settings->estimate_disclaimer,
            'estimate_token' => Crypt::encryptString(json_encode($payload, JSON_THROW_ON_ERROR)),
        ]);
    }

    public function store(StoreReservationRequest $request): RedirectResponse
    {
        try {
            $payload = json_decode(Crypt::decryptString($request->string('estimate_token')->toString()), true, flags: JSON_THROW_ON_ERROR);
        } catch (DecryptException|\JsonException) {
            return back()->withInput()->withErrors(['estimate_token' => 'The route estimate expired or is invalid. Please calculate the route again.']);
        }

        if (($payload['expires_at'] ?? 0) < now()->timestamp
            || ($payload['pickup_address'] ?? '') !== $request->string('pickup_address')->toString()
            || ($payload['destination_address'] ?? '') !== $request->string('destination_address')->toString()) {
            return back()->withInput()->withErrors(['estimate_token' => 'The addresses changed or the estimate expired. Please calculate the route again.']);
        }

        $estimate = $payload['estimate'];
        $route = $payload['route'];
        $lead = Lead::create([
            'request_type' => 'reservation',
            'full_name' => $request->string('full_name')->toString(),
            'phone' => $request->string('phone')->toString(),
            'email' => $request->string('email')->toString() ?: null,
            'service_type' => $request->string('service_type')->toString(),
            'pickup_city' => $request->string('pickup_address')->toString(),
            'destination' => $request->string('destination_address')->toString(),
            'preferred_trip_date' => $request->date('preferred_trip_date'),
            'preferred_trip_time' => $request->string('preferred_trip_time')->toString(),
            'passengers' => $request->integer('passengers'),
            'details' => $request->string('details')->toString() ?: null,
            'estimated_distance_miles' => $estimate['distance_miles'],
            'estimated_duration_minutes' => $estimate['duration_minutes'],
            'estimated_price' => $estimate['estimated_price'],
            'pricing_currency' => $estimate['currency'],
            'route_data' => $route,
            'pricing_snapshot' => $estimate['pricing_snapshot'],
            'source_page' => route('reservations.create'),
        ]);

        $notificationEmail = config('leadgen.notification_email');

        if (is_string($notificationEmail) && filter_var($notificationEmail, FILTER_VALIDATE_EMAIL)) {
            Mail::to($notificationEmail)->send(new NewLeadNotification($lead));
        }

        return to_route('reservations.thanks');
    }

    public function thanks(): View
    {
        return view('reservations.thanks');
    }
}
