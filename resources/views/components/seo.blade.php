@php
    $routeName = request()->route()?->getName();
    $pages = config('seo.pages', []);
    $page = $pages[$routeName] ?? [];
    $pageTitle = $page['title'] ?? config('seo.default_title');
    $pageDescription = $page['description'] ?? config('seo.default_description');
    $siteName = config('seo.site_name');
    $businessDescription = config('transportation.business.description');
    $canonicalUrl = url()->current();
    $isNoIndex = collect(config('seo.noindex_routes', []))->contains(
        fn (string $pattern): bool => $routeName !== null && \Illuminate\Support\Str::is($pattern, $routeName)
    );
    $imageUrl = asset('images/executive-sedan.webp');
    $imageId = $imageUrl.'#primaryimage';
    $organizationId = url('/').'#organization';
    $websiteId = url('/').'#website';
    $webPageId = $canonicalUrl.'#webpage';

    $graph = [[
        '@type' => 'WebPage',
        '@id' => $webPageId,
        'url' => $canonicalUrl,
        'name' => $pageTitle,
        'description' => $pageDescription,
        'inLanguage' => config('seo.language'),
        'isPartOf' => ['@id' => $websiteId],
        'about' => ['@id' => $organizationId],
        'primaryImageOfPage' => ['@id' => $imageId],
    ]];

    $graph[] = [
        '@type' => 'WebSite',
        '@id' => $websiteId,
        'url' => url('/'),
        'name' => $siteName,
        'inLanguage' => config('seo.language'),
        'publisher' => ['@id' => $organizationId],
    ];
    $graph[] = [
        '@type' => 'Organization',
        '@id' => $organizationId,
        'name' => $siteName,
        'url' => url('/'),
        'description' => $businessDescription,
        'telephone' => config('leadgen.phone_number'),
        'areaServed' => [
            '@type' => 'AdministrativeArea',
            'name' => config('seo.area_served'),
        ],
        'contactPoint' => [[
            '@type' => 'ContactPoint',
            'telephone' => config('leadgen.phone_number'),
            'contactType' => 'transportation referral inquiries',
            'areaServed' => 'US-MA',
            'availableLanguage' => ['en'],
        ]],
    ];
    $graph[] = [
        '@type' => 'ImageObject',
        '@id' => $imageId,
        'url' => $imageUrl,
        'contentUrl' => $imageUrl,
        'width' => 1400,
        'height' => 1750,
        'caption' => 'Black executive sedan beside contemporary architecture',
    ];

    if ($routeName !== null && $routeName !== 'home' && isset($page['label'])) {
        $breadcrumbRoutes = ['home'];

        if (isset($page['parent'])) {
            $breadcrumbRoutes[] = $page['parent'];
        }

        $breadcrumbRoutes[] = $routeName;
        $graph[] = [
            '@type' => 'BreadcrumbList',
            '@id' => $canonicalUrl.'#breadcrumb',
            'itemListElement' => collect($breadcrumbRoutes)->values()->map(fn (string $breadcrumbRoute, int $position): array => [
                '@type' => 'ListItem',
                'position' => $position + 1,
                'name' => $pages[$breadcrumbRoute]['label'],
                'item' => route($breadcrumbRoute),
            ])->all(),
        ];
    }

    if (is_string($routeName) && str_starts_with($routeName, 'services.')) {
        $graph[] = [
            '@type' => 'Service',
            '@id' => $canonicalUrl.'#service',
            'name' => $pageTitle,
            'description' => $pageDescription,
            'serviceType' => 'Independent transportation provider referral',
            'provider' => ['@id' => $organizationId],
            'areaServed' => [
                '@type' => 'AdministrativeArea',
                'name' => config('seo.area_served'),
            ],
            'url' => $canonicalUrl,
        ];
    }

    $structuredData = [
        '@context' => 'https://schema.org',
        '@graph' => $graph,
    ];
@endphp

<title>{{ $pageTitle }}</title>
<meta name="description" content="{{ $pageDescription }}">
<meta name="robots" content="{{ $isNoIndex ? 'noindex, nofollow' : 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' }}">
<link rel="canonical" href="{{ $canonicalUrl }}">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:title" content="{{ $pageTitle }}">
<meta property="og:description" content="{{ $pageDescription }}">
<meta property="og:type" content="website">
<meta property="og:locale" content="en_US">
<meta property="og:url" content="{{ $canonicalUrl }}">
<meta property="og:image" content="{{ $imageUrl }}">
<meta property="og:image:type" content="image/webp">
<meta property="og:image:width" content="1400">
<meta property="og:image:height" content="1750">
<meta property="og:image:alt" content="Black executive sedan beside contemporary architecture">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $pageTitle }}">
<meta name="twitter:description" content="{{ $pageDescription }}">
<meta name="twitter:image" content="{{ $imageUrl }}">
<script type="application/ld+json">{!! json_encode($structuredData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP) !!}</script>
