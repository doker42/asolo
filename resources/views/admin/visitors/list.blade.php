@extends('admin.dashboard')

@section('dashboard')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{__('Visitors')}}</h1>
        <div class="btn-group me-2">
            <a href="{{route('admin_visitor_list')}}" class="btn btn-sm btn-outline-primary">
                {{__("List")}}
            </a>
        </div>
    </div>


    @php($num = 1)
    @if(count($visitors))
        <div class="table-responsive small">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">IP</th>
                    <th scope="col">{{__('Location')}}</th>
                    <th scope="col">{{__('Hits')}}</th>
                    <th scope="col">{{__('VisitedDate')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($visitors as $visitor)
                    <tr>
                        <td>{{$num}}</td>
                        <td>{{$visitor->ip}}</td>
                        <td>{{$visitor->location}}</td>
                        <td>{{$visitor->hits}}</td>
                        <td>{{$visitor->visited_date}}</td>
                    </tr>
                    @php($num++)
                @endforeach
                </tbody>
            </table>
        </div>

    @else

        <h2>{{__('No visitors')}}</h2>

    @endif

@endsection
