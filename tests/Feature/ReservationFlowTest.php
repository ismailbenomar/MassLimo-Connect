<?php

namespace Tests\Feature;

use App\Mail\NewLeadNotification;
use App\Models\TransportationSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ReservationFlowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config(['routing.geocoding_interval_milliseconds' => 0]);
    }

    public function test_visitor_can_calculate_a_route_and_submit_a_reservation_request(): void
    {
        Mail::fake();
        config(['leadgen.notification_email' => 'dispatch@example.com']);
        TransportationSetting::query()->create([
            'price_estimates_enabled' => true,
            'base_fee' => 20,
            'per_mile_rate' => 4,
            'per_minute_rate' => 1,
            'minimum_estimate' => 50,
            'maximum_distance_miles' => 300,
            'currency' => 'USD',
            'estimate_disclaimer' => 'Planning estimate only.',
        ]);

        $this->fakeRouteServices();

        $estimate = $this->postJson(route('reservations.estimate'), [
            'pickup_address' => '1 Main Street, Boston, MA',
            'destination_address' => 'Boston Logan International Airport',
        ]);

        $estimate->assertOk()
            ->assertJsonPath('distance_miles', 10)
            ->assertJsonPath('duration_minutes', 30)
            ->assertJsonPath('estimated_price', 90)
            ->assertJsonStructure(['estimate_token', 'geometry', 'origin', 'destination']);

        $response = $this->post(route('reservations.store'), [
            'estimate_token' => $estimate->json('estimate_token'),
            'pickup_address' => '1 Main Street, Boston, MA',
            'destination_address' => 'Boston Logan International Airport',
            'service_type' => 'Airport transportation',
            'passengers' => 2,
            'preferred_trip_date' => now()->addWeek()->toDateString(),
            'preferred_trip_time' => '09:30',
            'full_name' => 'Jordan Lee',
            'phone' => '+1 617 555 0100',
            'email' => 'jordan@example.com',
            'details' => 'Two checked bags.',
            'consent' => '1',
            'website' => '',
        ]);

        $response->assertRedirect(route('reservations.thanks'));
        $this->assertDatabaseHas('leads', [
            'request_type' => 'reservation',
            'full_name' => 'Jordan Lee',
            'estimated_distance_miles' => 10,
            'estimated_duration_minutes' => 30,
            'estimated_price' => 90,
        ]);
        Mail::assertSent(NewLeadNotification::class);
    }

    public function test_price_is_hidden_until_an_admin_enables_and_configures_it(): void
    {
        $this->fakeRouteServices();

        $this->postJson(route('reservations.estimate'), [
            'pickup_address' => '1 Main Street, Boston, MA',
            'destination_address' => 'Boston Logan International Airport',
        ])->assertOk()->assertJsonPath('estimated_price', null);

        $admin = User::factory()->create();
        $this->actingAs($admin)->put(route('admin.settings.update'), [
            'price_estimates_enabled' => '1',
            'base_fee' => '25',
            'per_mile_rate' => '5',
            'per_minute_rate' => '0.50',
            'minimum_estimate' => '75',
            'maximum_distance_miles' => '250',
            'currency' => 'USD',
            'estimate_disclaimer' => 'A provider confirms the final quote.',
        ])->assertRedirect(route('admin.settings.edit'));

        $this->assertDatabaseHas('transportation_settings', [
            'price_estimates_enabled' => true,
            'per_mile_rate' => 5,
            'maximum_distance_miles' => 250,
        ]);
    }

    public function test_reservation_requires_an_untampered_route_estimate(): void
    {
        $this->from(route('reservations.create'))->post(route('reservations.store'), [
            'estimate_token' => 'invalid-token',
            'pickup_address' => 'Boston, MA',
            'destination_address' => 'Cambridge, MA',
            'service_type' => 'Airport transportation',
            'passengers' => 1,
            'preferred_trip_date' => now()->addDay()->toDateString(),
            'preferred_trip_time' => '10:00',
            'full_name' => 'Jordan Lee',
            'phone' => '617-555-0100',
            'consent' => '1',
            'website' => '',
        ])->assertRedirect(route('reservations.create'))->assertSessionHasErrors('estimate_token');
    }

    private function fakeRouteServices(): void
    {
        Http::fakeSequence()
            ->push([['display_name' => '1 Main Street, Boston, MA', 'lat' => '42.3601', 'lon' => '-71.0589']])
            ->push([['display_name' => 'Boston Logan International Airport', 'lat' => '42.3656', 'lon' => '-71.0096']])
            ->push(['routes' => [[
                'distance' => 16093.4,
                'duration' => 1800,
                'geometry' => ['coordinates' => [[-71.0589, 42.3601], [-71.0096, 42.3656]]],
            ]]]);
    }
}
