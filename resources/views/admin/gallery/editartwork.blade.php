@extends('admin.partials.master')

@section('title')
    Edit ArtWork
@endsection
@section('bookings')
    active
@endsection
@php
    if(isset($_GET['q'])){
        $q = $_GET['q'];
    }
@endphp
@section('main-content')
<main id="main" class="main-content">

    <div id="content" class="page-account-upload">
        <div class="content_box">
            <div class="container-fluit p-5 pt-4">
                <div class="row">
                    <div class="col-md-10 center primary p-4">
                        <h2>ARTWORKS::{{ strtoupper($title) }} <button id="toggleButton" class="toggle-button flex-end">+</button></h2>  
                        <div id="uploadSection" style="display: none;">
                            <form id="artworkForm" method="POST" action="{{ route('admin.artworks.update', $artwork->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="new-artwork">
                                    <h5>ADD NEW ARTWORK</h5>
                                    <p>Max file size is 2MB.A thumbnail will be genereated for you if you do not upload one.</p>
                                    <div class="row">
                                        <div class="col-md-6 row">
                                            <label class="col-sm-4 col-form-label" required >MainImage:</label>
                                            <div class="col-sm-8 item-box">
                                                <img src="{{ static_asset('uploads') . '/' . $artwork->img_main }}" class="edit-image"/>
                                                <button type="button" id="removeThumbnail"><span aria-hidden="true">&times;</span></button>
                                                <button type="button" id="main-file" class="upload-button">Upload File</button>
                                                <div class="progress mt-2" style="display: none;">
                                                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <input type="text" class="form-control main-file" name="mainfile" value="{{$artwork->img_main}}" hidden>
                                            </div>
                                        </div>
                                        <div class="col-md-6 row">
                                            <label class="col-sm-4 col-form-label" required >Image #4:</label>
                                            <div class="col-sm-8 item-box">
                                                 @if($artwork->img4)
                                                    <img src="{{ static_asset('uploads') . '/' . $artwork->img4 }}" class="edit-image"/>
                                                @else
                                                    <img src="{{ static_asset('images/img/emptyartwork.png') }}" class="edit-image"/>
                                                @endif
                                                <button type="button" id="removeThumbnail"><span aria-hidden="true">&times;</span></button>
                                                <button type="button" id="img4" class="upload-button">Upload File</button>
                                                <div class="progress mt-2" style="display: none;">
                                                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <input type="text" class="form-control img4" name="img4" placeholder="" value="{{$artwork->img4}}" hidden>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6 row">
                                            <label class="col-sm-4 col-form-label" required >Thumbnail:</label>
                                            <div class="col-sm-8 item-box">
                                                @if($artwork->thumbnail)
                                                    <img src="{{ static_asset('uploads') . '/' . $artwork->thumbnail }}" class="edit-image"/>
                                                @else
                                                    <img src="{{ static_asset('images/img/emptyartwork.png') }}" class="edit-image"/>
                                                @endif
                                                <button type="button" id="removeThumbnail"><span aria-hidden="true">&times;</span></button>
                                                <button type="button" id="thumbnail" class="upload-button">Upload File</button>
                                                <div class="progress mt-2" style="display: none;">
                                                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <input type="text" class="form-control thumbnail" name="thumbnail" value="{{$artwork->thumbnail}}" hidden>
                                            </div>
                                        </div>
                                        <div class="col-md-6 row">
                                            <label class="col-sm-4 col-form-label" required >Image #5:</label>
                                            <div class="col-sm-8 item-box">
                                                @if($artwork->img5)
                                                    <img src="{{ static_asset('uploads') . '/' . $artwork->img5 }}" class="edit-image"/>
                                                @else
                                                    <img src="{{ static_asset('images/img/emptyartwork.png') }}" class="edit-image"/>
                                                @endif
                                                <button type="button" id="removeThumbnail"><span aria-hidden="true">&times;</span></button>
                                                <button type="button" id="img5" class="upload-button">Upload File</button>
                                                <div class="progress mt-2" style="display: none;">
                                                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <input type="text" class="form-control img5" name="img5"  value="{{$artwork->img5}}" hidden>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6 row">
                                            <label class="col-sm-4 col-form-label" required >Image #2:</label>
                                            <div class="col-sm-8 item-box">
                                                @if($artwork->img2)
                                                    <img src="{{ static_asset('uploads') . '/' . $artwork->img2 }}" class="edit-image"/>
                                                @else
                                                    <img src="{{ static_asset('images/img/emptyartwork.png') }}" class="edit-image"/>
                                                @endif
                                                <button type="button" id="removeThumbnail"><span aria-hidden="true">&times;</span></button>
                                                <button type="button" id="img2" class="upload-button">Upload File</button>
                                                <div class="progress mt-2" style="display: none;">
                                                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <input type="text" class="form-control img2" name="img2"  value="{{$artwork->img2}}" hidden>
                                            </div>
                                        </div>
                                        <div class="col-md-6 row">
                                            <label class="col-sm-4 col-form-label" required >Image #6:</label>
                                            <div class="col-sm-8 item-box">
                                                @if($artwork->img6)
                                                    <img src="{{ static_asset('uploads') . '/' . $artwork->img2 }}" class="edit-image"/>
                                                @else
                                                    <img src="{{ static_asset('images/img/emptyartwork.png') }}" class="edit-image"/>
                                                @endif
                                                <button type="button" id="removeThumbnail"><span aria-hidden="true">&times;</span></button>
                                                <button type="button" id="img6" class="upload-button">Upload File</button>
                                                <div class="progress mt-2" style="display: none;">
                                                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <input type="text" class="form-control img6" name="img6"  value="{{$artwork->img6}}" hidden>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6 row">
                                            <label class="col-sm-4 col-form-label" required >Image #3:</label>
                                            <div class="col-sm-8 item-box">
                                                @if($artwork->img3)
                                                    <img src="{{ static_asset('uploads') . '/' . $artwork->img3 }}" class="edit-image"/>
                                                @else
                                                    <img src="{{ static_asset('images/img/emptyartwork.png') }}" class="edit-image"/>
                                                @endif
                                                <button type="button" id="removeThumbnail"><span aria-hidden="true">&times;</span></button>
                                                <button type="button" id="img3" class="upload-button">Upload File</button>
                                                <div class="progress mt-2" style="display: none;">
                                                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <input type="text" class="form-control img3" name="img3"  value="{{$artwork->img3}}" hidden>
                                            </div>
                                        </div>
                                        <div class="col-md-6 row">
                                            <label class="col-sm-4 col-form-label" required >Image #7:</label>
                                            <div class="col-sm-8 item-box">
                                                @if($artwork->img7)
                                                    <img src="{{ static_asset('uploads') . '/' . $artwork->img7 }}" class="edit-image"/>
                                                @else
                                                    <img src="{{ static_asset('images/img/emptyartwork.png') }}" class="edit-image"/>
                                                @endif
                                                <button type="button" id="removeThumbnail"><span aria-hidden="true">&times;</span></button>
                                                <button type="button" id="img7" class="upload-button">Upload File</button>
                                                <div class="progress mt-2" style="display: none;">
                                                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <input type="text" class="form-control img7" name="img7"  value="{{$artwork->img7}}" hidden>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="basic-information mt-5">
                                    <h5>BASIC INFORMATION:</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <label for="title" class="col-sm-4 col-form-label" required >ArtWork Title:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="title" name="title"  value="{{$artwork->title}}"  required>
                                                </div>
                                            </div>
                                            <p class="text-start">Description:</p>
                                            <textarea class="form-control" id="desc" name="desc" rows="7" value="{{$artwork->desc}}"></textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <label for="type" class="col-sm-4 col-form-label" required >Image Type:</label>
                                                <div class="col-sm-8">
                                                <select name="type" class="form-control"  value="{{$artwork->type}}">
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
                                                <label for="type" class="col-sm-4 col-form-label" required >Section:</label>
                                                <div class="col-sm-8">
                                                <select name="section" class="form-control">
                                                    <option value="">-- Select Section -- </option>
                                                    <option value="0">[ Create New Section ]</option>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <label for="type" class="col-sm-4 col-form-label" required >Info Position:</label>
                                                <div class="col-sm-8">
                                                    <select name="info" class="form-control"  value="{{$artwork->info}}">
                                                        <option value="0">Side</option>
                                                        <option value="1">Bottom</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <label for="type" class="col-sm-4 col-form-label" required >Visibility:</label>
                                                <div class="col-sm-8">
                                                <select name="visibility" class="form-control"  value="{{$artwork->visibility}}">
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
                                                <label for="layers" class="col-sm-4 col-form-label" required >Layers:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="layers" name="layers" placeholder="" value=1  required value="{{$artwork->layers}}">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <label for="sketch" class="col-sm-4 col-form-label" required >Sketches:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="sketch" name="sketch"  value="{{$artwork->sketch}}"  value=0 required>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <label for="snb" class="col-sm-4 col-form-label" required >Sequence Nb:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="snb" name="snb" value="{{$artwork->snb}}"  required>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <label for="condition" class="col-sm-4 col-form-label" required >Condition:</label>
                                                <div class="col-sm-8">
                                                <select name="condition" class="form-control" value="{{$artwork->condition}}">
                                                    <option value="1">Excellent</option>
                                                    <option value="2">Good</option>
                                                    <option value="3">Fair</option>
                                                    <option value="4">Poor</option>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <label for="oversize" class="col-sm-4 col-form-label" required >Oversize:</label>
                                                <div class="col-sm-8">
                                                <select name="oversize" class="form-control" value="{{$artwork->oversize}}">
                                                    <option value="0">No</option>
                                                    <option value="1">Yes</option>

                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <label for="source" class="col-sm-4 col-form-label" required >Source:</label>
                                                <div class="col-sm-8">
                                                <select name="source" class="form-control" value="{{$artwork->source}}">
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
                                                <label for="background" class="col-sm-4 col-form-label" required >Background:</label>
                                                <div class="col-sm-8">
                                                <select name="background" class="form-control" value="{{$artwork->background}}">
                                                    <option value="0">None</option>
                                                    <option value="1">Original Matching</option>
                                                    <option value="2">Original Unmatching</option>
                                                    <option value="3">Copy Matching</option>
                                                    <option value="4">Copy Unmatching</option>

                                                </select>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <label for="stype" class="col-sm-4 col-form-label" required >Sequence Type:</label>
                                                <div class="col-sm-8">
                                                <select name="stype" class="form-control" value="{{$artwork->stype}}">
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
                                                        <input class="form-check-input" type="checkbox" id="key" name="keyart" value="{{$artwork->keyart}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 row">
                                                    <label class="form-check-label col-sm-8" for="book">Book Arwork:</label>
                                                    <div class="col-sm-4">
                                                        <input class="form-check-input" type="checkbox" id="book" name="bookart" value="{{$artwork->bookart}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-6 row">
                                                    <label class="form-check-label col-sm-8" for="end">End Arwork:</label>
                                                    <div class="col-sm-4">
                                                        <input class="form-check-input" type="checkbox" id="end" name="endart" value="{{$artwork->endart}}">
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
                                            <textarea class="form-control" id="description" rows="7" name="pdesc" value="{{$artwork->pdesc}}"></textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row mt-4">
                                                <label for="players" class="col-sm-4 col-form-label" required >Layers:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="players" name="players" value="{{$artwork->players}}"  required>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <label for="psketch" class="col-sm-4 col-form-label" required >Sketches:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="psketch" name="psketch" value="{{$artwork->psketch}}"  required>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <label for="psnb" class="col-sm-4 col-form-label" required >Sequence Nb:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="psnb" name="psnb" value="{{$artwork->psnb}}"  required>
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

    .edit-image {
        display: block;
        margin: 0 auto;
        margin-bottom: 16px;
        width: 200px;
    }

    .item-box {
        position: relative;

    }

    .item-box #removeThumbnail {
        position: absolute;
        top: -2px;
        right: 9px;
        padding: 5px 12px;
        background: white;
        color: black;
    }
</style>


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $("#toggleButton").on('click', function() {
            $("#uploadSection").toggle();
            $(this).text($(this).text() == '+' ? '-' : '+');
        });

        $("#toggleButton").trigger('click');

        $(".new-artwork #removeThumbnail").on('click', function() {
            let selector = this;
            $(selector).parent().find('img').attr("src", "{{static_asset('images/img/emptyartwork.png')}}");
            $(selector).parent().find('input').val(null);
        })

        $(".new-artwork .upload-button").on('click', function() {
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
                        $(selector).parent().find('img').attr("src", '{{ static_asset('uploads') }}' + '/' + responseData.path);
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

        $("#artworkForm").on('submit', function(event) {
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
                        text: 'ArtWork created successfully!',
                        confirmButtonText: 'OK',
                        confirmButtonColor: 'red'
                    }).then((result) => {
                        if (result.isConfirmed) {

                        }
                    });
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
            });
        });
    });
</script>
