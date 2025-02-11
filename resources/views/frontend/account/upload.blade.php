@extends('frontend.partials.master')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://icons.getbootstrap.com/assets/font/bootstrap-icons.min.css">
@section('main-content')
<main id="main" class="main-content">

    <div id="content" class="page-account-upload">
        <div class="content_box">
            <div class="container-fluit p-5 pt-4">
                <div class="row">
                    @include('frontend.partials.sidebar1')
                    <div class="col-md-10 center primary p-4">
                        <h2>ARTWORKS::{{ strtoupper($title) }} 
                            <button id="toggleButton" class="toggle-button flex-end">+</button>
                            <a class="flex-end back-to-gallery-btn">
                                <button type="button" class="go-back-button" onclick="window.history.back()">Back to Galleries</button>
                            </a>
                        </h2>  
                        <div id="uploadSection" style="display: none;">
                            <form id="artworkForm" method="POST" action="{{ route('artworks.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="new-artwork">
                                    <input type="text" class="form-control"  name="gallery_id" value="{{$id}}"  hidden>
                                    <h5>ADD NEW ARTWORK</h5>
                                    <p>Max file size is 2MB.A thumbnail will be genereated for you if you do not upload one.</p>
                                    <div class="row">
                                        <div class="col-md-6 row">
                                            <label class="col-sm-4 col-form-label" >MainImage:</label>
                                            <div class="col-sm-8">
                                                <button type="button" id="main-file">Upload File</button>
                                                <div class="progress mt-2" style="display: none;">
                                                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <input type="text" class="form-control main-file" name="mainfile" placeholder="" hidden>
                                            </div>
                                        </div>
                                        <div class="col-md-6 row">
                                            <label class="col-sm-4 col-form-label" >Image #4:</label>
                                            <div class="col-sm-8">
                                                <button type="button" id="img4">Upload File</button>
                                                <div class="progress mt-2" style="display: none;">
                                                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <input type="text" class="form-control img4" name="img4" placeholder="" hidden>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6 row">
                                            <label class="col-sm-4 col-form-label" >Thumbnail:</label>
                                            <div class="col-sm-8">
                                                <button type="button" id="thumbnail">Upload File</button>
                                                <div class="progress mt-2" style="display: none;">
                                                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <input type="text" class="form-control thumbnail" name="thumbnail" placeholder="" hidden>
                                            </div>
                                        </div>
                                        <div class="col-md-6 row">
                                            <label class="col-sm-4 col-form-label" >Image #5:</label>
                                            <div class="col-sm-8">
                                                <button type="button" id="img5">Upload File</button>
                                                <div class="progress mt-2" style="display: none;">
                                                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <input type="text" class="form-control img5" name="img5" placeholder="" hidden>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6 row">
                                            <label class="col-sm-4 col-form-label" >Image #2:</label>
                                            <div class="col-sm-8">
                                                <button type="button" id="img2">Upload File</button>
                                                <div class="progress mt-2" style="display: none;">
                                                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <input type="text" class="form-control img2" name="img2" placeholder="" hidden>
                                            </div>
                                        </div>
                                        <div class="col-md-6 row">
                                            <label class="col-sm-4 col-form-label" >Image #6:</label>
                                            <div class="col-sm-8">
                                                <button type="button" id="img6">Upload File</button>
                                                <div class="progress mt-2" style="display: none;">
                                                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <input type="text" class="form-control img6" name="img6" placeholder="" hidden>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6 row">
                                            <label class="col-sm-4 col-form-label" >Image #3:</label>
                                            <div class="col-sm-8">
                                                <button type="button" id="img3">Upload File</button>
                                                <div class="progress mt-2" style="display: none;">
                                                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <input type="text" class="form-control img3" name="img3" placeholder="" hidden>
                                            </div>
                                        </div>
                                        <div class="col-md-6 row">
                                            <label class="col-sm-4 col-form-label" >Image #7:</label>
                                            <div class="col-sm-8">
                                                <button type="button" id="img7">Upload File</button>
                                                <div class="progress mt-2" style="display: none;">
                                                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <input type="text" class="form-control img7" name="img7" placeholder="" hidden>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="basic-information mt-5">
                                    <h5>BASIC INFORMATION:</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <label for="title" class="col-sm-4 col-form-label" >ArtWork Title:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="title" name="title" placeholder="" required >
                                                </div>
                                            </div>
                                            <p class="text-start">Description:</p>
                                            <textarea class="form-control" id="desc" name="desc" rows="7"></textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <label for="type" class="col-sm-4 col-form-label" >Image Type:</label>
                                                <div class="col-sm-8">
                                                <select name="type" class="form-control">
                                                    <option value="">-- Select Item Type -- </option>
                                                    <option value="Background">Background</option>
                                                    <option value="Cel">Cel</option>
                                                    <option value="Comic Cover">Comic Cover</option>
                                                    <option value="Comic Page">Comic Page</option>
                                                    <option value="Douga">Douga</option>
                                                    <option value="Fan Art">Fan Art</option>
                                                    <option value="Genga">Genga</option>
                                                    <option value="Layout">Layout</option>
                                                    <option value="Original Sketch">Original Sketch</option>
                                                    <option value="Other">Other</option>
                                                    <option value="Photocopy">Photocopy</option>
                                                    <option value="Post-Production Cel">Post-Production Cel</option>
                                                    <option value="Reproduction Cel">Reproduction Cel</option>
                                                    <option value="Settei/Model Shee">Settei/Model Sheet</option>

                                                </select>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <label for="type" class="col-sm-4 col-form-label" >Section:</label>
                                                <div class="col-sm-8">
                                                <select name="section" class="form-control">
                                                    <option value="">-- Select Section -- </option>
                                                    <option value="0">[ Create New Section ]</option>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <label for="type" class="col-sm-4 col-form-label" >Info Position:</label>
                                                <div class="col-sm-8">
                                                    <select name="info" class="form-control">
                                                        <option value="0">Side</option>
                                                        <option value="1">Bottom</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <label for="type" class="col-sm-4 col-form-label" >Visibility:</label>
                                                <div class="col-sm-8">
                                                <select name="visibility" class="form-control">
                                                    <option value="0">Visible to Public</option>
                                                    <option value="1">Requires Gallery Password</option>
                                                    <option value="2">Hidden from Public</option>

                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="extend-information mt-5">
                                    <h5>EXTENDED INFORMATION:</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <label for="layers" class="col-sm-4 col-form-label" >Layers:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="layers" name="layers" placeholder="" value=1  >
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <label for="sketch" class="col-sm-4 col-form-label" >Sketches:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="sketch" name="sketch" placeholder=""  value=0>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <label for="snb" class="col-sm-4 col-form-label" >Sequence Nb:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="snb" name="snb" placeholder="" >
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <label for="condition" class="col-sm-4 col-form-label" >Condition:</label>
                                                <div class="col-sm-8">
                                                <select name="condition" class="form-control">
                                                    <option value="1">Excellent</option>
                                                    <option value="2">Good</option>
                                                    <option value="3">Fair</option>
                                                    <option value="4">Poor</option>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <label for="oversize" class="col-sm-4 col-form-label" >Oversize:</label>
                                                <div class="col-sm-8">
                                                <select name="oversize" class="form-control">
                                                    <option value="0">No</option>
                                                    <option value="1">Yes</option>

                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <label for="source" class="col-sm-4 col-form-label" >Source:</label>
                                                <div class="col-sm-8">
                                                <select name="source" class="form-control">
                                                    <option value="1">TV</option>
                                                    <option value="2">OVA</option>
                                                    <option value="3">Movie</option>
                                                    <option value="4">Hanken</option>
                                                    <option value="5">Manga/Comic</option>
                                                    <option value="6">Game</option>
                                                    <option value="7">Other</option>
                                                    <option value="8">Unknown</option>

                                                </select>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <label for="background" class="col-sm-4 col-form-label" >Background:</label>
                                                <div class="col-sm-8">
                                                <select name="background" class="form-control">
                                                    <option value="0">None</option>
                                                    <option value="1">Original Matching</option>
                                                    <option value="2">Original Unmatching</option>
                                                    <option value="3">Copy Matching</option>
                                                    <option value="4">Copy Unmatching</option>

                                                </select>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <label for="stype" class="col-sm-4 col-form-label" >Sequence Type:</label>
                                                <div class="col-sm-8">
                                                <select name="stype" class="form-control">
                                                        <option value="1">Normal Production</option>
                                                        <option value="2">Opening Credit</option>
                                                        <option value="3">Eyecatch</option>
                                                        <option value="4">Ending Credit</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-6 row">
                                                    <label class="form-check-label col-sm-8" for="key">Key Arwork:</label>
                                                    <div class="col-sm-4">
                                                        <input class="form-check-input" type="checkbox" id="key" name="keyart">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 row">
                                                    <label class="form-check-label col-sm-8" for="book">Book Arwork:</label>
                                                    <div class="col-sm-4">
                                                        <input class="form-check-input" type="checkbox" id="book" name="bookart">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-6 row">
                                                    <label class="form-check-label col-sm-8" for="end">End Arwork:</label>
                                                    <div class="col-sm-4">
                                                        <input class="form-check-input" type="checkbox" id="end" name="endart">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="private-information mt-5">
                                    <h5>PRIVATE INFORMATION:</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="text-start">Description:</p>
                                            <textarea class="form-control" id="description" rows="7" name="pdesc"></textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row mt-4">
                                                <label for="players" class="col-sm-4 col-form-label" >Layers:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="players" name="players" placeholder="" >
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <label for="psketch" class="col-sm-4 col-form-label" >Sketches:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="psketch" name="psketch" placeholder="" >
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <label for="psnb" class="col-sm-4 col-form-label" >Sequence Nb:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="psnb" name="psnb" placeholder="" >
                                                </div>
                                            </div>
                                            <div class="row mt-5">
                                                <div class="col-md-12">
                                                    <button type="submit" class="submit-artwork float-end">Submit ArtWork</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>                            
                        <div class="my-contents">
                            <h5 class="mt-3 mb-3">YOUR ARTWORKS IN {{ strtoupper($title) }} GALLERY:</h5>
                            <table class="table table-striped table-md">
                                <thead>
                                    <tr>
                                        <th>Title:</th>
                                        <th>Type</th>
                                        <th>Thumbnail</th>
                                        <th>Added/Updated:</th>
                                        <th width="20%">Actions:</th>
                                    </tr>
                                </thead>
                                <tbody id="result">
                                    @if($items->isEmpty())
                                        <p>No Items found.</p>
                                    @else
                                            @foreach($items as $item)
                                                <tr>
                                                    <td>{{ $item->title }}</td>
                                                    <td>{{ $item->type }}</td>
                                                    <td>
                                                        @if($item->img_main)
                                                            <img src="{{ static_asset('uploads') . '/' . $item->img_main }}" width="100px"/>                                                      
                                                        @endif
                                                    </td>
                                                    <td> {{ $item->updated_at->format('d/m/Y H:m') }}</td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input visibleSwitch pointer" title="hide / show" type="checkbox" data-id="{{ $item->id }}" {{ $item->visibility ? 'checked' : '' }}>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <a href="{{ route('artworks.edit', $item->id) }}">
                                                                    <i class="bi bi-pencil-square"></i>
                                                                </a>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <a href="#" class="delete-button" data-id="{{ $item->id }}">
                                                                    <i class="bi bi-trash"></i>
                                                                </a>
                                                            </div>
                                                        </div>
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
    .page-account-upload h2 {
        width: 100%;
        border-bottom: 1px solid white;
        text-align: left;
    }

    .go-back-button {
        color: white;
        background-color: red;
        padding: 5px 15px;
        width: 200px;
        font-size: 15px;
        font-weight: 300;
        font-family: tahoma;
        border-width: 3px;
        border-top-color: #7d7d7d;
        border-bottom-color: #5f5f5f;
        border-left-color: #6f6f6f;
        border-right-color: #797979;
    }

    .back-to-gallery-btn {
        float: right;
        margin-right: 10px;
        margin-top: -5px;
    }

    .page-account-upload input ,.page-account-upload textarea, .page-account-upload select  {
        border-radius: 0px;
    }

    .new-artwork button, .submit-artwork{
        padding: 5px 40px;
        background: red;
        color: white;
        /* float: left; */
    }

    .page-account-upload .create {
        float: right;
    }

    .page-account-upload h5 {
        text-align: left;
    }

    .col-form-label {
        text-align: left;
    }

    .page-account-upload form {
        padding-bottom: 50px;
        border-bottom: 1px solid white;
    }

    .page-account-upload table td,.page-account-upload table th {
        background: transparent!important;
        color: white;
        vertical-align: middle;
    }

    .page-account-upload table a {
        color: white;
        text-decoration: none;
        margin-left: 10px;
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

    .form-switch {
        margin-top: -3px;
    }

    .form-switch input {
        height: 30px;
        width: 50px!important;
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
            var baseRouteUrl = "{{ route('artworks.destroy', ['artwork' => 'PLACEHOLDER']) }}";

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
                                    text: 'Item has been deleted.',
                                    icon: 'success',
                                    confirmButtonColor: 'red',
                                }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Failed to delete item.',
                                    cancelButtonColor: 'grey',
                                    confirmButtonColor: 'grey',
                                });
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

        $(".new-artwork button").on('click', function() {
            let selector = this;
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

                        $(selector).parent().find('.progress').css('display', 'block');
                        $(selector).parent().find('.progress-bar').css('width', percentComplete + '%');
                        $(selector).parent().find('.progress-bar').attr('aria-valuenow', percentComplete);
                        $(selector).parent().find('.progress-bar').text(Math.round(percentComplete) + '%');
                    }
                };

                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var responseData = JSON.parse(xhr.responseText);
                        console.log($(selector).parent().find('input'));
                        $(selector).parent().find('input').val(responseData.path);
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
        });

        // $("#artworkForm").on('submit', function(event) {
        //     event.preventDefault();
        //     var formData = new FormData(this);

        //     $.ajax({
        //         url: $(this).attr('action'),
        //         method: $(this).attr('method'),
        //         data: formData,
        //         processData: false,
        //         contentType: false,
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         success: function(response) {
        //             Swal.fire({
        //                 icon: 'success',
        //                 title: 'Success!',
        //                 text: 'ArtWork created successfully!',
        //                 confirmButtonText: 'OK',
        //                 confirmButtonColor: 'red'
        //             }).then((result) => {
        //                 if (result.isConfirmed) {
        //                     window.location.reload();
        //                 }
        //             });
        //         },
        //         error: function(xhr) {
        //             if($('.main-file').val() == "") {
        //                 Swal.fire({
        //                     icon: 'error',
        //                     title: 'Missing field',
        //                     text: 'Please upload MainImage',
        //                     confirmButtonText: 'OK',
        //                     confirmButtonColor: 'grey'
        //                 });
        //             } else {
        //                 Swal.fire({
        //                     icon: 'error',
        //                     title: 'Oops...',
        //                     text: 'Something went wrong!',
        //                     confirmButtonText: 'OK',
        //                     confirmButtonColor: 'grey'
        //                 });
        //             }
        //         }
        //     });
        // });

        $(".visibleSwitch").on("change", function(event) {
            var val = $(this).is(":checked");
            var id = $(this).data('id');
            var datra = new FormData()
            datra.append('id', id);
            datra.append('visibility', val ? 1 : 0);
            $.ajax({
                url: '{{ route('artwork.change_visible') }}',
                method: "POST",
                data: datra,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Action changed!',
                        confirmButtonText: 'OK',
                        confirmButtonColor: 'red'
                    })
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                        confirmButtonText: 'OK',
                        confirmButtonColor: 'grey'
                    });
                }
            })
        })
    });
</script>
