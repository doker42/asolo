@extends('articles.basic')

@section('title', 'Статьи')

@section('content')
    <div class="container py-4">

        <h1 class="mb-4">{{__('All articles')}}</h1>

        @if(auth()->check())
            <p>Привет, {{ auth()->user()->name }}!</p>
            <a href="{{route('articles.create')}}" class="btn btn-sm btn-outline-primary">{{__('Add new')}}</a>
            @php $adminMode = true @endphp
        @else
            @php $adminMode = false @endphp
        @endif

        <div class="row row-cols-1 row-cols-md-2 g-4">

            @foreach($articles as $article)
                <div class="col">
                    @php
                        $borderPublished = $article->published && $adminMode ? 'border-published' : '';
                    @endphp
                    <div class="card h-100 shadow-sm {{$borderPublished}}">
                        @php
                            $firstImage = $article->images->first();
                            $imgSrc = $firstImage
                                ? asset('storage/' . $firstImage->image_path)
                                : asset('assets/img/default/pexel.jpg');
                            $text = $article->content;
                            $text = preg_replace('/\[image_\d+\]/', '', $text);
                            $text = strip_tags($text);
                            $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                            $text = preg_replace('/\s+/', ' ', $text);
                            $preview = \Illuminate\Support\Str::limit(trim($text), 150);
                        @endphp

                        <img src="{{ $imgSrc }}"
                             class="card-img-top image-list"
                             alt="Превью">

                        <div class="card-body">
                            <h5 class="card-title">{{ $article->title }}</h5>
                            <p class="card-text text-muted small">{{ $preview }}</p>
                            <a href="{{ route('articles.show', $article) }}" class="btn btn-sm btn-outline-primary mt-2">{{__('Read')}}</a>
                            @if(auth()->check())
                                <a href="{{route('articles.edit', $article)}}" class="btn btn-sm btn-outline-warning mt-2">{{__('Edit')}}</a>
                                <form action="{{ route('articles.destroy', $article) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить статью?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger mt-2">{{__('Delete')}}</button>
                                </form>

                                @php
                                    $published = $article->published ? 0 : 1;
                                    $action    = $article->published ? __('Published') : __('Draft');
                                    $color     = $article->published ? 'success' : 'secondary';
                                @endphp

                                <button class="btn btn-sm toggle-published-btn {{ $article->published ? 'btn-success' : 'btn-secondary' }} mt-2"
                                        data-id="{{ $article->id }}">
                                    {{$action}}
                                </button>
                            @endif
                        </div>

                    </div>
                </div>
            @endforeach

        </div>

        <div class="mt-4">
            {{ $articles->links() }}
        </div>
    </div>

    <script>
        document.querySelectorAll('.toggle-published-btn').forEach(button => {
            button.addEventListener('click', function () {
                const articleId = this.dataset.id;
                const btn = this;
                const cardDiv = btn.closest('.card');

                fetch(`/articles/${articleId}/toggle-published`, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'success') {
                            // Обновляем текст и стиль кнопки
                            if (data.published) {
                                btn.textContent = 'Published';
                                btn.classList.remove('btn-secondary');
                                btn.classList.add('btn-success');
                                cardDiv.classList.add('border-published');
                            } else {
                                btn.textContent = 'Draft';
                                btn.classList.remove('btn-success');
                                btn.classList.add('btn-secondary');
                                cardDiv.classList.remove('border-published');
                            }
                        }
                    })
                    .catch(() => {
                        alert('Ошибка при обновлении публикации');
                    });
            });
        });
    </script>

@endsection

@push('scripts')


@endpush