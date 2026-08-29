@extends('admin.dashboard')

@section('dashboard')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="h4 content-title">{{__('Projects')}}</h4>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{route('admin_project_list')}}" class="btn btn-sm btn-outline-primary">
                    {{__("List")}}
                </a>
            </div>
        </div>
    </div>

    <!-- right column -->
    <div class="col-md-12">
        <!-- general form elements disabled -->
        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title content-title">{{__('Project creating')}}</h5>
            </div>

            <div class="card-body">

                <form role="form" action="{{ route('admin_project_store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12 mb-3">
                            <div class="form-group">
                                <label for="title">{{__('Title')}}</label>
                                <input id="title" name="title" type="text" class="form-control" value="{{old('title')}}" required>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <div class="form-group">
                                <label for="description">{{__('Description')}}</label>
                                <textarea id="description" name="description" class="form-control" style="height: 100px">{{old('description')}}</textarea>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="link">{{__('Project Link')}}</label>
                                <input id="link" name="link" type="url" class="form-control" value="{{old('link')}}" placeholder="https://example.com">
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="image">{{__('Image')}}</label>
                                <input id="image" name="image" type="text" class="form-control" value="{{old('image')}}" placeholder="{{__('Image URL or path')}}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{__('Active')}}</label>
                                <div class="form-check form-switch mt-2">
                                    <input name="active" class="form-check-input" type="checkbox" role="switch" id="active" @checked(old('active'))>
                                    <label class="form-check-label" for="active">{{__('Active status')}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-outline-primary mt-3">Add</button>
                </form>
            </div>
        </div>
    </div>

@endsection
