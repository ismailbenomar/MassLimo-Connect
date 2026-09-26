<?php

namespace Tests\Feature;

use App\Mail\NewLeadNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class LeadCaptureTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_uses_the_configured_phone_number(): void
    {
        config(['leadgen.phone_number' => '+16175550123']);

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('tel:+16175550123')
            ->assertSee('(617) 555-0123');
    }

    public function test_callback_requires_consent(): void
    {
        $this->from(route('leads.create'))
            ->post(route('leads.store'), [
                'full_name' => 'Jordan Lee',
                'phone' => '6175550123',
                'service_type' => 'Corporate transportation',
                'pickup_city' => 'Boston',
                'destination' => 'Cambridge',
            ])
            ->assertRedirect(route('leads.create'))
            ->assertSessionHasErrors('consent');
    }

    public function test_callback_errors_identify_fields_and_preserve_optional_trip_details(): void
    {
        $this->followingRedirects()
            ->from(route('leads.create'))
            ->post(route('leads.store'), [
                'full_name' => '',
                'phone' => '6175550123',
                'service_type' => 'Corporate transportation',
                'pickup_city' => 'Boston',
                'destination' => 'Cambridge',
                'preferred_trip_time' => 'After 5 PM',
                'consent' => '1',
            ])
            ->assertOk()
            ->assertSee('href="#full_name"', false)
            ->assertSee('id="full_name-error"', false)
            ->assertSee('aria-invalid="true"', false)
            ->assertSee('After 5 PM');
    }

    public function test_valid_callback_is_stored_and_notified(): void
    {
        Mail::fake();
        config(['leadgen.notification_email' => 'leads@example.com']);

        $this->post(route('leads.store'), [
            'full_name' => 'Jordan Lee',
            'phone' => '6175550123',
            'email' => 'jordan@example.com',
            'service_type' => 'Corporate transportation',
            'pickup_city' => 'Boston',
            'destination' => 'Cambridge',
            'preferred_trip_date' => '2026-10-01',
            'passengers' => 2,
            'consent' => '1',
        ])->assertRedirect(route('leads.thanks'));

        $this->assertDatabaseHas('leads', [
            'full_name' => 'Jordan Lee',
            'status' => 'new',
            'pickup_city' => 'Boston',
        ]);

        Mail::assertSent(NewLeadNotification::class);
    }
}
