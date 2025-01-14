@extends('admin.partials.master')
@section('title')
    Edit Content Page
@endsection
@section('main-content')
    <div class="container">
        <h1>Edit Page</h1>
        <form action="{{ route('admin.content.update', $content->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" value="{{ $content->title }}" required>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" class="form-control"  id="editor" required>{{ $content->content }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    var textarea = document.getElementById('editor');
    $(document).ready(function() {
        var textarea = document.getElementById('editor');
        sceditor.create(textarea, {
            format: 'bbcode',
            style: 'https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/content/default.min.css',
            emoticonsEnabled: false
        });
    });
</script>

<style>
    .sceditor-container {
        width: 100%!important;
        height: 500px!important;
        margin-top: 10px;
    }
</style>