<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate the sitemap.xml file';

    public function handle()
    {
        $sitemap = Sitemap::create();

        // Добавь страницы сайта
        $sitemap->add(Url::create('/'));
        $sitemap->add(Url::create('/show'));

        // Пример с динамическими маршрутами (например, статьи)
//        $articles = \App\Models\Article::all();
//        foreach ($articles as $article) {
//            $sitemap->add(
//                Url::create("/articles/{$article->slug}")
//                    ->setLastModificationDate($article->updated_at)
//                    ->setPriority(0.8)
//                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
//            );
//        }

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('✅ Sitemap generated successfully!');
    }
}
