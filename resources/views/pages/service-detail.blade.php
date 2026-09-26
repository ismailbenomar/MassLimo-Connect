@extends('layouts.app')

@section('content')
    <section class="form-hero shell">
        <p class="eyebrow">Massachusetts transportation referrals</p>
        <h1>{{ $service }}</h1>
        <p class="lede">{{ $description }}</p>
        <div class="actions">
            <a class="button button-gold" href="{{ route('leads.create') }}">Request a callback</a>
            <a class="button button-outline" href="tel:{{ config('leadgen.phone_number') }}">Call (762) 436-4050</a>
        </div>
        <p class="microcopy">MassLimo Connect is an independent marketing and referral service. A provider confirms availability, pricing and reservations directly.</p>
    </section>

    <section class="section shell" aria-labelledby="trip-details-heading">
        <div class="section-heading">
            <p class="eyebrow">Prepare your request</p>
            <h2 id="trip-details-heading">Details to share with a provider.</h2>
        </div>

        <ul class="detail-list">
            @foreach ($details as $detail)
                <li>{{ $detail }}</li>
            @endforeach
        </ul>
    </section>

    <section class="section shell" aria-labelledby="planning-heading">
        <div class="section-heading">
            <p class="eyebrow">Plan the conversation</p>
            <h2 id="planning-heading">{{ $planningTitle }}</h2>
        </div>
        <div class="prose">
            @foreach ($planningCopy as $paragraph)
                <p>{{ $paragraph }}</p>
            @endforeach
        </div>

        <div class="section-heading service-questions-heading">
            <p class="eyebrow">Provider questions</p>
            <h2>What to confirm before making a reservation.</h2>
        </div>
        <ul class="detail-list">
            @foreach ($providerQuestions as $question)
                <li>{{ $question }}</li>
            @endforeach
        </ul>
    </section>

    <section class="split-section">
        <div class="split shell">
            <div>
                <p class="eyebrow">What happens next</p>
                <h2>Tell us about the trip. Speak directly with a provider.</h2>
            </div>
            <div>
                <p>After you submit a callback request, MassLimo Connect may share the trip details with an independent transportation provider serving Massachusetts.</p>
                <p>The provider handles the transportation service, schedule, vehicle selection, quote, reservation and payment. A submitted request is an inquiry and does not guarantee service.</p>
                <a class="text-link" href="{{ route('services') }}">View all transportation referral services</a>
            </div>
        </div>
    </section>

    <section class="section shell" aria-labelledby="related-services-heading">
        <div class="section-heading">
            <p class="eyebrow">Related referrals</p>
            <h2 id="related-services-heading">Plan another part of the trip.</h2>
        </div>
        <div class="service-list">
            @foreach ($relatedServices as $relatedService)
                <article>
                    <h2><a href="{{ route($relatedService['route']) }}">{{ $relatedService['label'] }}</a></h2>
                    <p>{{ $relatedService['description'] }}</p>
                </article>
            @endforeach
        </div>
    </section>
@endsection
