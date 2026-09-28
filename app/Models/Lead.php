<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'full_name',
        'request_type',
        'phone',
        'email',
        'service_type',
        'pickup_city',
        'destination',
        'estimated_distance_miles',
        'estimated_duration_minutes',
        'estimated_price',
        'pricing_currency',
        'route_data',
        'pricing_snapshot',
        'preferred_trip_date',
        'preferred_trip_time',
        'passengers',
        'details',
        'status',
        'source_page',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'internal_notes',
    ];

    protected function casts(): array
    {
        return [
            'preferred_trip_date' => 'date',
            'estimated_distance_miles' => 'decimal:1',
            'estimated_price' => 'decimal:2',
            'route_data' => 'array',
            'pricing_snapshot' => 'array',
        ];
    }
}
