@extends('articles.basic')

@section('title', __('Article edition'))

@section('content')
    <div class="container py-4" style="max-width: 760px;">
        <h1 class="mb-4">Редактировать статью</h1>

        <form action="{{ route('articles.update', $article) }}" method="POST">
            @csrf
{{--            @method('PUT')--}}

            <input type="text" name="title" class="form-control mb-3" value="{{ old('title', $article->title) }}" required>
            <input type="text" name="author" class="form-control mb-3" value="{{ old('author', $article->author) }}" required>

            <input id="content" type="hidden" name="content" value="{{ old('content', $article->content) }}">
            <trix-editor input="content" class="mb-3"></trix-editor>

            <button type="submit" class="btn btn-primary mt-2">Сохранить</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        let imageIndex = 1000; // чтобы новые плейсхолдеры не конфликтовали

        document.addEventListener("trix-attachment-add", function (event) {
            if (event.attachment.file) {
                uploadImage(event.attachment);
            }
        });

        function uploadImage(attachment) {
            const file = attachment.file;
            const form = new FormData();
            form.append("image", file);
            form.append("_token", "{{ csrf_token() }}");

            fetch("{{ route('articles.image.upload') }}", {
                method: "POST",
                body: form
            })
                .then(response => response.json())
                .then(data => {
                    if (data.placeholder) {
                        const editor = document.querySelector("trix-editor").editor;
                        editor.insertString(data.placeholder + " ");
                    }
                })
                .catch(error => {
                    console.error("Upload failed:", error);
                });
        }
    </script>
@endpush
