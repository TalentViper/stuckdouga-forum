@extends('frontend.partials.master')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://icons.getbootstrap.com/assets/font/bootstrap-icons.min.css">

@section('main-content')
<main id="main" class="main-content">
    @if(auth()->user()->my_background)
        <div id="content" class="page-account-gallery" style="background-image: url({{ static_asset('uploads/'. auth()->user()->my_background) }}) !important; background-repeat: no-repeat; background-size: 100% 100%;">
    @else
        <div id="content" class="page-account-gallery">
    @endif
    
        <div class="content_box">
            <div class="container-fluit p-5 pt-4">
                <div class="row">
                    @include('frontend.partials.sidebar1')
                    <div class="col-md-10 center primary p-4">
                        <h2>GALLERIES <button id="toggleButton" class="toggle-button flex-end">+</button></h2>
                        <div id="uploadSection" style="display: none;">
                            <form id="galleryForm" method="POST" action="{{ route('galleries.store') }}" enctype="multipart/form-data">
                                <h5 class="mt-3 mb-3">ADD NEW GALLERY</h5>
                                @csrf
                                <div class="gallery-form">
                                    <div class="mb-3 row form-group">
                                        <label for="title" class="col-sm-2 col-form-label">Title:</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="title" name="title" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row form-group">
                                        <label for="description" class="col-sm-2 col-form-label">Description:</label>
                                        <div class="col-sm-7">
                                            <textarea class="form-control" id="description" name="description" rows="10"></textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="thumbnail" class="col-sm-2 col-form-label" name="thumbnail" required >Thumbnail:</label>
                                        <div class="col-sm-5">
                                            <button type="button" class="upload" id="thumbnail">Upload File</button>
                                            <div class="progress mt-2" style="display: none;">
                                                <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p style="color:#999">(200px <i class="bi bi-plus-lg"></i> 200px)</p>
                                        </div>
                                        <input type="text" class="form-control gallery-url" name="url" placeholder="" hidden>
                                        
                                        <label for="series" class="col-sm-1 col-form-label" >Series:</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="series" name="series" placeholder="" >
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="type" class="col-sm-2 col-form-label">Type:</label>
                                        <div class="col-sm-4">
                                            <select class="form-control" name="type">
                                                <option value="Classic">Classic</option>
                                                <option value="Hidden">Hidden</option>
                                                <option value="Locked">Locked</option>
                                            </select>
                                        </div>
                                        <label class="col-sm-1"></label>
                                        <label for="tags" class="col-sm-1 col-form-label">Tags:</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="tags" name="tags" placeholder="" data-role="tagsinput">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="create">Create Gallery</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="my-contents">
                            <h5 class="mt-3 mb-3">YOUR GALLERIES</h5>
                            <table class="table table-striped table-md">
                                <thead>
                                    <tr>
                                        <th>Title:</th>
                                        <th>Nb. of ArtWorks</th>
                                        <th>Thumbnail</th>
                                        <th>Type:</th>
                                        <th>Actions:</th>
                                    </tr>
                                </thead>
                                <tbody id="result">
                                    <!-- Example rows -->
                                    @if($galleries->isEmpty())
                                        <p>No galleries found.</p>
                                    @else
                                            @foreach($galleries as $gallery)
                                                <tr>
                                                    <td>{{ $gallery->gallery_name }}</td>
                                                    <td>{{ $gallery->series }}</td>
                                                    <td>
                                                        @if($gallery->gallery_url)
                                                            <img src="{{ static_asset('uploads') . '/' . $gallery->gallery_url }}" alt="{{ $gallery->gallery_url }}" width="100px"/>
                                                        @endif
                                                    </td>
                                                    <td> {{ $gallery->type }}</td>
                                                    <td>
                                                        <a href="{{ route('artworkupload', ['galleryId' => $gallery->id]) }}">
                                                            <i class="bi bi-images"></i>
                                                        </a>
                                                        <a href="{{ route('galleries.edit', $gallery->id) }}">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </a>
                                                        <a href="#" class="delete-button" data-id="{{ $gallery->id }}">
                                                            <i class="bi bi-trash"></i>
                                                        </a>
                                                    </td>
                                                    <!-- Add more fields as needed -->
                                                </tr>
                                            @endforeach
                                    @endif
                                </tbody>
                            </table>
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

    
</style>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {

        $(".form-control #tags").tagsinput('items');

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
            input.accept = 'image/png, image/gif, image/jpeg, image/bmp';
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
                        text: 'Gallery created successfully!',
                        confirmButtonText: 'OK',
                        confirmButtonColor: 'red',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                },
                error: function(xhr) {
                    if($(".gallery-url").val() == ""){
                        Swal.fire({
                            icon: 'error',
                            title: 'Missing field',
                            text: 'Please upload a thumbnail!',
                            cancelButtonColor: 'grey',
                            confirmButtonColor: 'grey',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                            cancelButtonColor: 'grey',
                            confirmButtonColor: 'grey',
                            confirmButtonText: 'OK'
                        });
                    }
                }
            });
        });
    });
</script>
@endsection
