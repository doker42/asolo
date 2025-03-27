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
                <h5 class="card-title content-title">{{__('User edit')}}</h5>
            </div>

            <div class="card-body">

                <form role="form" action="{{ route('admin_user_update', $user->id) }}" method="post">
                    @csrf

                    <div class="row">
                        {{-- NAME --}}
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{__('Name')}}</label>
                                <input name="name" type="text" class="form-control" value="{{$user->name}}">
                            </div>
                        </div>

                        {{-- EMAIL --}}
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{__('Email')}}</label>
                                <input name="email" type="text" class="form-control" value="{{$user->email}}">
                            </div>
                        </div>

                        {{-- ROLE --}}
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{__('Role')}}</label>
                                <select name="role_id" class="form-select" aria-label="{{__('Role')}}">
                                    <option value="{{$user->role->id}}" selected>{{__($user->role->display_name)}}</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{__($role->display_name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- DELETED SOFT --}}
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{__('Deleted')}}</label>
                                @if ($user->deleted_at)
                                    @php($deleted = 'checked')
                                @else
                                    @php($deleted = '')
                                @endif
                                <div class="form-check form-switch mt-2">
                                    <input name="deleted" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" {{$deleted}}>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">{{__('Soft deleting status')}}</label>
                                </div>

                            </div>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-sm btn-outline-primary mt-3">{{__('UPDATE')}}</button>
                </form>
            </div>
        </div>
    </div>



@endsection