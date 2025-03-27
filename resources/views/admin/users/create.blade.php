@extends('admin.dashboard')

@section('dashboard')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="h4 content-title">{{__('Users')}}</h4>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{route('admin_user_list')}}" class="btn btn-sm btn-outline-primary">
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
                <h5 class="card-title content-title">{{__('User creating')}}</h5>
            </div>

            <div class="card-body">

                <form role="form" action="{{ route('admin_user_store') }}" method="post">
                    @csrf

                    <div class="row">
                        {{-- NAME --}}
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{__('Name')}}</label>
                                <input name="name" type="text" class="form-control">
                            </div>
                        </div>

                        {{-- EMAIL --}}
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{__('Email')}}</label>
                                <input name="email" type="text" class="form-control">
                            </div>
                        </div>

                        {{-- ROLE --}}
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{__('Role')}}</label>
                                <select name="role_id"  class="form-select" aria-label="{{__('Role')}}">
                                    <option value="{{$defaultRole->id}}" selected>{{__($defaultRole->display_name)}}</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{__($role->display_name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-sm btn-outline-primary mt-3">CREATE</button>
                </form>
            </div>
        </div>
    </div>



@endsection