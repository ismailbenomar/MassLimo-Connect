@props(['location' => 'unknown', 'showNumber' => false])

@php($phone = new \App\Support\PhoneNumber(config('leadgen.phone_number')))

@if ($phone->tel())
    <a
        href="tel:{{ $phone->tel() }}"
        aria-label="Call {{ $phone->formatted() }}"
        data-phone-cta="{{ $location }}"
        class="button button-gold call-button"
    >
        <svg aria-hidden="true" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M5 3h4l2 5-3 2a16 16 0 0 0 6 6l2-3 5 2v4a2 2 0 0 1-2 2C9 21 3 15 3 5a2 2 0 0 1 2-2Z"/></svg>
        {{ $showNumber ? $phone->formatted() : ($slot->isEmpty() ? 'Call now' : $slot) }}
    </a>
@endif
