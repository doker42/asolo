<?php

namespace App\Providers;

use App\Http\Middleware\Throttle404Middleware;
use App\Http\Middleware\Throttle404WithRateLimiter;
use App\Http\Middleware\VisitorMiddleware;
use Illuminate\Support\ServiceProvider;

class VisitorsWatcherServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerMiddleware();
    }

    protected function registerMiddleware(): void
    {
        if (config('visitors.middleware.visitors.enabled', true)) {
            $this->app->booted(function () {
                $kernel = $this->app->make(\Illuminate\Contracts\Http\Kernel::class);
                $kernel->pushMiddleware(VisitorMiddleware::class);
            });
        }

        if (config('visitors.middleware.throttle_404.enabled', true)) {
            $this->app->booted(function () {
                $kernel = $this->app->make(\Illuminate\Contracts\Http\Kernel::class);
                $kernel->pushMiddleware(Throttle404Middleware::class);
            });
        }

        if (config('visitors.middleware.throttle_404with_limit.enabled', true)) {
            $this->app->booted(function () {
                $kernel = $this->app->make(\Illuminate\Contracts\Http\Kernel::class);
                $kernel->pushMiddleware(Throttle404WithRateLimiter::class);
            });
        }
    }
}
