<?php

return [
    'geocoding_url' => env('GEOCODING_URL', 'https://nominatim.openstreetmap.org/search'),
    'directions_url' => env('DIRECTIONS_URL', 'https://router.project-osrm.org/route/v1/driving'),
    'user_agent' => env('MAP_USER_AGENT', 'MassLimoConnect/1.0 (+'.env('APP_URL', 'http://localhost').')'),
    'cache_days' => (int) env('ROUTE_CACHE_DAYS', 30),
    'geocoding_interval_milliseconds' => (int) env('GEOCODING_INTERVAL_MILLISECONDS', 1100),
];
