<h1>New callback request</h1>
<p><strong>Name:</strong> {{ $lead->full_name }}</p>
<p><strong>Phone:</strong> {{ $lead->phone }}</p>
<p><strong>Service:</strong> {{ $lead->service_type }}</p>
<p><strong>Route:</strong> {{ $lead->pickup_city }} to {{ $lead->destination }}</p>
@if ($lead->details)<p><strong>Details:</strong> {{ $lead->details }}</p>@endif
