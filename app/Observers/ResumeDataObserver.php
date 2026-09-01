<?php

namespace App\Observers;

use App\Services\ResumeDataCache;
use App\Services\SEOService;
use App\Services\ResumeStaticGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class ResumeDataObserver
{
    public function saved(Model $model): void
    {
        $this->regenerate();
    }

    public function deleted(Model $model): void
    {
        $this->regenerate();
    }

    public function restored(Model $model): void
    {
        $this->regenerate();
    }

    public function forceDeleted(Model $model): void
    {
        $this->regenerate();
    }

    private function regenerate(): void
    {
        $cache = app(ResumeDataCache::class);

        $cache->forget();

        $data = $cache->get();
        $about = $data['about'];
        $works = $data['works'];

        if (!$about || !$works || !$about->image?->name) {
            Log::info('Resume static page skipped: not enough data.');

            return;
        }

        app(SEOService::class)->setMeta(
            'Chebotnikov developer',
            'Chebotnikov laravel php developing',
            route('resume'),
            [
                'type' => 'Chebotnikov developer resume',
                'schema' => 'Resume',
            ]
        );

        $html = View::make('resume.resume', [
            'about' => $about,
            'works' => $works,
        ])->render();

        app(ResumeStaticGenerator::class)->generate($html);
    }
}
