<?php

namespace App\Http\Controllers;

use App\Services\ResumeDataCache;
use App\Services\ResumeStaticGenerator;
use App\Services\SEOService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;

class ResumeController extends Controller
{
    /**
     * @param SEOService $seo
     * @param ResumeDataCache $resumeDataCache
     * @param ResumeStaticGenerator $staticGenerator
     * @return Response
     */
    public function resume(
        SEOService $seo,
        ResumeDataCache $resumeDataCache,
        ResumeStaticGenerator $staticGenerator
    ): Response {
        $data = $resumeDataCache->get();

        $about = $data['about'];
        $works = $data['works'];

        if (!$about || !$works || !$about->image?->name) {
            return response()->view('resume.nodata');
        }

        $seo->setMeta(
            'Chebotnikov developer',
            'Chebotnikov laravel php developing',
            route('resume'),
            [
                'type'   => 'developer resume',
                'schema' => 'Resume',
            ]
        );

        $view = view('resume.resume', [
            'about' => $about,
            'works' => $works,
        ]);

        // Один раз рендерим Blade.
        $html = $view->render();

        // Пытаемся создать статическую копию.
        // Если генерация по какой-либо причине упадёт,
        // динамическая страница всё равно должна открыться.
        try {
            $staticGenerator->generate($html);
        } catch (\Throwable $e) {
            report($e);
        }

        return response($html);
    }

    /**
     *  preview resume
     *
     * @param ResumeDataCache $resumeDataCache
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
