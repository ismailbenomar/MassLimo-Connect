# MassLimo Connect

<!-- impeccable:product-schema 1 -->

## Platform

web

## Context Basis

Initialized from the existing application and conversation at the user's request. Current site disclosures define the referral model below; operator arrangements and commercial claims beyond those disclosures remain unverified.

## Users

People seeking transportation in Massachusetts, including airport travelers, business travelers, wedding and event planners, and groups. Visitors need a straightforward way to discuss a trip with a transportation provider. Internal staff use the authenticated administration area to manage callback leads.

## Product Purpose

Help visitors start a transportation conversation through a telephone call or callback request. The primary outcomes are calls and actionable callback leads; no conversion targets have been established.

## Positioning

The current site describes MassLimo Connect as an independent marketing and referral service. Independent transportation operators handle availability, vehicle selection, pricing, reservations, payments, and transportation. The site states that MassLimo Connect does not own or operate a fleet or process bookings and payments. Preserve these disclosures unless the owner changes the business model.

## Operating Context

- Visitors explore services and service areas, call the business, or submit trip and contact details with consent to telephone contact.
- The business telephone number confirmed by the owner is +1 (762) 436-4050.
- Callback requests include name, telephone, service type, pickup city, destination, and optional trip details and email.
- Staff can view, update, and export leads through the authenticated administration area.
- Massachusetts is the market described by the site; exact operator coverage and availability require confirmation.

## Capabilities and Constraints

- Existing application: Laravel and Blade with Vite, Tailwind, custom CSS, and lightweight JavaScript. Check installed package versions before implementation.
- MySQL is required by the owner; do not substitute SQLite. Development and testing use separate databases.
- Current service pages cover Boston Logan airport transfers, corporate transportation, wedding referrals, hourly chauffeur service, and luxury SUV/group transportation.
- Callback forms include validation, consent, and spam controls. Preserve working forms, telephone links, and lead administration when changing the interface.
- Keep credentials and personal lead data out of documentation and public assets.
- Production hosting, notification delivery, response-time commitments, actual operator relationships, and verified geographic coverage remain open decisions.

## Brand Commitments

- Name: MassLimo Connect.
- The owner requested a better-looking modern website with modern vehicle photography and expressed interest in generated images.
- Existing copy uses a direct, welcoming tone. A formal voice guide has not been confirmed.
- Photographs must not imply ownership of a fleet or verified operator vehicles.

## Evidence on Hand

- Referral disclosures: `resources/views/pages/about.blade.php` and `resources/views/pages/terms.blade.php`.
- Services and application workflows: `routes/web.php` and `resources/views/leads/create.blade.php`.
- Existing vehicle photography: `public/images/executive-sedan.webp` and its smaller responsive version. The homepage credits Martin Katler / Unsplash; these are stock images, not evidence of an owned fleet.
- No verified testimonials, customer counts, operator licensing/insurance records, prices, or service guarantees were supplied in the conversation. Do not invent them.
- Image generation previously failed with a service authentication error; no generated image has been integrated.

## Product Principles

- Make calling and requesting a callback clear and easy across device sizes.
- Explain who provides transportation and who handles the booking.
- Preserve useful trip details and contact consent throughout lead capture.
- Ground claims in supplied evidence and distinguish illustrative imagery from actual business assets.
