@extends('frontend.partials.master')

@section('main-content')
    <div class="threads-create-page">
        <div id="content" class="page-threads-create">
            <div class="content_box">
                <div class="container-fluid pt-4">
                    <form method="POST" action="{{ route('threads.store') }}">
                        @csrf
                        <div class="form-group row mt-3">
                            <label for="title" class="form-label" style="">Title:</label>
                            <input type="text" class="form-control custom-input" id="title" name="title" placeholder="" required>
                            @error('title')
                                <span class="bg-danger mt-1 py-1 rounded-1 small text-center text-white">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group row mt-3">
                            <label for="body" class="form-label" style="">Body:</label>
                            <textarea name="body" id="body" class="form-control"></textarea>
                            @error('body')
                                <span class="bg-danger mt-1 py-1 rounded-1 small text-center text-white">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="submit-button mt-3 button">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .sceditor-container {
        width: 100%!important;
        min-height: 500px!important;
        margin-top: 10px;
    }

    .submit-button {
        padding: 5px 40px;
        background: red;
        color: white;
        border: none;
    }

    .submit-button:hover {
        background: black;
    }
</style>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    let editor;
    $(document).ready(function() {
        
        var textarea = document.getElementById('body');

        sceditor.create(textarea, {
            format: 'bbcode',
            style: 'https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/content/default.min.css',
            emoticonsEnabled: false
        });

    });
</script>


