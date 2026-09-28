<?php

namespace App\Support;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class RoutePlanner
{
    /** @return array{origin: array{label: string, latitude: float, longitude: float}, destination: array{label: string, latitude: float, longitude: float}, distance_meters: float, duration_seconds: float, geometry: array<int, array{0: float, 1: float}>} */
    public function plan(string $originAddress, string $destinationAddress): array
    {
        $origin = $this->geocode($originAddress);
        $destination = $this->geocode($destinationAddress);
        $routeKey = 'route:'.sha1(json_encode([$origin, $destination]));

        $route = Cache::remember($routeKey, now()->addDays(config('routing.cache_days')), function () use ($origin, $destination): array {
            $coordinates = sprintf('%F,%F;%F,%F', $origin['longitude'], $origin['latitude'], $destination['longitude'], $destination['latitude']);

            try {
                $response = Http::acceptJson()
                    ->withUserAgent(config('routing.user_agent'))
                    ->connectTimeout(3)
                    ->timeout(8)
                    ->retry(2, 200, throw: false)
                    ->get(rtrim(config('routing.directions_url'), '/').'/'.$coordinates, [
                        'overview' => 'simplified',
                        'geometries' => 'geojson',
                        'steps' => 'false',
                    ]);
            } catch (ConnectionException $exception) {
                throw new RuntimeException('The route service could not be reached.', previous: $exception);
            }

            $route = $response->json('routes.0');

            if (! $response->successful() || ! is_array($route)) {
                throw new RuntimeException('No driving route was found for these addresses.');
            }

            return [
                'distance_meters' => (float) $route['distance'],
                'duration_seconds' => (float) $route['duration'],
                'geometry' => $route['geometry']['coordinates'] ?? [],
            ];
        });

        return ['origin' => $origin, 'destination' => $destination, ...$route];
    }

    /** @return array{label: string, latitude: float, longitude: float} */
    private function geocode(string $address): array
    {
        $cacheKey = 'geocode:'.sha1(mb_strtolower(trim($address)));

        return Cache::remember($cacheKey, now()->addDays(config('routing.cache_days')), function () use ($address): array {
            try {
                $response = Cache::lock('nominatim-request-rate', 15)->block(15, function () use ($address) {
                    $interval = (int) config('routing.geocoding_interval_milliseconds', 1100);
                    $lastRequestAt = (float) Cache::get('nominatim-last-request-at', 0);
                    $waitMicroseconds = ($interval * 1000) - (int) ((microtime(true) - $lastRequestAt) * 1_000_000);

                    if ($waitMicroseconds > 0) {
                        usleep($waitMicroseconds);
                    }

                    $response = Http::acceptJson()
                        ->withUserAgent(config('routing.user_agent'))
                        ->connectTimeout(3)
                        ->timeout(8)
                        ->retry(2, 250, throw: false)
                        ->get(config('routing.geocoding_url'), [
                            'q' => $address,
                            'format' => 'jsonv2',
                            'limit' => 1,
                            'countrycodes' => 'us',
                        ]);

                    Cache::put('nominatim-last-request-at', microtime(true), now()->addMinutes(5));

                    return $response;
                });
            } catch (ConnectionException $exception) {
                throw new RuntimeException('The address service could not be reached.', previous: $exception);
            }

            $place = $response->json('0');

            if (! $response->successful() || ! is_array($place)) {
                throw new RuntimeException("We could not find the address: {$address}");
            }

            return [
                'label' => (string) $place['display_name'],
                'latitude' => (float) $place['lat'],
                'longitude' => (float) $place['lon'],
            ];
        });
    }
}
