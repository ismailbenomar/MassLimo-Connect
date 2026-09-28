<?php

$transportation = require __DIR__.'/transportation.php';
$servicePages = [];

foreach ($transportation['services'] as $service) {
    $servicePages[$service['route_name']] = [
        'label' => $service['label'],
        'parent' => 'services',
        'title' => $service['seo_title'],
        'description' => $service['seo_description'],
    ];
}

return [
    'site_name' => $transportation['business']['name'],
    'default_title' => 'Massachusetts Limo Service Referrals | MassLimo Connect',
    'default_description' => 'Connect with independent Massachusetts limo, private car and chauffeur providers for airport, corporate, wedding, hourly and group transportation.',
    'area_served' => $transportation['business']['area_served'],
    'language' => $transportation['business']['language'],
    'pages' => [
        'home' => [
            'label' => 'Home',
            'title' => 'Massachusetts Limo Service Referrals | MassLimo Connect',
            'description' => 'Explore Massachusetts limo service referrals for airport, corporate, wedding, hourly and group trips with independent transportation providers.',
        ],
        'services' => [
            'label' => 'Services',
            'title' => 'Boston Limo Service Referrals | MassLimo Connect',
            'description' => 'Find Boston limo service referrals for Logan Airport, corporate travel, weddings, hourly chauffeur service and group transportation.',
        ],
        ...$servicePages,
        'areas' => [
            'label' => 'Service areas',
            'title' => 'Massachusetts Limousine Service Areas',
            'description' => 'Explore referral coverage for Boston, Logan Airport, Cambridge, Worcester, the North Shore, South Shore, Cape Cod and nearby communities.',
        ],
        'about' => [
            'label' => 'About',
            'title' => 'About Our Massachusetts Transportation Referral Service',
            'description' => 'Learn how MassLimo Connect helps Massachusetts travelers start direct conversations with independent transportation operators.',
        ],
        'contact' => [
            'label' => 'Contact',
            'title' => 'Contact MassLimo Connect',
            'description' => 'Call (762) 436-4050 or request a callback about airport, corporate, wedding, hourly or group transportation in Massachusetts.',
        ],
        'leads.create' => [
            'label' => 'Request a callback',
            'title' => 'Request a Transportation Callback | MassLimo Connect',
            'description' => 'Share your Massachusetts trip details and request a telephone conversation with an independent transportation provider.',
        ],
        'reservations.create' => [
            'label' => 'Reserve online',
            'title' => 'Request a Transportation Reservation | MassLimo Connect',
            'description' => 'Enter pickup and destination addresses to review estimated mileage and travel time, then request a reservation callback.',
        ],
        'privacy' => [
            'label' => 'Privacy policy',
            'title' => 'Privacy Policy | MassLimo Connect',
            'description' => 'Read how MassLimo Connect uses information submitted with a transportation callback request.',
        ],
        'terms' => [
            'label' => 'Terms',
            'title' => 'Terms & Referral Disclosure | MassLimo Connect',
            'description' => 'Read the MassLimo Connect terms and disclosure about independent third-party transportation providers.',
        ],
    ],
    'noindex_routes' => [
        'leads.thanks',
        'reservations.thanks',
        'login',
        'admin.*',
    ],
];
