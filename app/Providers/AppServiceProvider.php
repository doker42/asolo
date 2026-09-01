<?php

namespace App\Providers;

use App\Models\About;
use App\Models\Info;
use App\Models\Work;
use App\Observers\ResumeDataObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        foreach ([About::class, Info::class, Work::class] as $model) {
            $model::observe(ResumeDataObserver::class);
        }
    }
}
