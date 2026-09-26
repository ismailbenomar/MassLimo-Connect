@extends('layouts.app')

@section('content')
<section class="form-hero shell">
    <h1>Request a call about your trip.</h1>
    <p class="lede">Tell us where you need to go and how to reach you. We record your request so an independent transportation provider can discuss options with you. For a conversation now, use the call button on this page.</p>
</section>
<section class="form-section shell">
    <form method="POST" action="{{ route('leads.store') }}" class="lead-form">
        @csrf
        @if ($errors->any())
            <div class="form-errors" id="form-errors" role="alert" tabindex="-1">
                <strong>Please correct these fields:</strong>
                <ul>
                    @foreach (['full_name', 'phone', 'email', 'service_type', 'pickup_city', 'destination', 'preferred_trip_date', 'preferred_trip_time', 'passengers', 'details', 'consent'] as $field)
                        @error($field)<li><a href="#{{ $field }}">{{ $message }}</a></li>@enderror
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="honeypot"><label for="website">Website</label><input id="website" name="website" tabindex="-1" autocomplete="off"></div>

        <fieldset class="form-group">
            <legend>Your contact details</legend>
            <p>We need a phone number so a provider can discuss your request with you.</p>
            <div class="form-grid">
                <label for="full_name">Full name</label>
                <div class="field-control"><input id="full_name" name="full_name" value="{{ old('full_name') }}" required autocomplete="name" @error('full_name') aria-invalid="true" aria-describedby="full_name-error" @enderror>@error('full_name')<span class="field-error" id="full_name-error">{{ $message }}</span>@enderror</div>

                <label for="phone">Telephone number</label>
                <div class="field-control"><input id="phone" type="tel" name="phone" value="{{ old('phone') }}" required autocomplete="tel" @error('phone') aria-invalid="true" aria-describedby="phone-error" @enderror>@error('phone')<span class="field-error" id="phone-error">{{ $message }}</span>@enderror</div>

                <label for="email">Email address <span>(optional)</span></label>
                <div class="field-control"><input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="email" @error('email') aria-invalid="true" aria-describedby="email-error" @enderror>@error('email')<span class="field-error" id="email-error">{{ $message }}</span>@enderror</div>
            </div>
        </fieldset>

        <fieldset class="form-group">
            <legend>Your trip</legend>
            <div class="form-grid">
                <label for="service_type">Service type</label>
                <div class="field-control"><select id="service_type" name="service_type" required @error('service_type') aria-invalid="true" aria-describedby="service_type-error" @enderror><option value="">Choose one</option>@foreach (['Logan Airport transfer','Corporate transportation','Wedding or event','Hourly chauffeur','Luxury city trip','Group transportation','Other'] as $service)<option @selected(old('service_type') === $service)>{{ $service }}</option>@endforeach</select>@error('service_type')<span class="field-error" id="service_type-error">{{ $message }}</span>@enderror</div>

                <label for="pickup_city">Pickup city</label>
                <div class="field-control"><input id="pickup_city" name="pickup_city" value="{{ old('pickup_city') }}" required autocomplete="address-level2" @error('pickup_city') aria-invalid="true" aria-describedby="pickup_city-error" @enderror>@error('pickup_city')<span class="field-error" id="pickup_city-error">{{ $message }}</span>@enderror</div>

                <label for="destination">Destination</label>
                <div class="field-control"><input id="destination" name="destination" value="{{ old('destination') }}" required @error('destination') aria-invalid="true" aria-describedby="destination-error" @enderror>@error('destination')<span class="field-error" id="destination-error">{{ $message }}</span>@enderror</div>
            </div>
            <details class="trip-extras" @if (old('preferred_trip_date') || old('preferred_trip_time') || old('passengers') || old('details') || $errors->hasAny(['preferred_trip_date', 'preferred_trip_time', 'passengers', 'details'])) open @endif>
                <summary>Add timing, passengers or other details <span>(optional)</span></summary>
                <div class="form-grid">
                    <label for="preferred_trip_date">Preferred trip date <span>(optional)</span></label>
                    <div class="field-control"><input id="preferred_trip_date" type="date" name="preferred_trip_date" value="{{ old('preferred_trip_date') }}" @error('preferred_trip_date') aria-invalid="true" aria-describedby="preferred_trip_date-error" @enderror>@error('preferred_trip_date')<span class="field-error" id="preferred_trip_date-error">{{ $message }}</span>@enderror</div>

                    <label for="preferred_trip_time">Preferred trip time <span>(optional)</span></label>
                    <div class="field-control"><input id="preferred_trip_time" name="preferred_trip_time" value="{{ old('preferred_trip_time') }}" placeholder="Morning, 3:00 PM, flexible" @error('preferred_trip_time') aria-invalid="true" aria-describedby="preferred_trip_time-error" @enderror>@error('preferred_trip_time')<span class="field-error" id="preferred_trip_time-error">{{ $message }}</span>@enderror</div>

                    <label for="passengers">Passengers <span>(optional)</span></label>
                    <div class="field-control"><input id="passengers" type="number" min="1" max="99" name="passengers" value="{{ old('passengers') }}" @error('passengers') aria-invalid="true" aria-describedby="passengers-error" @enderror>@error('passengers')<span class="field-error" id="passengers-error">{{ $message }}</span>@enderror</div>

                    <label for="details">Additional details <span>(optional)</span></label>
                    <div class="field-control"><textarea id="details" name="details" rows="4" @error('details') aria-invalid="true" aria-describedby="details-error" @enderror>{{ old('details') }}</textarea>@error('details')<span class="field-error" id="details-error">{{ $message }}</span>@enderror</div>
                </div>
            </details>
        </fieldset>

        <div class="consent-field">
            <label class="consent" for="consent"><input id="consent" type="checkbox" name="consent" value="1" required @checked(old('consent')) @error('consent') aria-invalid="true" aria-describedby="consent-error" @enderror> I am requesting telephone contact about this transportation request. I understand that transportation services and pricing are provided by an independent operator.</label>
            @error('consent')<span class="field-error" id="consent-error">{{ $message }}</span>@enderror
        </div>
        <button class="button button-gold" type="submit">Send callback request <span aria-hidden="true">→</span></button>
    </form>
</section>
@endsection
