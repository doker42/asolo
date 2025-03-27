@extends('admin.dashboard')

@section('dashboard')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{__('Works')}}</h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{route('admin_work_create')}}" class="btn btn-sm btn-outline-primary">
                    {{__("Add work")}}
                </a>
            </div>
        </div>
    </div>


    @php($num = 1)
    @if(count($works))
        <div class="table-responsive small">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID</th>
                    <th scope="col">{{__('Position')}}</th>
                    <th scope="col">{{__('Company Name')}}</th>
                    <th scope="col">{{__('Company Link')}}</th>
                    <th scope="col">{{__('Resp')}}</th>
                    <th scope="col">{{__('Start date')}}</th>
                    <th scope="col">{{__('Finish date')}}</th>
                    <th scope="col">{{__('Active')}}</th>
                    <th scope="col">{{__('Actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($works as $work)
                    <tr>
                        <td>{{$num}}</td>
                        <td>{{$work->id}}</td>
                        <td>{{$work->position}}</td>
                        <td>{{$work->company_name}}</td>
                        <td>{{ \Illuminate\Support\Str::limit($work->company_link, 10, '...') }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($work->resp, 10, '...') }}</td>
                        <td>{{$work->start_date}}</td>
                        <td>{{$work->finish_date}}</td>
                        <td>
                            @php($active = (bool)$work->active)
                            <button class="btn btn-outline-{{$active ? 'success' : 'secondary'}} btn-sm">
                                {{$active ? 'ON' : 'OFF'}}
                            </button>
                        </td>
                        <td>
                            <a class="btn-outline-secondary" href="{{ route('admin_work_edit', ['id' => $work->id]) }}">
                                <button class="btn btn-outline-warning btn-sm">
                                    <svg class="bi"><use xlink:href="#edit"/></svg>
                                </button>
                            </a>
                            <form action="{{ route('admin_work_destroy', $work->id) }}" method="POST" onsubmit="return confirmDelete(event)">
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
        <h2>{{__('No works')}}</h2>
    @endif

@endsection
