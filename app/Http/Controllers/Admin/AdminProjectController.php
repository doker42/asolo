<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class AdminProjectController extends Controller
{
    public function index()
    {

//        $projects = Project::all();
//        dd($projects);

        return view('admin.projects.list', [
            'projects' => Project::all(),
        ]);
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {

//        dd($this->validatedData($request));


        $project = Project::create($this->validatedData($request));

        return redirect(route('admin_project_list'))
            ->withStatus(__('Project created!'));
    }

    public function edit(string $id)
    {
        $project = Project::find($id);

        if (!$project) {
            return redirect(route('admin_project_list'))
                ->withErrors(__('Failed to get project.'));
        }

        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, string $id)
    {
        $project = Project::find($id);

        if (!$project) {
            return redirect(route('admin_project_list'))
                ->withErrors(__('Failed to get project.'));
        }

        $project->update($this->validatedData($request));

        return redirect(route('admin_project_list'))
            ->withStatus(__('Project updated!'));
    }

    public function destroy(string $id)
    {
        $project = Project::find($id);

        if (!$project) {
            return redirect(route('admin_project_list'))
                ->withErrors(__('Failed to get project.'));
        }

        if ($project->delete()) {
            return redirect(route('admin_project_list'))
                ->withStatus(__('Project deleted!'));
        }

        return redirect(route('admin_project_list'))
            ->withErrors(__('Failed to delete project.'));
    }

    private function validatedData(Request $request): array
    {
        $data = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'link'        => ['nullable', 'url:http,https', 'max:2048'],
            'image'       => ['nullable', 'string', 'max:2048'],
        ]);

        $data['active'] = $request->boolean('active');

        return $data;
    }
}
