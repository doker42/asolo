<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\File;
use App\Models\Info;
use Illuminate\Http\Request;

class AboutController extends Controller
{

    public function index()
    {
        $aboutReal = About::ifReal();
        return view('admin.about.list', ['aboutReal' => $aboutReal]);
    }

    public function create()
    {
        $images = File::where('type', File::IMG_TYPE)->get();

        if (!count($images)) {
            return view('admin.nodata', ['infoMessage' => "Please add images!"]);
        }

        $about = About::single();
        if ($about->exists()) {
            return redirect(route('admin_about_edit'));
        }

        return view('admin.about.create', ['images' => $images]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'about'      => 'required|string|max:2550',
            'email'      => 'required|string|max:255',
            'git'        => 'required|string|max:255',
            'linkdin'    => 'required|string|max:255',
            'telegram'   => 'required|string|max:255',
//            'letter_id'  => '',
            'image_id'   => 'required|max:255|exists:files,id',
        ]);

        $about = About::single();
        if ($about->exists()) {
            return redirect(route('admin_about_edit'));
        }

        $about->fill([
            'about'     => $input['about'],
            'email'     => $input['email'],
            'git'       => $input['git'],
            'linkdin'   => $input['linkdin'],
            'telegram'  => $input['telegram'],
//            'letter_id' => $input['letter_id'],
            'image_id'  => $input['image_id'],
        ]);

        $about->save();

        return redirect(route('admin_about_edit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $about = About::single();
        if (!$about->exists()) {
            return redirect('admin_about_create');
        }

        $images = File::where('type', File::IMG_TYPE)->get();
        if (!count($images)) {
            return view('admin.nodata', ['infoMessage' => "Please add images!"]);
        }

        $aboutData = [
            'about'   => $about,
            'images'  => $images
        ];

        return view('admin.about.edit', $aboutData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $file_id=null)
    {
        /**    update image_id block      */
        if ($file_id) {
            $file = File::find($file_id);
            if (!$file) {
                return redirect(route('admin_file_list'))->withError('Wrong file');
            }

            $about = About::single();
            if ($about->exists()) {
                $about->update([
                    'image_id' => $file_id
                ]);

                return redirect(route('admin_file_list'))->with(['status' => 'Active updated']);

            } else {
                return view('admin.nodata', ['error' => 'About is empty']);
            }
        }
        /** END    update image_id block      */

        $input = $request->validate([
            'about'      => 'required|string|max:2550',
            'email'      => 'required|string|max:255',
            'git'        => 'required|string|max:255',
            'linkdin'    => 'required|string|max:255',
            'telegram'   => 'required|string|max:255',
//            'letter_id'  => '',
            'image_id'   => '',
        ]);

        $about = About::single();
        if (!$about->exists()) {
            return redirect('admin_about_create');
        }

        $about->update([
            'about'     => $input['about'],
            'email'     => $input['email'],
            'git'       => $input['git'],
            'linkdin'   => $input['linkdin'],
            'telegram'  => $input['telegram'],
//            'letter_id' => $input['letter_id'],
            'image_id'  => $input['image_id'],
        ]);

        return redirect(route('admin_about_edit'));
    }


    /**
     *  edite additional params
     */
    public function editInfo(string $id)
    {
        $info = Info::find($id);

        return $info ? view('admin.info.edit', ['info' => $info])
            : redirect(route('admin'))->withError(__('Wrong info id'));
    }


    /**
     *  update additional params
     */
    public function updateInfo(Request $request, string $id)
    {
        $request->merge(['id' => $id]);
        $input = $request->validate([
            'id'          => 'required|exists:infos,id',
            'skills'      => 'required|string|max:2550',
            'libraries'   => 'required|string|max:2550',
            'tools'       => 'required|string|max:2550',
            'systems'     => 'required|string|max:255',
            'education'   => 'required|string|max:2550',
            'additional_edc' => 'required|string|max:2550',
            'languages'   => 'required|string|max:2550',
            'phone_a'     => 'required|string|max:255',
            'phone_b'     => 'required|string|max:255',
        ]);

        $info = Info::find($id);
        $input['languages'] = json_decode($input['languages'], true);
        $info->update($input);

        return redirect(route('admin_info_edit', ['id' => $id]));
    }
}
