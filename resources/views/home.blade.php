@extends('layouts.app')

@php($transportationServices = config('transportation.services', []))

@section('content')
<section class="home-hero">
    <div class="hero-visual">
        <picture>
            <source type="image/avif" srcset="{{ asset('images/executive-sedan-480.avif') }} 480w, {{ asset('images/executive-sedan-700.avif') }} 700w, {{ asset('images/executive-sedan-1100.avif') }} 1100w, {{ asset('images/executive-sedan-1400.avif') }} 1400w" sizes="100vw">
            <img src="{{ asset('images/executive-sedan.webp') }}" srcset="{{ asset('images/executive-sedan-small.webp') }} 700w, {{ asset('images/executive-sedan.webp') }} 1400w" sizes="100vw" width="1400" height="1750" fetchpriority="high" alt="Black executive sedan beside contemporary architecture">
        </picture>
        <div class="hero-shade"></div>
        <div class="hero-content shell">
            <h1>Massachusetts limo service referrals,<br><em>made easier.</em></h1>
            <p class="hero-intro">MassLimo Connect helps you start a conversation with an independent Massachusetts limo service provider for airport, business, wedding, hourly or group travel.</p>
            <div class="hero-actions"><x-call-button location="hero" :show-number="true" /><a class="button button-light" href="{{ route('leads.create') }}">Request a callback <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><path d="M7 17 17 7M8 7h9v9" /></svg></a></div>
        </div>
        <div class="hero-index" aria-hidden="true"><span>BOS</span><span>MA</span></div>
        <p class="hero-credit">Illustrative vehicle photo: <a href="https://unsplash.com/photos/y3neNkE6efI" target="_blank" rel="noopener noreferrer">Martin Katler / Unsplash</a></p>
    </div>
    <div class="service-marquee" aria-label="Available transportation categories">
        <div>
            @foreach ($transportationServices as $service)
                <span>{{ $service['home_label'] }}</span>
                @unless ($loop->last)<i></i>@endunless
            @endforeach
        </div>
    </div>
</section>

<section class="home-intro shell">
    <h2>Luxury transportation in Massachusetts starts with the right connection.</h2>
    <div><p>If you are comparing a private car service in Massachusetts, share the route, timing, passenger count and luggage needs. MassLimo Connect may introduce you to an independent provider; you discuss availability, vehicles, pricing and reservations directly with that provider.</p><a class="arrow-link" href="{{ route('about') }}">How referrals work <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><path d="M7 17 17 7M8 7h9v9" /></svg></a></div>
</section>

<section class="services-modern shell">
    <header><h2>Choose your trip</h2><a href="{{ route('services') }}">View all services</a></header>
    <div class="service-list-modern">
        @foreach (array_slice($transportationServices, 0, 4) as $service)
            <a href="{{ route($service['route_name']) }}"><span class="service-label">{{ $service['category'] }}</span><h3>{{ $service['home_label'] }}</h3><p>{{ $service['summary'] }}</p><svg class="service-arrow" aria-hidden="true" viewBox="0 0 24 24"><path d="M7 17 17 7M8 7h9v9" /></svg></a>
        @endforeach
    </div>
</section>

<section class="process-modern"><div class="shell"><h2>From request to ride.</h2><ol><li><span>01</span><div><h3>Share your route</h3><p>Call us or send the basics through the callback form.</p></div></li><li><span>02</span><div><h3>Talk with a provider</h3><p>Discuss availability, vehicle options and pricing.</p></div></li><li><span>03</span><div><h3>Book directly</h3><p>Make your transportation arrangements with the operator.</p></div></li></ol></div></section>

<section class="coverage-modern shell">
    <div class="coverage-copy"><h2>Boston, Logan and routes across Massachusetts.</h2><p>Start with the route you have in mind. Provider availability varies by date, trip and location.</p><a class="button button-blue" href="{{ route('areas') }}">Explore service areas <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><path d="M7 17 17 7M8 7h9v9" /></svg></a></div>
    <div class="coverage-board" aria-label="Popular areas"><div><span>BOS</span><strong>Boston</strong><small>City + airport</small></div><div><span>CAM</span><strong>Cambridge</strong><small>Greater Boston</small></div><div><span>SHR</span><strong>North + South Shore</strong><small>Coastal routes</small></div><div><span>CAP</span><strong>Cape Cod</strong><small>Regional travel</small></div></div>
</section>

<section class="home-close"><div class="shell"><h2>Where are you headed?</h2><p>Start with a call or tell us about your trip.</p><div class="hero-actions"><x-call-button location="final-cta" :show-number="true" /><a class="button button-light" href="{{ route('leads.create') }}">Request a callback</a></div></div></section>
@endsection
