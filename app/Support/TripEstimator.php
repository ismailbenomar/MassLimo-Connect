<?php

namespace App\Support;

use App\Models\TransportationSetting;

class TripEstimator
{
    /** @return array{distance_miles: float, duration_minutes: int, estimated_price: ?float, currency: string, pricing_snapshot: array<string, mixed>} */
    public function calculate(float $distanceMeters, float $durationSeconds, TransportationSetting $settings): array
    {
        $distanceMiles = round($distanceMeters / 1609.344, 1);
        $durationMinutes = (int) ceil($durationSeconds / 60);
        $estimatedPrice = null;

        if ($settings->price_estimates_enabled) {
            $calculatedPrice = (float) $settings->base_fee
                + ($distanceMiles * (float) $settings->per_mile_rate)
                + ($durationMinutes * (float) $settings->per_minute_rate);
            $estimatedPrice = round(max($calculatedPrice, (float) $settings->minimum_estimate), 2);
        }

        return [
            'distance_miles' => $distanceMiles,
            'duration_minutes' => $durationMinutes,
            'estimated_price' => $estimatedPrice,
            'currency' => $settings->currency,
            'pricing_snapshot' => [
                'price_estimates_enabled' => $settings->price_estimates_enabled,
                'base_fee' => (float) $settings->base_fee,
                'per_mile_rate' => (float) $settings->per_mile_rate,
                'per_minute_rate' => (float) $settings->per_minute_rate,
                'minimum_estimate' => (float) $settings->minimum_estimate,
                'disclaimer' => $settings->estimate_disclaimer,
            ],
        ];
    }
}
