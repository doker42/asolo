<?php

namespace App\Providers;

use App\Models\About;
use App\Models\Info;
use App\Models\Work;
use App\Services\ResumeDataCache;
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

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
//        $forgetResumeData = app(ResumeDataCache::class)->forget(...);
        $forgetResumeData = [app(ResumeDataCache::class), 'forget'];

        foreach ([About::class, Info::class, Work::class] as $model) {
            $model::saved($forgetResumeData);
            $model::deleted($forgetResumeData);
        }

        // Only models using SoftDeletes expose the restored event.
        Work::restored($forgetResumeData);
    }
}
