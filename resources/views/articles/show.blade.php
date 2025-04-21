@extends('articles.basic')

@section('title', $article->title)

@section('content')
    <div class="container py-5" style="max-width: 760px; font-family: 'Segoe UI', sans-serif;">

        <!-- Заголовок -->
        <h1 class="fw-bold mb-3" style="font-size: 2.5rem;">
            {{ $article->title }}
        </h1>

        <!-- Автор и дата -->
        <div class="text-muted mb-4" style="font-size: 0.95rem;">
            {{__('created ')}} &middot; {{ $article->created_at->format('d.m.Y') }}
        </div>

        <!-- Контент с заменой плейсхолдеров -->
        <div class="article-content fs-5 lh-lg">
            @php
                $content = $article->content;
                foreach ($article->images as $image) {
                    $imgTag = "<div class='text-center my-4'>
                                <img src='" . asset('storage/' . $image->image_path) . "' class='img-fluid rounded' style='max-height: 500px;'>
                               </div>";
                    $content = str_replace("[" . $image->placeholder . "]", $imgTag, $content);
                }
            @endphp

            @php
                $formattedContent = preg_replace_callback('/\[code\](.*?)\[\/code\]/s', function ($matches) {
                    $rawCode = html_entity_decode($matches[1]); // декодируем сущности
                    return '<div class="code-block-wrapper mb-3">
                        <button class="copy-btn position-absolute top-0 end-0 mt-2 me-2">📋</button>
                        <code class="code-block  d-block">'
                        . e($rawCode) .
                        '</code>
                    </div>';
                }, $content);
            @endphp

            <div class="article-content">
                {!! $formattedContent !!}
            </div>

        </div>

        <a href="{{route('articles.index')}}" class="btn btn-sm btn-outline-primary mt-2">{{__('List')}}</a>
        @if(auth()->check())
            <a href="{{route('articles.edit', $article)}}" class="btn btn-sm btn-outline-warning mt-2">{{__('Edit')}}</a>
            <form action="{{ route('articles.destroy', $article) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить статью?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger mt-2">{{__('Delete')}}</button>
            </form>
        @endif

    </div>

@endsection
