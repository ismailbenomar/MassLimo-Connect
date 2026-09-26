# MassLimo Connect SEO Action Plan

## This week

1. **Deepen the five service pages.** Add service-specific referral questions, suitability guidance, provider discussion points, and what the traveler should verify. Keep every statement accurate to the referral role.
2. **Clarify the referral value proposition.** Explain why a traveler should use MassLimo Connect rather than contacting an operator directly. Base the explanation on real business operations.
3. **Optimize the hero image.** Produce AVIF and additional responsive sizes, then rerun mobile Lighthouse. Target LCP below 2.5 seconds in lab conditions.
4. **Fix accessibility issues.** Increase footer brand contrast and align the mobile menu’s accessible name with its visible “Menu” label.
5. **Improve callback clarity.** Add truthful follow-up expectations and field-level validation associations. Do not promise response timing until operations can support it.

## This month

1. Expand the about page with the verified business identity, accountable operator information, referral process, and provider-selection standards.
2. Add a useful traveler checklist for evaluating an independent transportation provider.
3. Add verifiable contact information and official social profiles, then connect those profiles with `sameAs` schema.
4. Add a real brand logo asset and expose it through `Organization.logo` and social metadata.
5. Build content around distinct traveler questions rather than mass-producing city pages.
6. Establish production cache headers for hashed assets and responsive images.

## At production launch

1. Set `APP_URL` to the final HTTPS origin and confirm every canonical, schema URL, sitemap URL, and Open Graph URL uses it.
2. Enforce one HTTPS host with permanent redirects and enable appropriate security headers.
3. Verify Google Search Console and Bing Webmaster Tools.
4. Submit `/sitemap.xml` and inspect representative URLs.
5. Configure IndexNow for material URL additions and changes.
6. Run Lighthouse and structured-data validation against production.
7. Capture an SEO drift baseline after launch.

## After real data accumulates

1. Use Search Console query and page data to revise titles and content based on actual impressions and intent.
2. Measure phone calls and callback completions without collecting unnecessary personal data.
3. Publish anonymized, truthful first-party insights only when sample size and consent support them.
4. Monitor brand mentions, legitimate citations, and links from relevant Massachusetts resources.
5. Reassess Google Business Profile eligibility before creating or optimizing a listing.

## Avoid

- City pages that only swap location names.
- Invented reviews, prices, fleet details, insurance, licenses, availability, or response times.
- `LocalBusiness`, `Review`, or `AggregateRating` schema without matching verified visible facts.
- Treating `llms.txt` as a substitute for crawlability and helpful content.
- Competing for direct-operator terms without clearly stating the referral model.
