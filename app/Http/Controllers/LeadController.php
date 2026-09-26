<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeadRequest;
use App\Mail\NewLeadNotification;
use App\Models\Lead;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class LeadController extends Controller
{
    public function create(): View
    {
        return view('leads.create');
    }

    public function store(StoreLeadRequest $request): RedirectResponse
    {
        $lead = Lead::create([
            ...$request->safe()->except(['consent', 'website']),
            'source_page' => url()->previous(),
            'utm_source' => $request->string('utm_source')->toString() ?: null,
            'utm_medium' => $request->string('utm_medium')->toString() ?: null,
            'utm_campaign' => $request->string('utm_campaign')->toString() ?: null,
        ]);

        $notificationEmail = config('leadgen.notification_email');

        if (is_string($notificationEmail) && filter_var($notificationEmail, FILTER_VALIDATE_EMAIL)) {
            Mail::to($notificationEmail)->send(new NewLeadNotification($lead));
        }

        return to_route('leads.thanks');
    }

    public function thanks(): View
    {
        return view('leads.thanks');
    }
}
