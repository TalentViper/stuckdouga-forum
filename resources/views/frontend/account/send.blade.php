
@extends('frontend.partials.master')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://icons.getbootstrap.com/assets/font/bootstrap-icons.min.css">

<style>
    .ui-autocomplete-multiselect.ui-state-default {
        display: flex;
        background: #fff;
        border: 1px solid #ccc;
        padding: 3px 3px;
        padding-bottom: 0px;
        overflow: hidden;
        cursor: text;
        margin: 0px auto;
    }

    .ui-autocomplete-multiselect .ui-autocomplete-multiselect-item .ui-icon {
        float: right;
        cursor: pointer;
    }

    .ui-autocomplete-multiselect .ui-autocomplete-multiselect-item {
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 1px 3px;
        margin-right: 2px;
        margin-bottom: 3px;
        color: #333;
        background-color: #f6f6f6;
    }

    .ui-autocomplete-multiselect input {
        display: inline-block;
        border: none;
        outline: none;
        height: auto;
        margin: 2px;
        overflow: visible;
        margin-bottom: 5px;
        text-align: left;
        width: 100% !important;
    }

    .ui-autocomplete-multiselect.ui-state-active {
        outline: none;
        border: 1px solid #7ea4c7;
        -moz-box-shadow: 0 0 5px rgba(50,150,255,0.5);
        -webkit-box-shadow: 0 0 5px rgba(50,150,255,0.5);
        -khtml-box-shadow: 0 0 5px rgba(50,150,255,0.5);
        box-shadow: 0 0 5px rgba(50,150,255,0.5);
    }

    .ui-autocomplete {
        border-top: 0;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
    .bi-plus-lg::before {
        transform: rotate(45deg);
    }

    .page-account-gallery h2 {
            width: 100%;
            border-bottom: 1px solid white;
            text-align: left;
        }

        .page-account-gallery input ,.page-account-gallery textarea, .page-account-gallery select  {
            border-radius: 0px;
        }

        #thumbnail {
            padding: 4px 40px;
            background: red;
            color: white;
            float: left;
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

        .page-account-message-send .send {
            padding: 5px 40px;
            background: red;
            color: white;
            margin-top: 16px;
        }

        .page-account-message-send form {
            width: 500px;
            margin: 0 auto;
        }

        .page-account-message-send textarea {
            height: 300px;
        }

</style>

@section('main-content')
<main id="main" class="main-content">

    <div id="content" class="page-account-message-send">
        <div class="content_box">
            <div class="container-fluit p-5 pt-4">
                <div class="row">
                    @include('frontend.partials.sidebar1')
                    <div class="col-md-10 center primary">
                        <h1 class="">SEND MESSAGES</h1>
                        <form action="{{ route('messages.send') }}" method="POST">
                            @csrf
                            <div class="form-group mt-3 row">
                                <label for="receiver_id" class="col-md-4">Receiver Username:</label>
                                <input type="text" id="receiver_id" name="receiver_id" class="col-md-8" required>
                            </div>
                            <div class="form-group mt-3 row">
                                <label for="message_content" class="col-md-4" >Message:</label>
                                <textarea id="message_content" name="content" class="col-md-8"  required></textarea>
                            </div>
                            <div class="form-group mt-3 row">
                                <label for="thumbnail" class="col-md-4 col-form-label text-center" name="thumbnail" required >Attatch:</label>
                                <div class="col-sm-8" style="padding-left: 0; ">
                                    <button type="button" class="upload" id="thumbnail">Upload File</button>
                                    <div class="progress mt-2" style="display: none;">
                                        <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p style="color:#999; margin: 0;">(200px <i class="bi bi-plus-lg"></i> 200px)</p>
                                </div>
                                <input type="text" class="form-control gallery-url" name="attach_file_path" placeholder="" hidden>
                            </div>
                            <button type="submit mt-3" class="send">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    $(document).ready(function() {
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
    });
</script>
