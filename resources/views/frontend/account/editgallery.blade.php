@extends('frontend.partials.master')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://icons.getbootstrap.com/assets/font/bootstrap-icons.min.css">
@section('main-content')
<main id="main" class="main-content">

    <div id="content" class="page-account-gallery">
        <div class="content_box">
            <div class="container-fluit p-5 pt-4">
                <div class="row">
                    @include('frontend.partials.sidebar1')
                    <div class="col-md-10 center primary p-4">
                        <h2>GALLERIES 
                            <button id="toggleButton" class="toggle-button flex-end">+</button>
                        </h2>
                        <div id="uploadSection" style="display: none;">
                            <form id="galleryForm" method="POST" action="{{ route('galleries.update', $gallery->id) }}" enctype="multipart/form-data">
                                <h5 class="mt-3 mb-3">UPDATE GALLERY</h5>
                                @csrf
                                @method('PUT')
                                <div class="gallery-form">
                                    <div class="mb-3 row form-group">
                                        <label for="title" class="col-sm-2 col-form-label">Title:</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="title" name="title" value="{{$gallery->gallery_name}}" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row form-group">
                                        <label for="description" class="col-sm-2 col-form-label">Description:</label>
                                        <div class="col-sm-7">
                                            <textarea class="form-control" id="description" name="description" rows="10">{{$gallery->description}}</textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="thumbnail" class="col-sm-2 col-form-label" name="thumbnail" required >Thumbnail:</label>
                                        <div class="col-sm-4">
                                            <img src="{{ static_asset('uploads') . '/' . $gallery->gallery_url }}" class="edit-img" width="100px"/>
                                            <button type="button" class="upload" id="thumbnail">Upload File</button>
                                            <div class="progress mt-2" style="display: none;">
                                                <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p style="color:#999">(200 <i class="bi bi-plus-lg"></i> 200px)</p>
                                        </div>
                                        <input type="text" class="form-control gallery-url" name="url" value="{{$gallery->gallery_url}}" hidden>
                                        <label class="col-sm-1"></label>
                                        <label for="series" class="col-sm-1 col-form-label" >Series:</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="series" name="series" value="{{$gallery->series}}" >
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="type" class="col-sm-2 col-form-label">Type:</label>
                                        <div class="col-sm-4">
                                            <select class="form-control" name="type">
                                                <option value="Classic" {{ $gallery->type == 'Classic' ? 'selected' : '' }}>Classic</option>
                                                <option value="Hidden" {{ $gallery->type == 'Hidden' ? 'selected' : '' }}>Hidden</option>
                                                <option value="Locked" {{ $gallery->type == 'Locked' ? 'selected' : '' }}>Locked</option>
                                            </select>
                                        </div>
                                        <label class="col-sm-1"></label>
                                        <label for="tags" class="col-sm-1 col-form-label">Tags:</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="tags" name="tags" value="{{$gallery->tags}}">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="create">Update Gallery</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
    .page-account-gallery h2 {
        width: 100%;
        border-bottom: 1px solid white;
        text-align: left;
    }

    .page-account-gallery input ,.page-account-gallery textarea, .page-account-gallery select  {
        border-radius: 0px;
    }

    .page-account-gallery .upload, .page-account-gallery .create {
        padding: 5px 40px;
        background: red;
        color: white;
        float: left;
    }

    .page-account-gallery .create {
        float: right;
    }

    .page-account-gallery h5 {
        text-align: left;
    }

    .col-form-label {
        text-align: left;
    }

    .page-account-gallery form {
        padding-bottom: 50px;
        border-bottom: 1px solid white;
    }

    .page-account-gallery table td,.page-account-gallery table th {
        background: transparent!important;
        color: white;
        vertical-align: middle;
    }

    .page-account-gallery table a {
        color: white;
        text-decoration: none;
        margin-right: 10px;
        font-size: 30px
    }

    .progress {
        height: 20px;
        background-color: #e9ecef;
        border-radius: 5px;
        overflow: hidden;
        margin-top: 10px;
    }

    .progress-bar {
        height: 100%;
        background-color: #007bff;
        text-align: center;
        line-height: 20px;
        color: white;
    }

    .toggle-button {
        background: red;
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        font-size: 20px;
        float: right;
        margin-top: -10px;
    }

    td a:hover {
        opacity: 0.65;
    }

    h1, h2, h3 {
        font-family: 'DrukTextWideBold', sans-serif;
    }

    .bi-plus-lg::before {
        transform: rotate(45deg);
    }

    .edit-img {
        display: block;
        width: 200px;
        margin: 0 auto;
        margin-bottom: 20px;
    }
</style>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {

        $("#tags").tagsinput('items');

        $('.delete-button').on('click', function(e) {
            e.preventDefault();
            var itemId = $(this).data('id');
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var baseRouteUrl = "{{ route('galleries.destroy', ['gallery' => 'PLACEHOLDER']) }}";

            var fullRouteUrl = baseRouteUrl.replace('PLACEHOLDER', itemId);
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'red',
                cancelButtonColor: 'grey',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: fullRouteUrl,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(response) {
                            Swal.fire({
                                    title: 'Deleted!',
                                    text: 'Your file has been deleted.',
                                    icon: 'success',
                                    confirmButtonColor: 'red',
                                }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                    title: 'Error',
                                    text: 'Something went wrong.',
                                    icon: 'error',
                                    confirmButtonColor: 'grey',
                                })
                        }
                    });
                }
            });
        });

        $("#toggleButton").on('click', function() {
            $("#uploadSection").toggle();
            $(this).text($(this).text() == '+' ? '-' : '+');
        });

        $("#toggleButton").trigger('click');

        $("#thumbnail").on('click', function() {
            var input = document.createElement('input');
            input.type = 'file';
            input.onchange = function(event) {
                var file = event.target.files[0];
                var formData = new FormData();
                formData.append('thumbnail', file);

                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('uploadItems') }}', true);
                xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

                // Handle progress events
                xhr.upload.onprogress = function(event) {
                    if (event.lengthComputable) {
                        var percentComplete = (event.loaded / event.total) * 100;
                        document.querySelector('.progress').style.display = 'block';
                        document.querySelector('.progress-bar').style.width = percentComplete + '%';
                        document.querySelector('.progress-bar').setAttribute('aria-valuenow', percentComplete);
                        document.querySelector('.progress-bar').innerText = Math.round(percentComplete) + '%';
                    }
                };

                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var responseData = JSON.parse(xhr.responseText);
                        $('.edit-img').attr("src", '{{ static_asset('uploads') }}' + '/' + responseData.path);
                        $(".gallery-url").val(responseData.path);
                        console.log('File uploaded successfully');
                    } else {
                        console.error('File upload failed');
                    }
                };

                xhr.onerror = function() {
                    console.error('Request failed');
                };

                xhr.send(formData);
            };
            input.click();
        })

        $("#galleryForm").on('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Gallery updated successfully!',
                        confirmButtonText: 'OK',
                        confirmButtonColor: 'red',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ route('accountgallery') }}";
                        }
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                        cancelButtonColor: 'grey',
                        confirmButtonColor: 'grey',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    });
</script>
@endsection
