@extends('layouts.app')

@php($transportationServices = config('transportation.services', []))

@section('content')
    <section class="form-hero shell">
        <p class="eyebrow">Transportation referrals</p>
        <h1>Boston limo service referrals for the trip you are planning.</h1>
        <p class="lede">If you are looking for a Boston limo service, luxury car service in Boston or private chauffeur in Boston, MassLimo Connect can introduce you to an independent transportation provider. The provider confirms availability, vehicle options, pricing and any reservation directly with you.</p>
        <div class="actions">
            <a class="button button-gold" href="{{ route('leads.create') }}">Request a callback</a>
            <a class="button button-outline" href="tel:{{ config('leadgen.phone_number') }}">Call (762) 436-4050</a>
        </div>
    </section>

    <section class="section shell" aria-labelledby="service-options-heading">
        <div class="section-heading">
            <p class="eyebrow">Trip types</p>
            <h2 id="service-options-heading">Choose a Boston transportation referral by trip type.</h2>
        </div>

        <div class="service-list">
            @foreach ($transportationServices as $service)
                <article>
                    <h2><a href="{{ route($service['route_name']) }}">{{ $service['service'] }}</a></h2>
                    <p>{{ $service['summary'] }}</p>
                </article>
            @endforeach
        </div>
    </section>

    <section class="split-section">
        <div class="split shell">
            <div>
                <p class="eyebrow">How it works</p>
                <h2>A direct introduction, followed by a direct provider conversation.</h2>
            </div>
            <div>
                <p>MassLimo Connect is an independent marketing and referral service. We pass your trip request to an independent transportation provider that may be able to help.</p>
                <p>The provider is responsible for transportation, availability, vehicles, pricing, reservations and payment. Sending a request does not create a reservation.</p>
            </div>
        </div>
    </section>
@endsection
