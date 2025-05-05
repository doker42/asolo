<?php

namespace App\Services;

use Artesaos\SEOTools\Facades\SEOTools;

class SEOService
{
    public function setMeta(string $title, string $description = '', string $url = '', array $options = []): void
    {
        SEOTools::setTitle($title);
        SEOTools::setDescription($description);
        SEOTools::setCanonical($url ?: url()->current());

        SEOTools::opengraph()->setTitle($title);
        SEOTools::opengraph()->setDescription($description);
        SEOTools::opengraph()->setUrl($url ?: url()->current());
        SEOTools::opengraph()->addProperty('type', $options['type'] ?? 'website');

//        SEOTools::twitter()->setTitle($title);
//        SEOTools::twitter()->setSite($options['twitter_site'] ?? '@yourhandle');

        // Optional: Structured data (JSON-LD)
        if (isset($options['schema'])) {
            SEOTools::jsonLd()->setTitle($title);
            SEOTools::jsonLd()->setDescription($description);
            SEOTools::jsonLd()->setType($options['schema']);
        }
    }
}
