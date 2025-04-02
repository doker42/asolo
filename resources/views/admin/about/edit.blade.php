@extends('admin.dashboard')

@section('dashboard')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="h4 content-title">{{__('About')}}</h4>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{route('admin')}}" class="btn btn-sm btn-outline-primary">
                    {{__("Dashboard")}}
                </a>
            </div>
        </div>
    </div>

    <!-- right column -->
    <div class="col-md-12">
        <!-- general form elements disabled -->
        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title content-title">{{__('About edit')}}</h5>
            </div>

            <div class="card-body">

                <form role="form" action="{{ route('admin_about_update') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        {{-- ABOUT --}}
                        <div class="col-sm-12 mb-3">
                            <div class="form-group">
                                <div class="form-floating">
                                    <textarea name="about" class="form-control" placeholder="" id="about" style="height: 100px">{{$about->about}}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- EMAIL --}}
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label>{{__('Email')}}</label>
                                <input name="email" type="text" class="form-control" value="{{$about->email}}">
                            </div>
                        </div>

                        {{-- GIT --}}
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label>{{__('Git')}}</label>
                                <input name="git" type="text" class="form-control" value="{{$about->git}}">
                            </div>
                        </div>

                        {{-- LINKDIN --}}
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label>{{__('LinkdIn')}}</label>
                                <input name="linkdin" type="text" class="form-control" value="{{$about->linkdin}}">
                            </div>
                        </div>

                        {{-- TELEGR --}}
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label>{{__('Telegram')}}</label>
                                <input name="telegram" type="text" class="form-control" value="{{$about->telegram}}">
                            </div>
                        </div>

                        {{-- IMG --}}
                        <div class="col-sm-6 mb-3">
                            <label for="image" class="form-label">{{__('Image')}}</label>
                            <select class="form-select" name="image_id" id="image" >
                                <option value="{{$about->image_id}}">{{$about->image?->original}}</option>
                                @foreach($images as $image)
                                    <option value="{{$image->id}}">{{$image?->original}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-sm btn-outline-primary mt-3">{{__('UPDATE')}}</button>
                </form>
            </div>
        </div>
    </div>



@endsection