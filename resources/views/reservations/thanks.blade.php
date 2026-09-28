@extends('layouts.app')

@section('content')
<section class="thanks shell">
    <h1>Your trip request has been recorded.</h1>
    <p class="lede">An independent transportation provider must still confirm availability, final pricing and reservation terms. Your submitted request is not a confirmed booking.</p>
    <div class="actions"><x-call-button location="reservation-thanks" :show-number="true" /><a class="button button-outline" href="{{ route('home') }}">Return home</a></div>
</section>
@endsection
