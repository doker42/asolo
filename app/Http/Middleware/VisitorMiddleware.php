<?php

namespace App\Http\Middleware;

use App\Jobs\VisitorLocationSet;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VisitorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->getClientIp();
        dispatch(new VisitorLocationSet($ip));

        return $next($request);
    }
}
