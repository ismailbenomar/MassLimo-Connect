<?php

namespace Tests\Feature;

use Tests\TestCase;

class SeoMetadataTest extends TestCase
{
    public function test_public_pages_have_unique_search_metadata_and_canonicals(): void
    {
        $routes = [
            'home',
            'services',
            'services.logan',
            'services.corporate',
            'services.weddings',
            'services.hourly',
            'services.group',
            'areas',
            'about',
            'contact',
            'leads.create',
            'privacy',
            'terms',
        ];

        $titles = [];

        foreach ($routes as $routeName) {
            $response = $this->get(route($routeName))->assertOk();
            $html = $response->getContent();

            preg_match('/<title>(.*?)<\/title>/', $html, $titleMatch);
            $titles[] = html_entity_decode($titleMatch[1] ?? '');

            $response
                ->assertSee('<meta name="description"', false)
                ->assertSee('<link rel="canonical" href="'.route($routeName).'">', false)
                ->assertSee('index, follow, max-image-preview:large', false)
                ->assertSee('<meta property="og:url" content="'.route($routeName).'">', false)
                ->assertSee('<script type="application/ld+json">', false);
        }

        $this->assertCount(count($routes), array_unique($titles));
    }

    public function test_homepage_structured_data_describes_the_referral_organization(): void
    {
        config(['leadgen.phone_number' => '+17624364050']);

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('"@type":"Organization"', false)
            ->assertSee('"@type":"WebSite"', false)
            ->assertSee('"telephone":"+17624364050"', false)
            ->assertSee('"name":"Massachusetts"', false)
            ->assertDontSee('"@type":"LocalBusiness"', false);
    }

    public function test_homepage_prioritizes_a_responsive_avif_hero_without_render_blocking_css(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee('<source type="image/avif"', false)
            ->assertSee('executive-sedan-480.avif 480w', false)
            ->assertSee('executive-sedan-1100.avif 1100w', false)
            ->assertSee('fetchpriority="high"', false)
            ->assertSee('<style>', false)
            ->assertDontSee('rel="stylesheet"', false);
    }

    public function test_indexable_inner_pages_include_visible_and_structured_breadcrumbs(): void
    {
        $this->get(route('services.logan'))
            ->assertOk()
            ->assertSee('<nav class="breadcrumbs shell" aria-label="Breadcrumb">', false)
            ->assertSee('aria-current="page">Logan Airport referrals', false)
            ->assertSee('"@type":"BreadcrumbList"', false)
            ->assertSee('"name":"Services"', false);
    }

    public function test_private_and_confirmation_pages_are_not_indexed(): void
    {
        $this->get(route('leads.thanks'))
            ->assertOk()
            ->assertSee('<meta name="robots" content="noindex, nofollow">', false);

        $this->get(route('login'))
            ->assertOk()
            ->assertSee('<meta name="robots" content="noindex, nofollow">', false);
    }

    public function test_services_hub_links_to_each_service_and_detail_pages_have_specific_guidance(): void
    {
        $serviceRoutes = [
            'services.logan' => 'Airline and flight number',
            'services.corporate' => 'Meeting or flight schedule',
            'services.weddings' => 'Ceremony and reception locations',
            'services.hourly' => 'Requested start and end time',
            'services.group' => 'Total passenger count',
        ];

        $hub = $this->get(route('services'))->assertOk();

        foreach ($serviceRoutes as $routeName => $specificGuidance) {
            $hub->assertSee('href="'.route($routeName).'"', false);

            $this->get(route($routeName))
                ->assertOk()
                ->assertSee($specificGuidance)
                ->assertSee('View all transportation referral services');
        }
    }

    public function test_transportation_catalog_drives_service_routes_content_and_metadata(): void
    {
        foreach (config('transportation.services') as $service) {
            $response = $this->get(route($service['route_name']))
                ->assertOk()
                ->assertSee('<title>'.e($service['seo_title']).'</title>', false)
                ->assertSee($service['service'])
                ->assertSee($service['description'])
                ->assertSee($service['planning_title']);

            $response->assertSee('href="'.route('services').'"', false);
            $this->assertSame(url($service['uri']), route($service['route_name']));
        }
    }

    public function test_target_pages_place_primary_phrases_in_titles_headings_and_visible_copy(): void
    {
        $targets = [
            'home' => [
                'title' => 'Massachusetts Limo Service Referrals | MassLimo Connect',
                'heading' => 'Massachusetts limo service referrals,',
                'phrase' => 'Massachusetts limo service provider',
            ],
            'services' => [
                'title' => 'Boston Limo Service Referrals | MassLimo Connect',
                'heading' => 'Boston limo service referrals for the trip you are planning.',
                'phrase' => 'luxury car service in Boston',
            ],
            'services.logan' => [
                'title' => 'Logan Airport Car Service Referrals | MassLimo Connect',
                'heading' => 'Logan Airport car service referrals',
                'phrase' => 'Boston airport transportation',
            ],
            'services.corporate' => [
                'title' => 'Corporate Car Service Boston Referrals | MassLimo Connect',
                'heading' => 'Corporate car service Boston referrals',
                'phrase' => 'executive transportation in Boston',
            ],
            'services.weddings' => [
                'title' => 'Wedding Limo Service Massachusetts Referrals',
                'heading' => 'Wedding limo service Massachusetts referrals',
                'phrase' => 'Wedding transportation in Massachusetts',
            ],
        ];

        foreach ($targets as $routeName => $target) {
            $this->get(route($routeName))
                ->assertOk()
                ->assertSee('<title>'.$target['title'].'</title>', false)
                ->assertSee($target['heading'])
                ->assertSee($target['phrase']);
        }
    }

    public function test_service_pages_link_to_contextually_related_services(): void
    {
        $this->get(route('services.logan'))
            ->assertOk()
            ->assertSee('href="'.route('services.corporate').'"', false)
            ->assertSee('href="'.route('services.group').'"', false);

        $this->get(route('services.weddings'))
            ->assertOk()
            ->assertSee('href="'.route('services.group').'"', false)
            ->assertSee('href="'.route('services.hourly').'"', false);
    }

    public function test_sitemap_and_robots_expose_only_canonical_public_urls(): void
    {
        $this->get(route('sitemap'))
            ->assertOk()
            ->assertHeader('Content-Type', 'application/xml')
            ->assertSee('<loc>'.route('home').'</loc>', false)
            ->assertSee('<lastmod>', false)
            ->assertDontSee(route('leads.thanks'), false)
            ->assertDontSee(route('admin.login'), false);

        $this->get(route('robots'))
            ->assertOk()
            ->assertSee('Disallow: /admin')
            ->assertDontSee('Disallow: /login')
            ->assertDontSee('Disallow: /request-a-callback/thanks')
            ->assertSee('Sitemap: '.route('sitemap'));
    }
}
