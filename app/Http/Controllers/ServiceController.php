<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function show(Request $request): View
    {
        $serviceKey = $request->route('serviceKey');
        $services = config('transportation.services', []);

        abort_unless(is_string($serviceKey) && isset($services[$serviceKey]), 404);

        $service = $services[$serviceKey];
        $relatedServices = collect($service['related_services'])
            ->map(function (array $relatedService) use ($services): array {
                $relatedService['route'] = $services[$relatedService['service']]['route_name'];

                return $relatedService;
            })
            ->all();

        return view('pages.service-detail', [
            'service' => $service['service'],
            'description' => $service['description'],
            'details' => $service['details'],
            'planningTitle' => $service['planning_title'],
            'planningCopy' => $service['planning_copy'],
            'providerQuestions' => $service['provider_questions'],
            'relatedServices' => $relatedServices,
        ]);
    }
}
