@extends('layouts.app')

@section('content')
<section class="form-hero shell">
    <div class="admin-top"><h1>Trip estimate settings.</h1><a class="button button-outline" href="{{ route('admin.leads.index') }}">View requests</a></div>
    <p class="lede">Control the planning formula shown before a visitor submits a reservation request. These values do not replace a provider’s final quote.</p>
</section>
<section class="section shell">
    @if (session('status'))<p class="settings-saved" role="status">{{ session('status') }}</p>@endif
    <form method="POST" action="{{ route('admin.settings.update') }}" class="lead-form settings-form">
        @csrf @method('PUT')
        <label class="settings-toggle"><input type="checkbox" name="price_estimates_enabled" value="1" @checked(old('price_estimates_enabled', $settings->price_estimates_enabled))> Show calculated price estimates to visitors</label>
        <div class="reservation-grid">
            <label>Base charge<input type="number" name="base_fee" step="0.01" min="0" value="{{ old('base_fee', $settings->base_fee) }}" required></label>
            <label>Rate per mile<input type="number" name="per_mile_rate" step="0.01" min="0" value="{{ old('per_mile_rate', $settings->per_mile_rate) }}" required></label>
            <label>Rate per minute<input type="number" name="per_minute_rate" step="0.01" min="0" value="{{ old('per_minute_rate', $settings->per_minute_rate) }}" required></label>
            <label>Minimum estimate<input type="number" name="minimum_estimate" step="0.01" min="0" value="{{ old('minimum_estimate', $settings->minimum_estimate) }}" required></label>
            <label>Online distance limit<input type="number" name="maximum_distance_miles" min="1" max="1000" value="{{ old('maximum_distance_miles', $settings->maximum_distance_miles) }}" required><span>Miles</span></label>
            <label>Currency<select name="currency" required><option value="USD" selected>USD</option></select></label>
        </div>
        <label>Estimate disclosure<textarea name="estimate_disclaimer" rows="4" required>{{ old('estimate_disclaimer', $settings->estimate_disclaimer) }}</textarea></label>
        @if ($errors->any())<div class="form-errors" role="alert"><ul>@foreach ($errors->all() as $message)<li>{{ $message }}</li>@endforeach</ul></div>@endif
        <button class="button button-blue" type="submit">Save estimate settings</button>
    </form>
</section>
@endsection
