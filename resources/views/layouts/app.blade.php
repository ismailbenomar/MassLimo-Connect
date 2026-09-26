<!doctype html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <x-seo />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-ink text-white antialiased {{ request()->routeIs('home') ? 'page-home' : '' }}">
    <a class="skip-link" href="#main-content">Skip to content</a>
    <div class="announcement">Massachusetts transportation connections <span>— Call or request a callback</span></div>
    <header class="site-header">
        <a class="brand" href="{{ route('home') }}"><span class="brand-mark">MC</span><span>MassLimo <b>Connect</b></span></a>
        <nav aria-label="Primary navigation" class="desktop-nav">
            <a href="{{ route('services') }}">Services</a>
            <a href="{{ route('areas') }}">Service areas</a>
            <a href="{{ route('about') }}">About</a>
            <a href="{{ route('leads.create') }}">Request a callback</a>
        </nav>
        <x-call-button location="header" :show-number="true" />
        <details class="mobile-menu">
            <summary aria-label="Open navigation">Menu <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><path d="M4 7h16M4 12h16M4 17h16" /></svg></summary>
            <nav aria-label="Mobile navigation">
                <a href="{{ route('services') }}">Services</a>
                <a href="{{ route('areas') }}">Service areas</a>
                <a href="{{ route('about') }}">About us</a>
                <a href="{{ route('contact') }}">Contact</a>
                <a href="{{ route('leads.create') }}">Request a callback</a>
            </nav>
        </details>
    </header>
    <x-breadcrumbs />
    <main id="main-content">@yield('content')</main>
    <footer class="site-footer">
        <div><a class="brand" href="{{ route('home') }}"><span class="brand-mark">MC</span><span>MassLimo <b>Connect</b></span></a><p>Connecting Massachusetts travelers with independent transportation providers.</p></div>
        <div><h2>Explore</h2><a href="{{ route('services') }}">Services</a><a href="{{ route('areas') }}">Massachusetts service areas</a><a href="{{ route('contact') }}">Contact</a></div>
        <div><h2>Legal</h2><a href="{{ route('privacy') }}">Privacy policy</a><a href="{{ route('terms') }}">Terms and referral disclosure</a></div>
        <p class="disclosure">MassLimo Connect is an independent marketing and referral service. Transportation services, pricing, reservations and payments are provided directly by independent third-party transportation operators.</p>
    </footer>
    <div class="mobile-call" aria-label="Call MassLimo Connect">
        <span>Call now</span>
        <x-call-button location="mobile-footer" :show-number="true" />
    </div>
</body>
</html>
