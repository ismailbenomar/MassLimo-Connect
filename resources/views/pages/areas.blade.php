@extends('layouts.app')

@section('content')
    <section class="form-hero shell">
        <p class="eyebrow">Service areas</p>
        <h1>Transportation referrals across Massachusetts.</h1>
        <p class="lede">MassLimo Connect helps travelers start a conversation with independent providers serving Boston, Logan Airport, Greater Boston and destinations across Massachusetts.</p>
        <div class="actions">
            <a class="button button-gold" href="{{ route('leads.create') }}">Request a callback</a>
            <a class="button button-outline" href="tel:{{ config('leadgen.phone_number') }}">Call (762) 436-4050</a>
        </div>
    </section>

    <section class="section shell" aria-labelledby="coverage-heading">
        <div class="section-heading">
            <p class="eyebrow">Referral coverage</p>
            <h2 id="coverage-heading">Tell us where the trip begins and ends.</h2>
        </div>
        <div class="area-columns">
            <div>
                <h2>Boston and Greater Boston</h2>
                <p>Boston · Boston Logan International Airport · Cambridge · Somerville · Brookline · Newton · Quincy · Revere · Waltham · Lexington · Burlington</p>
            </div>
            <div>
                <h2>Wider Massachusetts</h2>
                <p>Medford · Everett · Chelsea · Dedham · Braintree · Framingham · Worcester · North Shore · South Shore · Cape Cod</p>
            </div>
        </div>
    </section>

    <section class="section shell faq" aria-labelledby="area-questions-heading">
        <h2 id="area-questions-heading">Common service-area questions</h2>
        <details>
            <summary>Can I request a trip outside Boston?</summary>
            <p>Yes. Referral requests can include pickup or destination points elsewhere in Massachusetts. Availability depends on the date, route and independent provider.</p>
        </details>
        <details>
            <summary>Can a provider handle a Boston Logan Airport trip?</summary>
            <p>You can request a connection for travel to or from Boston Logan International Airport. Share the airline, flight, terminal, pickup location, passenger count and luggage needs.</p>
        </details>
        <details>
            <summary>Does submitting a service-area request confirm a reservation?</summary>
            <p>No. MassLimo Connect sends an inquiry for referral. An independent provider confirms coverage, availability, pricing and any reservation directly with you.</p>
        </details>
    </section>
@endsection
