@extends('admin.dashboard')

@section('dashboard')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{__('Visitors')}}</h1>
        <div class="btn-group me-2">
            <a href="{{route('admin_visitor_list')}}" class="btn btn-sm btn-outline-primary">
                {{__("List")}}
            </a>
        </div>
    </div>


    @if(count($visitors))
        <div class="table-responsive small">

            <form method="GET" action="{{ route('admin_visitor_list') }}" class="mb-4">
                <input type="hidden" name="sort" value="{{ $sortOrder }}">
                <label for="per_page">{{__('Show by:')}} </label>
                <select name="per_page" id="per_page" onchange="this.form.submit()" class="border rounded px-2 py-1">
                    <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                    <option value="15" {{ $perPage == 15 ? 'selected' : '' }}>15</option>
                    <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20</option>
                </select>
            </form>

            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">IP</th>
                    <th scope="col">{{__('Location')}}</th>
                    <th scope="col">{{__('Hits')}}</th>
                    <th scope="col">{{__('Details')}}</th>
                    <th scope="col">{{__('Banned')}}</th>
                    <th>
                        <a href="{{ route('admin_visitor_list', ['sort' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                            {{__('VisitedDate')}}
                            @if($sortOrder === 'asc')
                                Old
                            @else
                                Fresh
                            @endif
                        </a>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($visitors as $visitor)
                    <tr>
                        <td>
                            {{ ($visitors->currentPage() - 1) * $visitors->perPage() + $loop->iteration }}
                        </td>
                        <td>{{$visitor->ip}}</td>
                        <td>{{$visitor->location}}</td>
                        <td>{{$visitor->hits}}</td>
                        <td>
                            <button class="btn btn-outline-secondary btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#visitorModal{{ $visitor->id }}"
                            >
                                {{__('Details')}}
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="visitorModal{{ $visitor->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $visitor->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel{{ $visitor->id }}">Visitor Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            <p><strong>IP:</strong> {{ $visitor->ip }}</p>
                                            <p><strong>Location:</strong> {{ $visitor->location }}</p>
                                            <p><strong>Hits:</strong> {{ $visitor->hits }}</p>
                                            <!-- Add more fields as needed -->
                                            @if(count($visitor->urls))
                                            <ul>
                                                @foreach($visitor->urls as $url)
                                                    <li><p><strong>{{$url->method}}</strong> <strong> {{$url->uri}}</strong></p></li>
                                                @endforeach
                                            </ul>
                                            @endif
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                        </td>
                        @php($banned = $visitor->banned ? 'banned' : 'active')
                        @php($ban    = $visitor->banned ? 0 : 1)
                        <td>
                            <form id="banned_{{$visitor->id}}" action="{{route('admin_visitor_ban_update', ['id' => $visitor->id, 'ban' => $ban])}}"  method="POST">
                                @csrf
                                <a class="btn btn-secondary btn-sm" title="Update banned" onclick="document.getElementById('banned_{{$visitor->id}}').submit(); return false;">
                                    {{$banned}}
                                </a>
                            </form>
                        </td>
                        <td>{{$visitor->visited_date}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <!-- Pagination links -->
            <div class="mt-4">
                {{ $visitors->appends(['sort' => $sortOrder, 'per_page' => $perPage])->links('pagination::bootstrap-5') }}
            </div>

        </div>

    @else

        <h2>{{__('No visitors')}}</h2>

    @endif

@endsection
