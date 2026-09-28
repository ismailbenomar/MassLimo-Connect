@extends('layouts.app')

@section('content')
<section class="form-hero shell">
    <div class="admin-top">
        <div><p class="eyebrow">Administration</p><h1>Trip requests.</h1></div>
        <div class="admin-actions"><a class="button button-outline" href="{{ route('admin.settings.edit') }}">Estimate settings</a><form method="POST" action="{{ route('admin.logout') }}">@csrf<button class="button button-outline" type="submit">Sign out</button></form></div>
    </div>
</section>
<section class="section shell">
    <div class="admin-stats">@foreach (['new', 'contacted', 'quoted', 'confirmed', 'closed'] as $key)<a href="{{ route('admin.leads.index', ['status' => $key]) }}"><strong>{{ $counts[$key] ?? 0 }}</strong><span>{{ ucfirst($key) }}</span></a>@endforeach</div>
    <form class="admin-filter" method="GET"><input name="search" value="{{ $search }}" placeholder="Search name or phone"><select name="status"><option value="">All statuses</option>@foreach (['new', 'contacted', 'quoted', 'confirmed', 'qualified', 'invalid', 'closed'] as $key)<option value="{{ $key }}" @selected($status === $key)>{{ ucfirst($key) }}</option>@endforeach</select><button class="button button-gold" type="submit">Filter</button><a class="button button-outline" href="{{ route('admin.leads.export', ['status' => $status]) }}">Export CSV</a></form>
    <div class="lead-table">@forelse ($leads as $lead)<a href="{{ route('admin.leads.show', $lead) }}"><strong>{{ $lead->full_name }}</strong><span>{{ ucfirst($lead->request_type) }} · {{ $lead->service_type }} · {{ $lead->pickup_city }} to {{ $lead->destination }}</span><em>{{ ucfirst($lead->status) }}</em></a>@empty<p class="lede">No trip requests match this view.</p>@endforelse</div>
    {{ $leads->links() }}
</section>
@endsection
