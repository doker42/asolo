<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LocationVisitors
{
    public static function getLocation(string $ip): array
    {
        if (app()->environment('local')) {
            return [
                'country' => 'local',
                'city'    => 'host',
            ];
        }

        if (!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
            return [];
        }

        return Cache::remember("visitor_location_" . sha1($ip), now()->addDays(30), function () use ($ip) {
            try {
                $response = Http::connectTimeout(1)
                    ->timeout(2)
                    ->acceptJson()
                    ->get("http://ip-api.com/json/{$ip}");

                $data = $response->json();

                return $response->successful() && ($data['status'] ?? null) === 'success'
                    ? $data
                    : [];
            } catch (\Throwable $e) {
                Log::info('Get Location Error: ' . $e->getMessage());

                return [];
            }
        });
    }
}
