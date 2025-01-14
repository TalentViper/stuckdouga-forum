@extends('admin.partials.master')

@section('title')
    Website
@endsection
@section('website')
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
            <div class="row">
                <div class="col-sm-xs-12 col-md-12">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <a href="{{route('admin.website')}}">Back</a>  
                            <p>Edit Page</p>                          
                        </div>
                        <div class="card-body p-5">
                        <!-- Add form fields for editing page content -->
                            <form id="editPageForm" action="{{ route('admin.website.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" id="editPageId" value="{{ $page->id }}">
                                <div class="form-group">
                                    <label for="editTitle">Title</label>
                                    <input type="text" class="form-control" id="editTitle" name="title" value="{{ $page->title }}">
                                </div>
                                <div class="form-group">
                                    <label for="editSlug">Slug</label>
                                    <input type="text" class="form-control" id="editSlug" name="slug" value="{{ $page->slug }}" disabled>
                                </div>                                
                                <div class="form-group">
                                    <label for="editContent">Content</label>
                                    <textarea class="form-control" id="editContent" name="content" rows="20">{{ $page->content }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="editUrl">URL</label>
                                    <input type="text" class="form-control" id="editUrl" name="url" value="{{ $page->url }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="is_active">Active Status</label>
                                    <select class="form-control" id="editIsActive" name="is_active" required>
                                        <option value="1" {{ $page->is_active == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $page->is_active == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                                <br><br>
                                <button type="submit" class="btn btn-primary" id="saveChangesBtn">Save Changes</button>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@include('admin.common.delete-ajax')
@include('admin.common.common-modal')
@push('script')
<script src="https://cdn.tiny.cloud/1/jcnsljt3816uh8n8r9w6by1t4c904cjsuyiqkxgeab5okg5n/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
tinymce.init({
    selector: 'textarea#editContent', // Replace with the ID of your textarea
    height: 500, // Set the desired height
    menubar: false, // Hide the menubar
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table paste code help wordcount'
    ],
    toolbar: 'undo redo | formatselect | ' +
        'image code bold italic backcolor | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist outdent indent| ' +
        'removeformat | help',
    images_upload_url: '{!! route('image.upload') !!}', // URL for the Laravel image upload endpoint
    images_upload_handler: function (blobInfo, success, failure) {
        var xhr, formData;

        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', '{!! route('image.upload') !!}'); // Update the URL to your Laravel endpoint

        // Set the CSRF token in the request headers
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

        xhr.onload = function () {
            var json;

            if (xhr.status !== 200) {
                failure('HTTP Error: ' + xhr.status);
                return;
            }

            json = JSON.parse(xhr.responseText);

            if (!json || typeof json.location !== 'string') {
                failure('Invalid JSON: ' + xhr.responseText);
                return;
            }

            success(json.location);
        };

        formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());

        xhr.send(formData);
    },
});

</script>
@endpush