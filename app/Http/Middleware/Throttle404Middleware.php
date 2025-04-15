<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class Throttle404Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();

        if (Visitor::isIgnoredIp($ip)) {
            return $next($request);
        }

        $key = "404_attempts:{$ip}";

        $attempts = Cache::get($key, 0);

        if ($attempts >= 3) {
            sleep(60 * 10);
        }

        $response = $next($request);

        if ($response->getStatusCode() === Response::HTTP_NOT_FOUND) {
            Cache::put($key, $attempts + 1, now()->addHour());
        }

        return $response;
    }
}
