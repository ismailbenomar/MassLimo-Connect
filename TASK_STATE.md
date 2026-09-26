# Project Goal

Build and verify the production-ready MassLimo Connect lead-generation website.

## Current Status

- Current phase: Public lead-generation slice complete; administration and SEO next
- Current task: Add protected lead management and complete public route surface
- Last successful verification: `vendor/bin/pint --format agent`; `php artisan test --compact tests/Feature/LeadCaptureTest.php` passed 3 tests / 11 assertions; `npm run build` passed
- Active blockers: MySQL is not available in the local environment; local verification uses SQLite while `.env.example` remains MySQL-configured

## Definition of Done

- [x] Laravel 13 application initialized directly in workspace
- [x] MySQL configuration and lead migration prepared
- [x] Public homepage, services, areas, about, contact and legal pages implemented
- [x] Configured phone value object and shared call CTA implemented
- [x] Callback form validation, CSRF, honeypot, throttling and persistence implemented
- [x] Lead notification mail path implemented with graceful missing configuration behavior
- [ ] Administration authentication and lead management implemented
- [ ] Service-specific public pages completed
- [ ] SEO sitemap, robots and structured metadata completed
- [ ] Responsive browser inspection completed
- [ ] Full test suite passes
- [ ] Documentation and pilot/deployment runbook complete

## Completed Work

- Laravel 13.10.1 created with PHP 8.5 and Composer.
- Laravel Boost installed and Copilot guidance generated.
- Public shell uses Blade, Tailwind CSS v4, Vite and lightweight JavaScript.
- Phone CTA dispatches `phone_click` CustomEvent and `window.dataLayer` payload without blocking calls.
- Lead records and notification mailable added.

## Remaining Work

- Protected administration area, status updates, notes and CSV export.
- Service-specific pages, metadata, sitemap and robots.
- Admin command, tests, browser smoke testing and documentation.
- MySQL verification when a server is available.

## Decisions

- Keep Blade server-rendered; Alpine/SPA is unnecessary for this MVP.
- Keep local `.env` SQLite for executable tests; never change the required MySQL deployment example.
- Use a central `PhoneNumber` value object and `x-call-button` component so future dynamic number insertion has one integration point.

## Commands and Results

- `composer create-project laravel/laravel . --prefer-dist --no-interaction`: passed.
- `composer require laravel/boost --dev; php artisan boost:install`: passed.
- `php artisan migrate:fresh --force`: passed on local SQLite.
- `npm install --ignore-scripts`: passed.
- `npm run build`: passed.
- `vendor/bin/pint --format agent`: passed.
- `php artisan test --compact tests/Feature/LeadCaptureTest.php`: passed, 3 tests / 11 assertions.

## Known Limitations

- Local MySQL server is not installed or configured in this environment.
- No physical call provider, analytics ID, mail transport or real transportation operator integration is configured.

## Exact Resume Point

Implement protected admin login and lead list/detail/status/CSV workflow, then add service-specific routes and sitemap/robots before the next focused test run.
