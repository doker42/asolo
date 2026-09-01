<?php

namespace App\Services;

use App\Models\About;
use App\Models\Info;
use App\Models\Work;
use Illuminate\Support\Facades\Cache;

class ResumeDataCache
{
    public const KEY = 'resume.data';

    /**
     * Return all data used by the public resume and PDF views.
     *
     * test
     *
     * The value lives until one of the underlying models changes. This avoids
     * repeating the same database queries on every public request.
     */
    public function get(): array
    {
        return Cache::rememberForever(self::KEY, fn (): array => [
            'about' => About::query()->with('image')->first(),
            'info'  => Info::query()->first(),
            'works' => Work::query()->orderByDesc('start_date')->get(),
        ]);
    }

    public function forget(): void
    {
        Cache::forget(self::KEY);
    }
}
