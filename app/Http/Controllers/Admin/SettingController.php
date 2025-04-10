<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::all();

        return view('admin.settings.list', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.settings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255|min:3',
            'value' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:2550',
            'data'  => 'nullable|json'
        ]);

        $validated = array_filter($validated);

        if (!empty($validated)) {
            $setting = Setting::create($validated);

            if ($setting) {
                return redirect(route('admin_setting_list'))->withStatus('Settings created!');
            }
        }

        return redirect(route('admin_setting_create'))->with(['error' => 'Failed create sett']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.settings.edit', ['setting' => Setting::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->merge(['id' => $id]);
        $validated = $request->validate([
            'id'  => 'required|exists:settings,id',
            'name'  => 'required|string|max:255|min:3',
            'value' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:2550',
            'data'  => 'nullable'
        ]);

        $validated = array_filter($validated);

        if (!empty($validated)) {
            $setting = Setting::where('id', $id)
                ->update($validated);

            if ($setting) {
                return redirect(route('admin_setting_list'))->withStatus('Settings created!');
            }
        }

        return redirect(route('admin_setting_create'))->with(['error' => 'Failed create sett']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $setting = Setting::find($id);
        if ($setting) {
            $setting->delete();
            return redirect(route('admin_setting_list'))->withStatus('Settings deleted!');
        }
        return redirect(route('admin_setting_list'))->with(['error' => 'Failed delete sett']);
    }
}
