@extends('layouts.app')

@section('content')
<section class="reservation-hero shell">
    <div>
        <h1>Plan the route before requesting the ride.</h1>
        <p>Enter the pickup and destination to calculate estimated driving mileage and time. Then send the trip for a callback from an independent transportation provider.</p>
    </div>
    <div class="reservation-step-list" aria-label="Reservation request steps">
        <span><b>1</b> Map the route</span>
        <span><b>2</b> Add trip details</span>
        <span><b>3</b> Request confirmation</span>
    </div>
</section>

<section class="reservation-shell shell" data-reservation-planner data-estimate-url="{{ route('reservations.estimate') }}">
    <div class="reservation-workspace">
        <form method="POST" action="{{ route('reservations.store') }}" class="reservation-form" data-reservation-form>
            @csrf
            @if ($errors->any())
                <div class="form-errors" role="alert">
                    <strong>Please review the request:</strong>
                    <ul>@foreach ($errors->all() as $message)<li>{{ $message }}</li>@endforeach</ul>
                </div>
            @endif

            <input type="hidden" name="estimate_token" value="" data-estimate-token>
            <div class="honeypot"><label for="website">Website</label><input id="website" name="website" tabindex="-1" autocomplete="off"></div>

            <fieldset class="reservation-group route-entry">
                <legend>Where is the trip?</legend>
                <label for="pickup_address">Pickup address</label>
                <input id="pickup_address" name="pickup_address" value="{{ old('pickup_address') }}" placeholder="Street address, city and state" autocomplete="street-address" required data-route-input>
                <label for="destination_address">Destination</label>
                <input id="destination_address" name="destination_address" value="{{ old('destination_address') }}" placeholder="Street address, airport or venue" required data-route-input>
                <button class="button button-blue route-button" type="button" data-estimate-button>
                    <span data-estimate-button-label>Calculate mileage and time</span>
                </button>
                <p class="route-error" role="alert" hidden data-route-error></p>
                <noscript><p class="route-error">Route calculation requires JavaScript. You can still <a href="{{ route('leads.create') }}">request a callback</a>.</p></noscript>
            </fieldset>

            <div class="reservation-details" data-reservation-details aria-disabled="true" inert>
                <fieldset class="reservation-group">
                    <legend>Trip details</legend>
                    <div class="reservation-grid">
                        <label for="service_type">Service type<select id="service_type" name="service_type" required><option value="">Choose one</option>@foreach ($services as $service)<option value="{{ $service['service'] }}" @selected(old('service_type') === $service['service'])>{{ $service['home_label'] }}</option>@endforeach</select></label>
                        <label for="passengers">Passengers<input id="passengers" type="number" min="1" max="99" name="passengers" value="{{ old('passengers', 1) }}" required></label>
                        <label for="preferred_trip_date">Trip date<input id="preferred_trip_date" type="date" min="{{ now()->toDateString() }}" name="preferred_trip_date" value="{{ old('preferred_trip_date') }}" required></label>
                        <label for="preferred_trip_time">Pickup time<input id="preferred_trip_time" type="time" name="preferred_trip_time" value="{{ old('preferred_trip_time') }}" required></label>
                    </div>
                </fieldset>

                <fieldset class="reservation-group">
                    <legend>How should the provider reach you?</legend>
                    <div class="reservation-grid">
                        <label for="full_name">Full name<input id="full_name" name="full_name" value="{{ old('full_name') }}" autocomplete="name" required></label>
                        <label for="phone">Telephone number<input id="phone" type="tel" name="phone" value="{{ old('phone') }}" autocomplete="tel" required></label>
                        <label for="email">Email address <span>Optional</span><input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="email"></label>
                    </div>
                    <label for="details">Notes for the provider <span>Optional</span><textarea id="details" name="details" rows="4" placeholder="Flight, luggage, stops, accessibility or vehicle questions">{{ old('details') }}</textarea></label>
                </fieldset>

                <label class="consent" for="reservation_consent"><input id="reservation_consent" type="checkbox" name="consent" value="1" required @checked(old('consent'))> I request telephone contact about this trip. I understand this is a reservation inquiry; an independent provider confirms availability, final pricing and reservation terms.</label>
                <button class="button button-blue reservation-submit" type="submit" disabled data-reservation-submit>Request reservation callback</button>
            </div>
        </form>

        <aside class="route-panel" aria-live="polite">
            <div class="route-map" data-route-map>
                <iframe title="Trip route map" loading="lazy" referrerpolicy="origin" hidden data-route-map-frame></iframe>
                <svg viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true" hidden data-route-line><polyline points="" /></svg>
                <div class="map-empty" data-map-empty><span>MA</span><strong>Your route will appear here.</strong><small>Enter complete pickup and destination addresses.</small></div>
            </div>
            <div class="route-summary" hidden data-route-summary>
                <div><span>Distance</span><strong data-route-distance>—</strong></div>
                <div><span>Driving time</span><strong data-route-duration>—</strong></div>
                <div><span>Planning estimate</span><strong data-route-price>Provider quote</strong></div>
                <p data-route-disclaimer>{{ $settings->estimate_disclaimer }}</p>
            </div>
            <p class="map-attribution">Map data © <a href="https://www.openstreetmap.org/copyright" target="_blank" rel="noopener noreferrer">OpenStreetMap contributors</a>. Route calculation is for planning only.</p>
            <div class="callback-option">
                <strong>Prefer to talk first?</strong>
                <p>Send a shorter callback request without calculating a route.</p>
                <a class="text-link" href="{{ route('leads.create') }}">Request a callback</a>
            </div>
        </aside>
    </div>
</section>
@endsection
