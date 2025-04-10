@extends('admin.dashboard')

@section('dashboard')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="h4 content-title">{{__('Settings')}}</h4>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{route('admin_setting_list')}}" class="btn btn-sm btn-outline-primary">
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
                <h5 class="card-title content-title">{{__('Setting edit')}}</h5>
            </div>

            <div class="card-body">

                <form role="form" action="{{ route('admin_setting_update', $setting->id) }}" method="post">
                    @csrf
                    @method('POST')
                    <div class="row">
                        {{-- NAME --}}
                        <div class="col-sm-12 mb-3">
                            <div class="form-group">
                                <label>{{__('Name')}}</label>
                                <input name="name" type="text" class="form-control" value="{{$setting->name}}" required>
                            </div>
                        </div>
                        {{-- DESCR --}}
                        <div class="col-sm-12 mb-3">
                            <label>{{__('Description')}}</label>
                            <div class="form-group">
                                <textarea name="description" class="form-control" placeholder="{{'Description'}}" style="height: 100px">{{$setting->description}}</textarea>
                            </div>
                        </div>
                        {{-- VALUE --}}
                        <div class="col-sm-12 mb-3">
                            <div class="form-group">
                                <label>{{__('Value')}}</label>
                                <input name="value" type="text" class="form-control" value="{{$setting->value}}">
                            </div>
                        </div>
                        {{-- DATA --}}
                        <div class="col-sm-12 mb-3">
                            <label>{{__('Data')}}</label>
                            <div class="form-group">
                                <textarea name="data" class="form-control" placeholder="{{'Data'}}" style="height: 100px">
                                    {{json_encode($setting->data)}}
                                </textarea>
                            </div>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-sm btn-outline-primary mt-3">{{__('UPDATE')}}</button>
                </form>
            </div>
        </div>
    </div>

@endsection