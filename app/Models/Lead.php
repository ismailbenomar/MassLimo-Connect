<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'full_name',
        'phone',
        'email',
        'service_type',
        'pickup_city',
        'destination',
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
}
