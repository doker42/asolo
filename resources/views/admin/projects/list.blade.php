@extends('admin.dashboard')

@section('dashboard')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{__('Projects')}}</h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{route('admin_project_create')}}" class="btn btn-sm btn-outline-primary">
                    {{__("Add project")}}
                </a>
            </div>
        </div>
    </div>


    @php($num = 1)
    @if(count($projects))
        <div class="table-responsive small">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID</th>
                    <th scope="col">{{__('Title')}}</th>
                    <th scope="col">{{__('Description')}}</th>
                    <th scope="col">{{__('Project Link')}}</th>
                    <th scope="col">{{__('Image')}}</th>
                    <th scope="col">{{__('Active')}}</th>
                    <th scope="col">{{__('Actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($projects as $project)
                    <tr>
                        <td>{{$num}}</td>
                        <td>{{$project->id}}</td>
                        <td>{{$project->title}}</td>
                        <td>{{$project->description}}</td>
                        <td>{{ \Illuminate\Support\Str::limit($project->link, 10, '...') }}</td>
                        <td>{{"$project->image"}}</td>
                        <td>
                            @php($active = (bool)$project->active)
                            <button class="btn btn-outline-{{$active ? 'success' : 'secondary'}} btn-sm">
                                {{$active ? 'ON' : 'OFF'}}
                            </button>
                        </td>
                        <td>
                            <a class="btn-outline-secondary" href="{{ route('admin_project_edit', ['id' => $project->id]) }}">
                                <button class="btn btn-outline-warning btn-sm">
                                    <svg class="bi"><use xlink:href="#edit"/></svg>
                                </button>
                            </a>
                            <form action="{{ route('admin_project_destroy', $project->id) }}" method="POST" onsubmit="return confirmDelete(event)">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-secondary btn-sm">
                                    <svg class="bi"><use xlink:href="#trash"/></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @php($num++)
                @endforeach
                </tbody>
            </table>
        </div>

    @else
        <h2>{{__('No projects')}}</h2>
    @endif

@endsection
