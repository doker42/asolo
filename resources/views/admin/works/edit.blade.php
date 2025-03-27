@extends('admin.dashboard')

@section('dashboard')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="h4 content-title">{{__('Works')}}</h4>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{route('admin_work_list')}}" class="btn btn-sm btn-outline-primary">
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
                <h5 class="card-title content-title">{{__('Work edit')}}</h5>
            </div>

            <div class="card-body">

                <form role="form" action="{{ route('admin_work_update', $work->id) }}" method="post">
                    @csrf
                    @method('POST')
                    <div class="row">
                        {{-- POSITION --}}
                        <div class="col-sm-12 mb-3">
                            <div class="form-group">
                                <label>{{__('Position')}}</label>
                                <input name="position" type="text" class="form-control" value="{{$work->position}}" required>
                            </div>
                        </div>
                        {{-- COMP NAME --}}
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label>{{__('Company name')}}</label>
                                <input name="company_name" type="text" class="form-control" value="{{$work->company_name}}" required>
                            </div>
                        </div>

                        {{-- COMP LINK --}}
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label>{{__('Company link')}}</label>
                                <input name="company_link" type="text" class="form-control" value="{{$work->company_link}}">
                            </div>
                        </div>

                        {{-- RESP --}}
                        <div class="col-sm-12 mb-3">
                            <label>{{__('Responsibilities')}}</label>
                            <div class="form-group">
                                <textarea name="resp" class="form-control" placeholder="{{'Responsibilities'}}" id="resp" style="height: 100px" required>{{$work->resp}}</textarea>
                            </div>
                        </div>

                        {{-- STACK --}}
                        <div class="col-sm-12 mb-3">
                            <label>{{__('Used stack')}}</label>
                            <div class="form-group">
                                <textarea name="stack" class="form-control" placeholder="{{'Stack'}}" id="stack" style="height: 100px" >{{$work->stack}}</textarea>
                            </div>
                        </div>

                        {{-- START DATE --}}
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label>{{__('Start date')}}</label>
                                <input name="start_date"
                                       type="text"
                                       class="form-control"
                                       value="{{\Carbon\Carbon::parse($work->start_date)->format('m-Y')}}">
                            </div>
                        </div>

                        {{-- FINISH DATE --}}
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label>{{__('Finish date')}}</label>
                                <input name="finish_date"
                                       type="text"
                                       class="form-control"
                                       @php( $finish_date = $work->finish_date === 'Present'
                                                ? ''
                                                : \Carbon\Carbon::parse($work->finish_date)->format('m-Y'))
                                       value="{{$finish_date}}">
                            </div>
                        </div>

                        {{-- ACTIVE --}}
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{__('Active')}}</label>
                                <div class="form-check form-switch mt-2">
                                    <input id="active" name="active"
                                           class="form-check-input"
                                           type="checkbox" role="switch"
                                           {{$work->active ? 'checked' : ''}}
                                    >
                                    <label class="form-check-label" for="active">{{__('Active status')}}</label>
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