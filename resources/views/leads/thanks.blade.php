@extends('layouts.app')

@section('content')
<section class="thanks shell">
    <h1>We received your request.</h1>
    <p class="lede">Your trip details have been recorded. An independent transportation provider may contact you to discuss availability, vehicle options and pricing. For a conversation now, call the number below.</p>
    <x-call-button location="thanks" :show-number="true" />
</section>
@endsection
