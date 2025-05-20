@extends('admin.dashboard')

@section('dashboard')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{__('Files')}}</h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{route('admin_file_create')}}" class="btn btn-sm btn-outline-primary">
                    {{__("Add File")}}
                </a>
            </div>
        </div>
    </div>

    @php($num = 1)
    @if(count($files))
        <div class="table-responsive small">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID</th>
                    <th scope="col">{{__('Original')}}</th>
                    <th scope="col">{{__('Type')}}</th>
                    <th scope="col">{{__('Preview')}}</th>
                    <th scope="col" title="{{__('Actions')}}">
                        <svg class="bi text-primary"><use xlink:href="#actions"/></svg>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($files as $file)
                    <tr>
                        <td>{{$num}}</td>
                        <td>{{$file->id}}</td>
                        <td>{{ \Illuminate\Support\Str::limit($file->original, 10, '...') }}</td>
                        <td>{{$file->type}}</td>
                        @if($file->type == \App\Models\File::IMG_TYPE)
                            @php($activeClass = $about->image_id == $file->id ? 'preview-active' : '')
                            <td>
                                <form id="setActive_{{$file->id}}" action="{{route('admin_about_update', ['file_id' => $file->id])}}"  method="POST">
                                    @csrf
                                    <a title="Set as active" onclick="document.getElementById('setActive_{{$file->id}}').submit(); return false;">
                                        <img class="preview-photo {{$activeClass}}" src="{{Storage::disk(config('filesystems.default'))->url($file->name)}}" alt="" width="50px">
                                    </a>
                                </form>
                            </td>
                        @else
                            <td>{{'no preview'}}</td>
                        @endif
                        <td>
                            @php($disabled = $file->used() ? 'disabled' : '')
                            <form action="{{ route('admin_file_destroy', $file->id) }}" method="POST" onsubmit="return confirmDelete(event)">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-secondary btn-sm" {{$disabled}}>
                                    <svg class="bi"><use xlink:href="#trash"/></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @php($num++)
                @endforeach
                </tbody>
            </table>
        </div>

    @else

        <h2>{{__('No files')}}</h2>

    @endif

    <script>
        function confirmDelete(event) {
            event.preventDefault(); // Prevent form submission
            if (confirm("Are you sure you want to delete this item?")) {
                event.target.submit(); // Submit form if user confirms
            }
        }
    </script>

@endsection