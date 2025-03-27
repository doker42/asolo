@extends('admin.dashboard')

@section('dashboard')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{__('AboutMe')}}</h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                @if(isset($aboutReal) && $aboutReal)
                    <a href="{{route('admin_about_edit')}}" class="btn btn-sm btn-outline-primary">
                        {{__("Edit")}}
                    </a>
                @else
                    <a href="{{route('admin_about_create')}}" class="btn btn-sm btn-outline-primary">
                        {{__("Create")}}
                    </a>
                @endif
            </div>
        </div>
    </div>

@endsection