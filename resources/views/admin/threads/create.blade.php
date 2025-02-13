@extends('admin.partials.master')

@section('title')
    Forum
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
                <h1>Create Thread</h1>
                <form action="{{ route('admin.threads.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea name="body" id="editor" class="form-control" id="editor" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
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
            format: 'xhtml',
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