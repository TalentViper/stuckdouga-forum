@extends('frontend.partials.master')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://icons.getbootstrap.com/assets/font/bootstrap-icons.min.css">
@section('main-content')
<main id="main" class="main-content">
    @if(auth()->user()->my_background)
        <div id="content" class="page-account-upload" style="background-image: url({{ static_asset('uploads/'. auth()->user()->my_background) }}) !important; background-repeat: no-repeat; background-size: 100% 100%;">
    @else
        <div id="content" class="page-account-upload">
    @endif
    
        <div class="content_box">
            <div class="container-fluit p-5 pt-4">
                <div class="row">
                    @include('frontend.partials.sidebar1')
                    <div class="col-md-10 center primary p-4">
                        <h2>ARTWORKS::{{ strtoupper($title) }} 
                            <a class="flex-end back-to-gallery-btn">
                                <button type="button" class="go-back-button" onclick="window.history.back()">Back to Galleries</button>
                            </a>
                        </h2>
                        <div id="uploadSection">
                            <form id="artworkForm" method="POST" action="{{ route('artworks.update', $artwork->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="new-artwork">
                                    <h5>ADD NEW ARTWORK</h5>
                                    <p>Max file size is 2MB.A thumbnail will be genereated for you if you do not upload one.</p>
                                    <div class="row">
                                        <div class="col-md-6 row">
                                            <label class="col-sm-4 col-form-label text-right" required >MainImage:</label>
                                            <div class="col-sm-6 item-box">
                                                <img src="{{ static_asset('uploads') . '/' . $artwork->img_main }}" class="edit-image"/>
                                                <button type="button" id="removeThumbnail"><span aria-hidden="true">&times;</span></button>
                                                <button type="button" id="main-file" class="upload-button">Upload File</button>
                                                <div class="progress mt-2" style="display: none;">
                                                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <input type="text" class="form-control main-file" name="mainfile" value="{{$artwork->img_main}}" hidden required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 row">
                                            <label class="col-sm-4 col-form-label text-right" >Image #4:</label>
                                            <div class="col-sm-6 item-box">
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
                                            <label class="col-sm-4 col-form-label text-right" >Thumbnail:</label>
                                            <div class="col-sm-6 item-box">
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
                                            <label class="col-sm-4 col-form-label text-right" required >Image #5:</label>
                                            <div class="col-sm-6 item-box">
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
                                            <label class="col-sm-4 col-form-label text-right" required >Image #2:</label>
                                            <div class="col-sm-6 item-box">
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
                                            <label class="col-sm-4 col-form-label text-right" required >Image #6:</label>
                                            <div class="col-sm-6 item-box">
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
                                            <label class="col-sm-4 col-form-label text-right" required >Image #3:</label>
                                            <div class="col-sm-6 item-box">
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
                                            <label class="col-sm-4 col-form-label text-right" required >Image #7:</label>
                                            <div class="col-sm-6 item-box">
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
                                                <label for="type" class="col-sm-4 col-form-label" >Image Type:</label>
                                                <div class="col-sm-8">
                                                <select name="type" class="form-control"  value="{{$artwork->type}}">
                                                    <option value="" {{$artwork->type == "" ? "selected" : ""}}>-- Select Item Type -- </option>
                                                    <option value="Background" {{$artwork->type == "Background" ? "selected" : ""}}>Background</option>
                                                    <option value="Cel" {{$artwork->type == "Cel" ? "selected" : ""}}>Cel</option>
                                                    <option value="Comic Cover" {{$artwork->type == "Comic Cover" ? "selected" : ""}}>Comic Cover</option>
                                                    <option value="Comic Page" {{$artwork->type == "Comic Page" ? "selected" : ""}}>Comic Page</option>
                                                    <option value="Douga" {{$artwork->type == "Douga" ? "selected" : ""}}>Douga</option>
                                                    <option value="Fan Art" {{$artwork->type == "Fan Art" ? "selected" : ""}}>Fan Art</option>
                                                    <option value="Genga" {{$artwork->type == "Genga" ? "selected" : ""}}>Genga</option>
                                                    <option value="Layout" {{$artwork->type == "Layout" ? "selected" : ""}}>Layout</option>
                                                    <option value="Original Sketch" {{$artwork->type == "Original Sketch" ? "selected" : ""}}>Original Sketch</option>
                                                    <option value="Other" {{$artwork->type == "Other" ? "selected" : ""}}>Other</option>
                                                    <option value="Photocopy" {{$artwork->type == "Photocopy" ? "selected" : ""}}>Photocopy</option>
                                                    <option value="Post-Production Cel" {{$artwork->type == "Post-Production Cel" ? "selected" : ""}}>Post-Production Cel</option>
                                                    <option value="Reproduction Cel" {{$artwork->type == "Reproduction Cel" ? "selected" : ""}}>Reproduction Cel</option>
                                                    <option value="Settei/Model Shee" {{$artwork->type == "Settei/Model Shee" ? "selected" : ""}}>Settei/Model Sheet</option>

                                                </select>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <label for="type" class="col-sm-4 col-form-label" >Section:</label>
                                                <div class="col-sm-8">
                                                <select name="section" class="form-control" value="{{$artwork->section}}">
                                                    <option value="" {{$artwork->section == "" ? "selected" : ""}}>-- Select Section -- </option>
                                                    <option value="0" {{$artwork->section == "0" ? "selected" : ""}}>[ Create New Section ]</option>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <label for="type" class="col-sm-4 col-form-label" >Info Position:</label>
                                                <div class="col-sm-8">
                                                    <select name="info" class="form-control"  value="{{$artwork->info}}">
                                                        <option value="0" {{$artwork->info == "0" ? "selected" : ""}}>Side</option>
                                                        <option value="1" {{$artwork->info == "1" ? "selected" : ""}}>Bottom</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <label for="type" class="col-sm-4 col-form-label" >Visibility:</label>
                                                <div class="col-sm-8">
                                                <select name="visibility" class="form-control"  value="{{$artwork->visibility}}">
                                                    <option value="0" {{$artwork->visibility == "0" ? "selected" : ""}}>Visible to Public</option>
                                                    <option value="1" {{$artwork->visibility == "1" ? "selected" : ""}}>Requires Gallery Password</option>
                                                    <option value="2" {{$artwork->visibility == "2" ? "selected" : ""}}>Hidden from Public</option>

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
                                                    <input type="text" class="form-control" id="layers" name="layers" placeholder="" value="1" value="{{$artwork->layers}}">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <label for="sketch" class="col-sm-4 col-form-label" >Sketches:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="sketch" name="sketch"  value="{{$artwork->sketch}}"  value="0">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <label for="snb" class="col-sm-4 col-form-label" >Sequence Nb:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="snb" name="snb" value="{{$artwork->snb}}" >
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <label for="condition" class="col-sm-4 col-form-label" >Condition:</label>
                                                <div class="col-sm-8">
                                                <select name="condition" class="form-control" value="{{$artwork->condition}}">
                                                    <option value="1" {{$artwork->condition == "1" ? "selected" : ""}}>Excellent</option>
                                                    <option value="2" {{$artwork->condition == "2" ? "selected" : ""}}>Good</option>
                                                    <option value="3" {{$artwork->condition == "3" ? "selected" : ""}}>Fair</option>
                                                    <option value="4" {{$artwork->condition == "4" ? "selected" : ""}}>Poor</option>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <label for="oversize" class="col-sm-4 col-form-label" >Oversize:</label>
                                                <div class="col-sm-8">
                                                <select name="oversize" class="form-control" value="{{$artwork->oversize}}">
                                                    <option value="0" {{$artwork->oversize == "0" ? "selected": ""}}>No</option>
                                                    <option value="1" {{$artwork->oversize == "1" ? "selected": ""}}>Yes</option>

                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <label for="source" class="col-sm-4 col-form-label" >Source:</label>
                                                <div class="col-sm-8">
                                                <select name="source" class="form-control" value="{{$artwork->source}}">
                                                    <option value="1" {{$artwork->source == "1" ? "selected": ""}}>TV</option>
                                                    <option value="2" {{$artwork->source == "2" ? "selected": ""}}>OVA</option>
                                                    <option value="3" {{$artwork->source == "3" ? "selected": ""}}>Movie</option>
                                                    <option value="4" {{$artwork->source == "4" ? "selected": ""}}>Hanken</option>
                                                    <option value="5" {{$artwork->source == "5" ? "selected": ""}}>Manga/Comic</option>
                                                    <option value="6" {{$artwork->source == "6" ? "selected": ""}}>Game</option>
                                                    <option value="7" {{$artwork->source == "7" ? "selected": ""}}>Other</option>
                                                    <option value="8" {{$artwork->source == "8" ? "selected": ""}}>Unknown</option>

                                                </select>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <label for="background" class="col-sm-4 col-form-label" >Background:</label>
                                                <div class="col-sm-8">
                                                <select name="background" class="form-control" value="{{$artwork->background}}">
                                                    <option value="0" {{$artwork->background == "0" ? "selected" : ""}}>None</option>
                                                    <option value="1" {{$artwork->background == "1" ? "selected" : ""}}>Original Matching</option>
                                                    <option value="2" {{$artwork->background == "2" ? "selected" : ""}}>Original Unmatching</option>
                                                    <option value="3" {{$artwork->background == "3" ? "selected" : ""}}>Copy Matching</option>
                                                    <option value="4" {{$artwork->background == "4" ? "selected" : ""}}>Copy Unmatching</option>

                                                </select>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <label for="stype" class="col-sm-4 col-form-label" >Sequence Type:</label>
                                                <div class="col-sm-8">
                                                <select name="stype" class="form-control" value="{{$artwork->stype}}">
                                                        <option value="1" {{$artwork->stype == "1" ? "selected": ""}}>Normal Production</option>
                                                        <option value="2" {{$artwork->stype == "2" ? "selected": ""}}>Opening Credit</option>
                                                        <option value="3" {{$artwork->stype == "3" ? "selected": ""}}>Eyecatch</option>
                                                        <option value="4" {{$artwork->stype == "4" ? "selected": ""}}>Ending Credit</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-6 row">
                                                    <label class="form-check-label col-sm-8" for="key">Key Arwork:</label>
                                                    <div class="col-sm-4">
                                                        <input class="form-check-input" type="checkbox" id="key" name="keyart" value="{{$artwork->keyart}}" {{$artwork->keyart == "on" ? "checked" : ""}}>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 row">
                                                    <label class="form-check-label col-sm-8" for="book">Book Arwork:</label>
                                                    <div class="col-sm-4">
                                                        <input class="form-check-input" type="checkbox" id="book" name="bookart" value="{{$artwork->bookart}}" {{$artwork->bookart == "on" ? "checked" : ""}}>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-6 row">
                                                    <label class="form-check-label col-sm-8" for="end">End Arwork:</label>
                                                    <div class="col-sm-4">
                                                        <input class="form-check-input" type="checkbox" id="end" name="endart" value="{{$artwork->endart}}" {{$artwork->endart == "on" ? "checked" : ""}}>
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
                                                <label for="players" class="col-sm-4 col-form-label" >Layers:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="players" name="players" value="{{$artwork->players}}" >
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <label for="psketch" class="col-sm-4 col-form-label" >Sketches:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="psketch" name="psketch" value="{{$artwork->psketch}}" >
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <label for="psnb" class="col-sm-4 col-form-label" >Sequence Nb:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="psnb" name="psnb" value="{{$artwork->psnb}}" >
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

    .go-back-button {
        color: white;
        background-color: #999999;
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

    .submit-artwork {
        background-color: #999999;
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
        right: -16px;
        padding: 5px 12px;
        background: white;
        color: black;
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
            var baseRouteUrl = "{{ route('artworkitems.destroy', ['artworkitem' => 'PLACEHOLDER']) }}";

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
        //                 text: 'Updated successfully!',
        //                 confirmButtonText: 'OK',
        //                 confirmButtonColor: 'red'
        //             }).then((result) => {
        //                 if (result.isConfirmed) {
        //                     window.location.href = "{{ route('artworkupload', ['galleryId' => $artwork->gallery_id]) }}";
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
    });
</script>
