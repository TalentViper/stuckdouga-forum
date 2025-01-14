@extends('admin.partials.master')

@section('title')
    Edit Thread
@endsection
@section('bookings')
    active
@endsection
@php
    if(isset($_GET['q'])){
        $q          = $_GET['q'];
    }
@endphp
@section('main-content')
    <section class="section">
        <div class="section-body">
            <div class="container">
                <h1>Edit Thread</h1>
                <form action="{{ route('admin.threads.update', $thread->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ $thread->title }}" required>
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea name="body" id="editor" class="form-control" required>{{ $thread->body }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </section>
@endsection
@include('admin.common.delete-ajax')
@include('admin.common.common-modal')
@push('script')
<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();

        var textarea = document.getElementById('editor');
        sceditor.create(textarea, {
            format: 'bbcode',
            style: 'https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/content/default.min.css',
            emoticonsEnabled: false
        });
    });
</script>
@endpush

<style>
    .sceditor-container {
        width: 100%!important;
        height: 500px!important;
        margin-top: 10px;
    }
</style>
