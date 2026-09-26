<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\LeadController as AdminLeadController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ServiceController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::get('/request-a-callback', [LeadController::class, 'create'])->name('leads.create');
Route::post('/request-a-callback', [LeadController::class, 'store'])->middleware('throttle:5,1')->name('leads.store');
Route::get('/request-a-callback/thanks', [LeadController::class, 'thanks'])->name('leads.thanks');
Route::view('/services', 'pages.services')->name('services');

foreach (config('transportation.services', []) as $serviceKey => $service) {
    Route::get($service['uri'], [ServiceController::class, 'show'])
        ->defaults('serviceKey', $serviceKey)
        ->name($service['route_name']);
}

Route::view('/service-areas', 'pages.areas')->name('areas');
Route::view('/about', 'pages.about')->name('about');
Route::view('/contact', 'pages.contact')->name('contact');
Route::view('/privacy', 'pages.privacy')->name('privacy');
Route::view('/terms', 'pages.terms')->name('terms');
Route::get('/sitemap.xml', function (): Response {
    $pages = [
        'home' => resource_path('views/home.blade.php'),
        'services' => resource_path('views/pages/services.blade.php'),
        'areas' => resource_path('views/pages/areas.blade.php'),
        'about' => resource_path('views/pages/about.blade.php'),
        'contact' => resource_path('views/pages/contact.blade.php'),
        'leads.create' => resource_path('views/leads/create.blade.php'),
        'privacy' => resource_path('views/pages/privacy.blade.php'),
        'terms' => resource_path('views/pages/terms.blade.php'),
    ];

    foreach (config('transportation.services', []) as $service) {
        $pages[$service['route_name']] = [
            resource_path('views/pages/service-detail.blade.php'),
            config_path('transportation.php'),
        ];
    }

    $urls = collect($pages)->map(function (array|string $sources, string $routeName): string {
        $lastModifiedTimestamp = collect((array) $sources)
            ->map(fn (string $source): int => filemtime($source))
            ->max();
        $lastModified = date(DATE_ATOM, $lastModifiedTimestamp);

        return '<url><loc>'.e(route($routeName)).'</loc><lastmod>'.$lastModified.'</lastmod></url>';
    })->implode('');

    return response('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'.$urls.'</urlset>', 200, ['Content-Type' => 'application/xml']);
})->name('sitemap');
Route::get('/robots.txt', fn (): Response => response("User-agent: *\nAllow: /\nDisallow: /admin\nSitemap: ".route('sitemap')."\n", 200, ['Content-Type' => 'text/plain']))->name('robots');

Route::get('/admin/login', [AuthController::class, 'create'])->name('admin.login');
Route::get('/login', [AuthController::class, 'create'])->name('login');
Route::post('/admin/login', [AuthController::class, 'store'])->middleware('throttle:5,1')->name('admin.login.store');
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function (): void {
    Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
    Route::get('/leads', [AdminLeadController::class, 'index'])->name('leads.index');
    Route::get('/leads/export', [AdminLeadController::class, 'export'])->name('leads.export');
    Route::get('/leads/{lead}', [AdminLeadController::class, 'show'])->name('leads.show');
    Route::patch('/leads/{lead}', [AdminLeadController::class, 'update'])->name('leads.update');
});
