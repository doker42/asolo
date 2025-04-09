<?php

namespace App\Http\Middleware;

use App\Jobs\VisitorLocationSet;
use App\Models\Visitor;
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

        if (Visitor::isBanned($ip)) {  //todo replace to cache
            abort(404);
        }

        dispatch(new VisitorLocationSet($ip));

        return $next($request);
    }
}
