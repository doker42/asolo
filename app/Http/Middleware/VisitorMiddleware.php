<?php

namespace App\Http\Middleware;

use App\Jobs\HandleRequest;
use App\Jobs\LogRequestedUrl;
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
        $data = $this->getRequestData($request);

        if (Visitor::isBanned($data['ip'])) {  //todo replace to cache
            abort(404);  //todo make sleep !!!
        }

        dispatch(new HandleRequest($data));

        return $next($request);
    }

    protected function getRequestData(Request $request): array
    {
        return [
            'ip'     => $request->getClientIp(),
            'url'    => $request->getRequestUri(),
            'method' => $request->method(),
        ];
    }
}
