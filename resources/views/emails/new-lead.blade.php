<h1>New {{ $lead->request_type === 'reservation' ? 'reservation' : 'callback' }} request</h1>
<p><strong>Name:</strong> {{ $lead->full_name }}</p>
<p><strong>Phone:</strong> {{ $lead->phone }}</p>
<p><strong>Service:</strong> {{ $lead->service_type }}</p>
<p><strong>Route:</strong> {{ $lead->pickup_city }} to {{ $lead->destination }}</p>
@if ($lead->estimated_distance_miles)<p><strong>Planning estimate:</strong> {{ $lead->estimated_distance_miles }} miles · {{ $lead->estimated_duration_minutes }} minutes @if ($lead->estimated_price) · ${{ number_format((float) $lead->estimated_price, 2) }} @endif</p>@endif
@if ($lead->details)<p><strong>Details:</strong> {{ $lead->details }}</p>@endif
