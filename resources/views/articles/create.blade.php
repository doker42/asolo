@extends('articles.basic')

@section('title', __('Article creating'))

@section('content')
    <div class="container py-4" style="max-width: 760px;">
        <h1 class="mb-4">Создать статью</h1>

        <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="text" name="title"  class="form-control mb-3" placeholder="{{__('Title')}}" required>
            <input type="text" name="author" class="form-control mb-3" placeholder="{{__('Author')}}">

            <input id="content" type="hidden" name="content">
            <trix-editor input="content" class="mb-3"></trix-editor>

            <button type="submit" class="btn btn-primary mt-2">{{__('Save')}}</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        let imageIndex = 1;

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
