<?php

namespace App\Http\Middleware;

use App\Jobs\HandleRequest;
use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
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

        if (Visitor::isIgnoredIp($data['ip'])) {
            return $next($request);
        }

        if (Visitor::isBanned($data['ip'])) {
            sleep(100);
            abort(404);
        }

        if (
            collect(config('visitors.bad_agents'))->first(fn($agent) => str_contains($data['agent'], $agent)) ||
            collect(config('visitors.bad_paths'))->first(fn($segment) => str_contains($data['path'], $segment))
        ) {
            sleep(60);
            return response('Access Denied', 418)
                ->header('X-Defense', 'Honeypot')
                ->header('Retry-After', '86400'); // 1 день
        }

        dispatch(new HandleRequest($data));

        return $next($request);
    }

    /**
     * @param Request $request
     * @return array
     */
    protected function getRequestData(Request $request): array
    {
        $url = $request->getRequestUri();

        return [
            'ip'     => $request->getClientIp(),
            'url'    => Str::limit($url, config('app.max_visitors_uri'), ''),
            'path'   => $request->path(),
            'method' => $request->method(),
            'agent'  => strtolower($request->userAgent() ?? ''),
        ];
    }
}
