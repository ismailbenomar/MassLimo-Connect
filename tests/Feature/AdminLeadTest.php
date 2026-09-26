<?php

namespace Tests\Feature;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminLeadTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_cannot_access_leads(): void
    {
        $this->get(route('admin.leads.index'))->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_update_lead_status(): void
    {
        $user = User::factory()->create(['password' => Hash::make('password')]);
        $lead = Lead::create([
            'full_name' => 'Avery Stone',
            'phone' => '6175550123',
            'service_type' => 'Logan Airport transfer',
            'pickup_city' => 'Boston',
            'destination' => 'Logan Airport',
        ]);

        $this->actingAs($user)->patch(route('admin.leads.update', $lead), [
            'status' => 'contacted',
            'internal_notes' => 'Spoke with customer.',
        ])->assertNoContent();

        $this->assertDatabaseHas('leads', ['id' => $lead->id, 'status' => 'contacted']);
    }
}
