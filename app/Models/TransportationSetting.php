<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransportationSetting extends Model
{
    protected $fillable = [
        'price_estimates_enabled',
        'base_fee',
        'per_mile_rate',
        'per_minute_rate',
        'minimum_estimate',
        'maximum_distance_miles',
        'currency',
        'estimate_disclaimer',
    ];

    public static function current(): self
    {
        return self::query()->first() ?? new self([
            'price_estimates_enabled' => false,
            'base_fee' => 0,
            'per_mile_rate' => 0,
            'per_minute_rate' => 0,
            'minimum_estimate' => 0,
            'maximum_distance_miles' => 300,
            'currency' => 'USD',
            'estimate_disclaimer' => 'This planning estimate is not a quote or confirmed reservation. An independent provider confirms availability, final pricing and reservation terms directly.',
        ]);
    }

    protected function casts(): array
    {
        return [
            'price_estimates_enabled' => 'boolean',
            'base_fee' => 'decimal:2',
            'per_mile_rate' => 'decimal:2',
            'per_minute_rate' => 'decimal:2',
            'minimum_estimate' => 'decimal:2',
            'maximum_distance_miles' => 'integer',
        ];
    }
}
