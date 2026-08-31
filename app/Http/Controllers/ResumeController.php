<?php

namespace App\Http\Controllers;

use App\Services\ResumeDataCache;
use App\Services\SEOService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;

class ResumeController extends Controller
{
    /**
     * @param SEOService $seo
     * @return View
     */
    public function resume(SEOService $seo, ResumeDataCache $resumeDataCache): View
    {
        $data = $resumeDataCache->get();
        $about = $data['about'];
        $works = $data['works'];

        if (!$about || !$works || !$about->image?->name) {
            return view('resume.nodata');
        }

        $seo->setMeta(
            'acode developer',
            'laravel php developing',
            route('resume'),
            [
                'type'         => 'developer resume',
//                'twitter_site' => '@YourHandle',
                'schema'       => 'Resume'
            ]
        );

        return view('resume.resume', [
            'about' => $about,
            'works' => $works,
        ]);
    }

    /**
     *  preview resume
     *
     * @return View
     */
    public function show(ResumeDataCache $resumeDataCache): View
    {
        $data = $resumeDataCache->get();
        $about = $data['about'];
        $info = $data['info'];
        $works = $data['works'];

        if (!$about || !$works || !count($works) || !$info) {
            return view('resume.nodata');
        }

        return view('resume.pdf.cv-pdf', $data);
    }


    public function download(ResumeDataCache $resumeDataCache)
    {
        $data = $resumeDataCache->get();
        $data['export'] = true;

        $pdf = Pdf::loadView('resume.pdf.cv-pdf', $data);

        return $pdf->download('CV_CHEBOTNIKOV.pdf');
    }
}
