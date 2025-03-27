@extends('admin.dashboard')

@section('dashboard')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="h4 content-title">{{__('Files')}}</h4>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{route('admin_file_list')}}" class="btn btn-sm btn-outline-primary">
                    {{__("Files")}}
                </a>
            </div>
        </div>
    </div>

    <!-- right column -->
    <div class="col-md-12">
        <!-- general form elements disabled -->
        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title content-title">{{__('File adding')}}</h5>
            </div>

            <div class="card-body">

                <form role="form" action="{{ route('admin_file_store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        {{-- FILE --}}
                        <div class="col-sm-12">
                            <label for="file" class="form-label">{{__('File')}}</label>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input class="form-control" name="file" type="file" id="file" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <select class="form-select" name="type" id="type" >
                                @foreach($types as $type)
                                <option value="{{$type}}">{{ucfirst($type)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-sm btn-outline-primary mt-3">Add</button>
                </form>
            </div>
        </div>
    </div>



@endsection
