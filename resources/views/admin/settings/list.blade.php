@extends('admin.dashboard')

@section('dashboard')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{__('Settings')}}</h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{route('admin_setting_create')}}" class="btn btn-sm btn-outline-primary">
                    {{__("Add setting")}}
                </a>
            </div>
        </div>
    </div>

    @php($num = 1)
    @if(count($settings))
        <div class="table-responsive small">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID</th>
                    <th scope="col">{{__('Name')}}</th>
                    <th scope="col">{{__('Slug')}}</th>
                    <th scope="col">{{__('Description')}}</th>
                    <th scope="col">{{__('Value')}}</th>
                    <th scope="col">{{__('Values')}}</th>
                    <th scope="col">{{__('Data')}}</th>
                    <th scope="col">{{__('Actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($settings as $setting)
                    <tr>
                        <td>{{$num}}</td>
                        <td>{{$setting->id}}</td>
                        <td>{{$setting->name}}</td>
                        <td>{{$setting->slug}}</td>
                        <td>{{$setting->description}}</td>
                        <td>{{$setting->value}}</td>
                        <td>{{$setting->values}}</td>
                        <td>
                            @if(isset($setting->data))
                                <ul class="dot-none">
                                    @foreach ($setting->data as $key => $value)
                                        @php($value = is_array($value) ? implode('/', $value) : $value)
                                        <li>{{ $key }} : {{ $value }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </td>
                        <td>
                            <a class="btn-outline-secondary" href="{{ route('admin_setting_edit', ['id' => $setting->id]) }}">
                                <button class="btn btn-outline-warning btn-sm">
                                    <svg class="bi"><use xlink:href="#edit"/></svg>
                                </button>
                            </a>
                            <form action="{{ route('admin_setting_destroy', $setting->id) }}" method="POST" onsubmit="return confirmDelete(event)">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-secondary btn-sm">
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
        <h2>{{__('No settings')}}</h2>
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
