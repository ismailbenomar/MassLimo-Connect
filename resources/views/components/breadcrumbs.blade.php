@php
    $routeName = request()->route()?->getName();
    $pages = config('seo.pages', []);
    $page = $routeName === null ? [] : ($pages[$routeName] ?? []);
    $breadcrumbRoutes = ['home'];

    if (isset($page['parent'])) {
        $breadcrumbRoutes[] = $page['parent'];
    }
@endphp

@if ($routeName !== null && $routeName !== 'home' && isset($page['label']))
    <nav class="breadcrumbs shell" aria-label="Breadcrumb">
        <ol>
            @foreach ($breadcrumbRoutes as $breadcrumbRoute)
                <li><a href="{{ route($breadcrumbRoute) }}">{{ $pages[$breadcrumbRoute]['label'] }}</a></li>
            @endforeach
            <li aria-current="page">{{ $page['label'] }}</li>
        </ol>
    </nav>
@endif
