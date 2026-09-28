@extends('layouts.app')

@section('content')
<section class="form-hero shell"><a class="text-link" href="{{ route('admin.leads.index') }}">← Back to requests</a><p class="eyebrow" style="margin-top:2rem">{{ ucfirst($lead->request_type) }} request</p><h1>{{ $lead->full_name }}</h1><p class="lede">{{ $lead->phone }} @if ($lead->email) · {{ $lead->email }} @endif</p></section>
<section class="section shell">
    @if (session('status'))<p class="settings-saved" role="status">{{ session('status') }}</p>@endif
    <div class="lead-detail">
        <p><strong>Service</strong>{{ $lead->service_type }}</p>
        <p><strong>Route</strong>{{ $lead->pickup_city }} to {{ $lead->destination }}</p>
        <p><strong>Trip</strong>{{ $lead->preferred_trip_date?->format('F j, Y') ?? 'Flexible date' }} · {{ $lead->preferred_trip_time ?: 'Flexible time' }}</p>
        <p><strong>Passengers</strong>{{ $lead->passengers ?: 'Not specified' }}</p>
        @if ($lead->request_type === 'reservation')
            <p><strong>Estimated route</strong>{{ $lead->estimated_distance_miles }} miles · {{ $lead->estimated_duration_minutes }} minutes</p>
            <p><strong>Planning estimate</strong>{{ $lead->estimated_price !== null ? '$'.number_format((float) $lead->estimated_price, 2).' '.$lead->pricing_currency : 'Provider quote required' }}</p>
        @endif
        <p><strong>Details</strong>{{ $lead->details ?: 'None provided' }}</p>
    </div>
    <form method="POST" action="{{ route('admin.leads.update', $lead) }}" class="lead-form" style="margin-top:2rem">@csrf @method('PATCH')<label>Status<select name="status">@foreach (['new', 'contacted', 'quoted', 'confirmed', 'qualified', 'invalid', 'closed'] as $key)<option value="{{ $key }}" @selected($lead->status === $key)>{{ ucfirst($key) }}</option>@endforeach</select></label><label>Internal notes<textarea name="internal_notes" rows="6">{{ $lead->internal_notes }}</textarea></label><button class="button button-gold" type="submit">Save request</button></form>
</section>
@endsection
