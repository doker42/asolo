<?php

namespace Tests\Unit;

use App\Models\About;
use App\Models\Work;
use App\Services\ResumeDataCache;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class ResumeDataCacheTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_rebuilds_resume_data_only_after_a_source_record_changes(): void
    {
        $about = About::create([
            'about'    => 'Before update',
            'email'    => 'test@example.com',
            'git'      => 'https://github.com/example',
            'linkdin'  => 'https://linkedin.com/in/example',
            'telegram' => 'example',
        ]);
        $cache = app(ResumeDataCache::class);

        $this->assertSame('Before update', $cache->get()['about']->about);
        $this->assertTrue(Cache::has(ResumeDataCache::KEY));

        $about->update(['about' => 'After update']);

        $this->assertFalse(Cache::has(ResumeDataCache::KEY));
        $this->assertSame('After update', $cache->get()['about']->about);

        Work::create([
            'position'     => 'Developer',
            'company_name' => 'Example',
            'company_link' => 'https://example.com',
            'resp'         => 'Development',
            'stack'        => 'PHP',
            'start_date'   => '01-2024',
        ]);

        $this->assertFalse(Cache::has(ResumeDataCache::KEY));
    }
}
