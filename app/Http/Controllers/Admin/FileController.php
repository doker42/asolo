<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class FileController extends Controller
{
    public function index()
    {
        return view('admin.files.list', ['files' => File::all(), 'about' => About::single()]);
    }

    public function create()
    {
        return view('admin.files.create', ['types' => File::TYPES]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => ['required', Rule::in(File::TYPES)]
        ]);
        $type = $request->type;
        $typeRules = match ($type) {
            File::IMG_TYPE    => ['required', 'mimes:png,jpeg,jpg', 'max:5000'],
            File::LETTER_TYPE => ['required', 'mimes:pdf', 'max:5000']
        };
        $request->validate([
            'file' => $typeRules
        ]);
        $file = $request->file;
        $original = $file->getClientOriginalName();
        $name = Storage::disk(config('filesystems.default'))->put($type, $file);
        if ($name) {
            $file = File::create([
                'name'     => $name,
                'original' => $original,
                'type'     => $type
            ]);
            if ($file) {
                return redirect(route('admin_file_list'))->with(['status' => __('File added')]);
            }
        }
        return redirect(route('admin_file_create'))->withErrors(__('Filed to add file'));
    }

    public function destroy(string $id)
    {
        $file = File::find($id);

        if (!$file->used()) {
            Storage::disk('public')->delete($file->name);
            $file->delete();
            return redirect(route('admin_file_list'))->with(['status' => 'Ok']);
        }
        return redirect(route('admin_file_list'))->withError(__('File is used'));
    }

}
