<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class Throttle404WithRateLimiter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();
        $key = "404:ip:{$ip}";

        if (RateLimiter::tooManyAttempts($key, 5)) {
            return response('Access blocked due to too many 404 errors.', Response::HTTP_FORBIDDEN);
        }

        $response = $next($request);

        if ($response->getStatusCode() === Response::HTTP_NOT_FOUND) {
            RateLimiter::hit($key, 3600);
        }

        return $response;
    }
}
