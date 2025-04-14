<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Cache;


class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sortOrder = $request->get('sort', 'desc');
        $perPage   = $request->get('per_page', 15);
        $visitors = Visitor::orderBy('visited_date', $sortOrder)
            ->paginate($perPage)
            ->appends(['sort' => $sortOrder]);

        $siteUrls = config('admin.site_urls');

        return view('admin.visitors.list', compact('visitors', 'sortOrder', 'perPage', 'siteUrls'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Visitor $visitor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Visitor $visitor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Visitor $visitor)
    {
        //
    }

    public function banUpdate(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|string|exists:visitors,id',
            'ban' => ['required', Rule::in([0,1])] ,
        ]);

        $visitor = Visitor::find($validated['id']);
        $visitor->update(['banned' => $validated['ban']]);
        $this->updateBanList();

        return redirect(route('admin_visitor_list'));
    }


    protected function updateBanList()
    {
        if (Cache::has(Visitor::BAN_LIST)) {
            Cache::forget(Visitor::BAN_LIST);
        }

        $banned = Visitor::where('banned', true)
            ->get()
            ->pluck('ip')
            ->toArray();

        Cache::forever(Visitor::BAN_LIST, $banned);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Visitor $visitor)
    {
        //
    }
}
