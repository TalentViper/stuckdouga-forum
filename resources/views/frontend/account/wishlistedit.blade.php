@extends('frontend.partials.master')
<link rel="stylesheet" href="https://icons.getbootstrap.com/assets/font/bootstrap-icons.min.css">
@section('main-content')
<main id="main" class="main-content">
    @if(auth()->user()->my_background)       
        <div id="content" class="page-account-wishlist" style="background-image: url({{ static_asset('uploads/'. auth()->user()->my_background) }}) !important; background-repeat: no-repeat; background-size: 100% 100%;">
    @else
        <div id="content" class="page-account-wishlist">
    @endif
    
        <div class="content_box">
            <div class="container-fluit p-5 pt-4">
                <div class="row">
                    @include('frontend.partials.sidebar1')
                    <div class="col-md-10 center primary p-4">
                        <h2>WISHLIST <a href="{{ redirect()->back()->getTargetUrl() }}" class="toggle-button flex-end">Go back</a></h2>  
                        <div id="uploadSection" >
                            <form method="POST" action="{{ route('wishlist.update' )}}">
                                <h5 class="mt-5 mb-5">UPDATE WISHLIST ITEM</h5>
                                @csrf
                                <div class="gallery-form">
                                    <input type="hidden" name="id" value="{{ $wishitem->id }}">
                                    <div class="mb-3 row form-group">
                                        <label for="description" class="col-sm-2 col-form-label"  required >Description:</label>
                                        <div class="col-sm-7">
                                            <textarea class="form-control" id="description" rows="10" name="description" required>{{ $wishitem->description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="thumbnail" class="col-sm-2 col-form-label" name="thumbnail" >Upload File:</label>
                                        <div class="col-sm-4">
                                            <button type="button" class="upload" id="thumbnail">Upload File</button>
                                            <div class="progress mt-2" style="display: none;">
                                                <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <input type="text" class="form-control wish-url" name="url" placeholder="" hidden value="{{ $wishitem->url }}">
                                        </div>
                                        <label class="col-sm-1"></label>
                                        <label for="series" class="col-sm-1 col-form-label" >Series:</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="series" name="series" placeholder="" value="{{ $wishitem->series }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="type" class="col-sm-2 col-form-label" name="type" required >Priority:</label>
                                        <div class="col-sm-4">
                                            <select class="form-control" name="priority" value="{{ $wishitem->priority }}" required>
                                                <option value="NORMAL">NORMAL</option>
                                                <option value="LOW">LOW</option>
                                                <option value="HIGH">HIGH</option>
                                                <option value="VERY HIGH">VERY HIGH</option>
                                            </select>
                                        </div>
                                        <label class="col-sm-1"></label>
                                        <label for="tag" class="col-sm-1 col-form-label" >Other Series:</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="tag" name="oseries" placeholder="" value="{{ $wishitem->oseries }}">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="create">Update Wishlist Item</button>
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
        font-size: 14px;
        font-weight: 200;
        text-decoration: none;
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
