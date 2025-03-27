@extends('admin.dashboard')

@section('dashboard')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="h4 content-title">{{__('Info')}}</h4>
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
                <h5 class="card-title content-title">{{__('Info edit')}}</h5>
            </div>

            <div class="card-body">

                <form role="form" action="{{ route('admin_info_update', $info->id) }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        {{-- SKILLS --}}
                        <div class="col-sm-12 mb-3">
                            <div class="form-group">
                                <label>{{__('Skills')}}</label>
                                <div class="form-floating">
                                    <textarea name="skills" class="form-control" placeholder="" id="skills" style="height: 100px">{{$info->skills}}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- LIBS --}}
                        <div class="col-sm-12 mb-3">
                            <div class="form-group">
                                <label>{{__('Libraries')}}</label>
                                <div class="form-floating">
                                    <textarea name="libraries" class="form-control" placeholder="" id="libraries" style="height: 100px">{{$info->libraries}}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- TOOLS --}}
                        <div class="col-sm-12 mb-3">
                            <div class="form-group">
                                <label>{{__('Tools')}}</label>
                                <div class="form-floating">
                                    <textarea name="tools" class="form-control" placeholder="" id="tools" style="height: 100px">{{$info->tools}}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- SYS --}}
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label>{{__('OS\'s')}}</label>
                                <input name="systems" type="text" class="form-control" value="{{$info->systems}}">
                            </div>
                        </div>

                        {{-- EDUC --}}
                        <div class="col-sm-12 mb-3">
                            <div class="form-group">
                                <label>{{__('Education')}}</label>
                                <div class="form-floating">
                                    <textarea name="education" class="form-control" placeholder="" id="education" style="height: 100px">{{$info->education}}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- ADD_EDUC --}}
                        <div class="col-sm-12 mb-3">
                            <div class="form-group">
                                <label>{{__('Additional education')}}</label>
                                <div class="form-floating">
                                    <textarea name="additional_edc" class="form-control" placeholder="" id="additional_edc" style="height: 100px">{{$info->additional_edc}}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- LANGS --}}
                        <div class="col-sm-12 mb-3">
                            <div class="form-group">
                                <div class="form-floating">
{{--                                    @dump(json_encode($info->languages))--}}
                                    <textarea name="languages" class="form-control" placeholder="" id="languages" style="height: 100px">{{json_encode($info->languages)}}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- PHONE_A --}}
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label>{{__('Phone_A')}}</label>
                                <input name="phone_a" type="text" class="form-control" value="{{$info->phone_a}}">
                            </div>
                        </div>

                        {{-- PHONE_B --}}
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label>{{__('Phone_B')}}</label>
                                <input name="phone_b" type="text" class="form-control" value="{{$info->phone_b}}">
                            </div>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-sm btn-outline-primary mt-3">{{__('UPDATE')}}</button>
                </form>
            </div>
        </div>
    </div>

@endsection