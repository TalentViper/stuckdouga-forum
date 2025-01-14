@extends('frontend.partials.master')
<link rel="stylesheet" href="https://icons.getbootstrap.com/assets/font/bootstrap-icons.min.css">
@section('main-content')
<main id="main" class="main-content">

    <div id="content" class="page-account-wishlist">
        <div class="content_box">
            <div class="container-fluit p-5 pt-4">
                <div class="row">
                    @include('frontend.partials.sidebar1')
                    <div class="col-md-10 center primary p-4">
                        <h2>WISHLIST  <button id="toggleButton" class="toggle-button flex-end">+</button></h2>  
                        <div id="uploadSection" style="display: none;">
                            <form method="POST" action="{{ route('wishlists.store' )}}">
                                <h5 class="mt-5 mb-5">ADD NEW ITEM TO WISHLIST</h5>
                                @csrf
                                <div class="gallery-form">
                                    <div class="mb-3 row form-group">
                                        <label for="description" class="col-sm-2 col-form-label"  required >Description:</label>
                                        <div class="col-sm-7">
                                            <textarea class="form-control" id="description" rows="10" name="description"></textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="thumbnail" class="col-sm-2 col-form-label" name="thumbnail" required >Upload File:</label>
                                        <div class="col-sm-4">
                                            <button type="button" class="upload" id="thumbnail">Upload File</button>
                                            <div class="progress mt-2" style="display: none;">
                                                <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <input type="text" class="form-control wish-url" name="url" placeholder="" hidden>
                                        </div>
                                        <label class="col-sm-1"></label>
                                        <label for="series" class="col-sm-1 col-form-label" required >Series:</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="series" name="series" placeholder=""  required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="type" class="col-sm-2 col-form-label" name="type" required >Priority:</label>
                                        <div class="col-sm-4">
                                            <select class="form-control" name="priority">
                                                <option value="LOW">LOW</option>
                                                <option value="MIDDLE">MIDDLE</option>
                                                <option value="HIGH">HIGH</option>
                                            </select>
                                        </div>
                                        <label class="col-sm-1"></label>
                                        <label for="tag" class="col-sm-1 col-form-label" required >Other Series:</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="tag" name="oseries" placeholder=""  required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="create">Add Wishlist Item</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="my-contents">
                            <h5 class="mt-5 mb-5">YOUR WISHLIST:</h5>
                            <table class="table table-striped table-md">
                                <thead>
                                    <tr>
                                        <th width="50%">Description:</th>
                                        <th width="20%">Sample:</th>
                                        <th width="15%">Priority:</th>
                                        <th width="15%">Actions:</th>
                                    </tr>
                                </thead>
                                <tbody id="result">
                                    @if($wishlists->isEmpty())
                                        <p>No wishlists found.</p>
                                    @else
                                            @foreach($wishlists as $wishlist)
                                                <tr>
                                                    <td>{{ $wishlist->description }}</td>
                                                    <td>
                                                        <img src="{{ static_asset('uploads') . '/' . $wishlist->url }}" alt="{{ $wishlist->url }}" width="100px"/>
                                                    </td>
                                                    <td> {{ $wishlist->priority }}</td>
                                                    <td>
                                                        <a href="#">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </a>
                                                        <a href="#" class="delete-button" data-id="{{ $wishlist->id }}">
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
@endsection

<style>
    .page-account-wishlist h2 {
        width: 100%;
        border-bottom: 1px solid white;
        text-align: left;
    }

    .page-account-wishlist input ,.page-account-wishlist textarea, .page-account-wishlist select  {
        border-radius: 0px;
    }

    .page-account-wishlist .upload, .page-account-wishlist .create {
        padding: 5px 40px;
        background: red;
        color: white;
        float: left;
    }

    .page-account-wishlist .create {
        float: right;
    }

    .page-account-wishlist h5 {
        text-align: left;
    }

    .col-form-label {
        text-align: left;
    }

    .page-account-wishlist form {
        padding-bottom: 50px;
        border-bottom: 1px solid white;
    }

    .page-account-wishlist table td,.page-account-wishlist table th {
        background: transparent!important;
        color: white;
        vertical-align: middle;
    }

    .page-account-wishlist table a {
        color: white;
        text-decoration: none;
        margin-right: 10px;
        font-size: 30px
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
</style>


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $('.delete-button').on('click', function(e) {
            e.preventDefault();
            var itemId = $(this).data('id');
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var baseRouteUrl = "{{ route('wishlists.destroy', ['wishlist' => 'PLACEHOLDER']) }}";

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
                                    text: 'WishList item has been deleted.',
                                    icon: 'success',
                                    confirmButtonColor: 'red',
                                }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                    title: 'Error',
                                    text: 'Failed to delete wishlist item.',
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
                        $(".wish-url").val(responseData.path);
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
    });
</script>
