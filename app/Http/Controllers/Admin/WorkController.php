<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Work;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $works = Work::all();
        return view('admin.works.list', ['works' => $works]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.works.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'position'     => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'company_link' => 'string|max:255|url:http,https',
            'resp'         => 'required|string|max:2550',
            'stack'        => 'required|string|max:2550',
            'start_date'   =>  ['required', 'date_format:m-Y'],
            'finish_date'  =>  ['nullable', 'date_format:m-Y'],
            'active'       => ''
        ]);

        if (isset($input['active']) && $input['active'] == 'on') {
            $input['active'] = 1;
        }

        $work = Work::create($input);

        if ($work) {
            return redirect(route('admin_work_list'))->with(['status' => __("All ok!")]);
        }

        return redirect(route('admin_work_create'))->withErrors(__('Failed to create work'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Work $work)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $work = Work::find($id);
        if ($work) {
            return view('admin.works.edit', ['work' => $work]);
        }
        return redirect(route('admin_work_list'))->withErrors('Failed get work!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->merge(['id' => $id]);
        $input = $request->validate([
            'id'           => 'exists:works,id',
            'position'     => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'company_link' => 'nullable|string|max:255|url:http,https',
            'resp'         => 'required|string|max:2550',
            'stack'        => 'required|string|max:2550',
            'start_date'   =>  ['required', 'date_format:m-Y'],
            'finish_date'  =>  ['nullable', 'date_format:m-Y'],
            'active'       => ''
        ]);

        if (isset($input['active']) && $input['active'] == 'on') {
            $input['active'] = 1;
        } else {
            $input['active'] = 0;
        }

        $work = Work::find($id);

        if ($work->update($input)) {
            return redirect(route('admin_work_list'))->with(['status' => __("All ok!")]);
        }

        return redirect(route('admin_work_edit', ['id' => $work->id]))->withErrors(__('Failed to update work'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $work = Work::find($id);

        if ($work->delete()) {
            return redirect(route('admin_work_list'))->with('status', __('Work was deleted'));
        }
        return redirect(route('admin_work_list'))->withErrors(__('Failed to delete work'));
    }
}
