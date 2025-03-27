<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Info;
use App\Models\Work;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;

class ResumeController extends Controller
{
    /**
     * @return View
     */
    public function resume(): View
    {
        $about = About::single();
        $works = Work::orderBy('start_date', 'desc')->get();

        if (!$about || !$works || !$about->image?->name) {
            return view('resume.nodata');
        }

        $data = [
            'about' => $about,
            'works' => $works,
        ];

        return view('resume.resume', $data);
    }

    /**
     *  preview resume
     *
     * @return View
     */
    public function show(): View
    {
        $about = About::single();
        $info = Info::single();
        $works = Work::all();

        if (!$about || !$works || !count($works) || !$info) {
            return view('resume.nodata');
        }

        $data = [
            'about' => $about,
            'works' => $works,
            'info'  => $info
        ];

        return view('resume.pdf.cv-pdf', $data);
    }


    public function download()
    {
        $about = About::single();
        $info = Info::single();
        $works = Work::all();

        $data = [
            'about' => $about,
            'works' => $works,
            'info'  => $info,
            'export' => true
        ];

        $pdf = Pdf::loadView('resume.pdf.cv-pdf', $data);

        return $pdf->download('CV_CHEBOTNIKOV.pdf');
    }
}
