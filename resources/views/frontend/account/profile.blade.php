@extends('frontend.partials.master')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://icons.getbootstrap.com/assets/font/bootstrap-icons.min.css">
@section('main-content')
<main id="main" class="main-content">

    <div id="content" class="page-account-profile">
        <div class="content_box">
            <div class="container-fluit p-5 pt-4">
                <div class="row">
                    @include('frontend.partials.sidebar1')
                    <div class="col-md-10 center primary p-4">
                        <h1>PROFILE INFO</h1>
                        <form id="galleryForm" method="POST"  action="{{ route('users.update', 1) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="main-banner">
                                <div class="row">
                                    <div class="col-md-4">
                                        Main Banner:
                                    </div>
                                    <div class="col-md-4">
                                        @if($banner != NULL)
                                        <img src="{{ static_asset('uploads/' . $banner) }}" width="300" alt="" class="banner-img">
                                        <p style="color:#999">(1200 <i class="bi bi-plus-lg"></i> 400px)</p>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" id="banner">Upload File</button>
                                    </div>
                                    <input type="text" class="banner-url" name="banner" hidden>
                                    <input type="text" class="side-url" name="side" hidden>
                                    <input type="text" class="layout" name="layout" hidden value='{{ $layout }}'>
                                    <input type="text" class="content" name="content" hidden value='{{ $content }}'>
                                </div>
                            </div>
                            <div class="choose-layout mb-5">
                                <div class="row">
                                    <div class="col-md-9 row">
                                        <div class="col-md-3 mt-4">Choose Layout:</div>
                                        <div class="col-md-3">
                                            <img src="{{ static_asset('images/img/left.png') }}" alt="" data-layout = "right">
                                        </div>
                                        <div class="col-md-3">
                                            <img src="{{ static_asset('images/img/center.png') }}" alt="" data-layout = "full">
                                        </div>
                                        <div class="col-md-3">
                                            <img src="{{ static_asset('images/img/right.png') }}" alt="" data-layout = "left">
                                        </div>
                                    </div>
                                </div>
                                <input type="file" id="banner-upload" accept="image/*" hidden>
                            </div>

                            <div class="full-width-layout" style="display:none;">
                                <div class="main-content1">
                                    <textarea name="content" id="editor">{{$content}}</textarea>
                                    <!-- Content goes here -->
                                </div>
                            </div>

                            <div class="left-sidebar-layout">
                                <div class="sidebar left">
                                    <img src="{{ $side == NULL ? static_asset('images/img/member.jpg') : static_asset('uploads/' . $side) }}" alt="Banner" />
                                    <p style="color:#999; text-align:left" >(300 <i class="bi bi-plus-lg"></i> 850px)</p>
                                </div>
                                <div class="main-content1">
                                    <textarea name="content" id="editor1">{{$content}}</textarea>
                                    <!-- Content goes here -->
                                </div>
                            </div>

                            <div class="right-sidebar-layout" style="display:none;">
                                <div class="main-content1">
                                    <textarea name="content" id="editor2">{{$content}}</textarea>
                                    <!-- Content goes here -->
                                </div>
                                <div class="sidebar right">
                                    <img src="{{ $side == NULL ? static_asset('images/img/member.jpg') : static_asset('uploads/' . $side) }}" alt="Banner" />
                                    <p style="color:#999; text-align:left" >(300 <i class="bi bi-plus-lg"></i> 850px)</p>
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="col-sm-12">
                                    <textarea name="content" id="editor"></textarea>
                                </div>
                            </div> -->
                            <div class="mb-3 row mt-3">
                                <div class="col-sm-12">
                                    <button type="submit" class="create">Save Updates</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>

</script>
@endsection

<style>
    .page-account-profile h1 {
        width: 100%;
        border-bottom: 1px solid white;
    }

    .page-account-profile h6 {
        text-align: left;
    }

    .page-account-profile input ,.page-account-profile textarea, .page-account-profile select  {
        border-radius: 0px;
    }

    .page-account-profile .upload, .page-account-profile .change, .page-account-profile .create {
        padding: 5px 40px;
        background: red;
        color: white;
        float: left;
    }

    .page-account-profile .create {
        float: right;
    }

    .page-account-profile h5 {
        text-align: left;
    }

    .col-form-label {
        text-align: left;
    }

    .page-account-profile table td,.page-account-profile table th {
        background: transparent!important;
        color: white;
        vertical-align: middle;
    }

    .page-account-profile table a {
        color: white;
        text-decoration: none;
        margin-right: 10px;
        font-size: 30px
    }

    .page-account-profile .d-flex {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%; /* Ensure the container takes the full height */
    }

    .page-account-profile .change {
        padding: 5px 40px;
        background: red;
        color: white;
    }

    .sceditor-container {
        width: 100%!important;
        height: 100%!important;
        margin-top: 10px;
    }

    .main-banner .row,
    .choose-layout>.row{
        min-height: 150px;
        border-bottom: 1px solid white;
    }

    .main-banner button {
        padding: 5px 40px;
        background: red;
        color: white;
    }

    .main-banner .row, .choose-layout>.row {
        align-items: center;
    }

    .bi-plus-lg::before {
        transform: rotate(45deg);
    }

    .full-width-layout {
        display: flex;
        flex-direction: column;
        width: 100%;
    }

    .left-sidebar-layout, .right-sidebar-layout {
        display: flex;
        width: 100%;
    }

    .main-content1 {
        flex: 1;
        /* padding: 20px; */
    }

    .sidebar {
        width: 300px;
        /* padding: 20px; */
        background-color: #f4f4f4;
    }

    .sidebar.left {
        order: -1;
    }

    .sidebar.right {
        order: 1;
    }

    .full-width-layout, .left-sidebar-layout, .right-sidebar-layout {
        min-height:800px;
        background: white;
    }

    .sidebar img {
        width: 100%;
    }

    .sidebar {
        position: relative;
    }

    .sidebar p{
        position: absolute;
        width: 100%;
        text-align:center!important;
        top: -35px;
        color: grey!important;
        /* font-weight: bold; */
        /* text-shadow: 1px 1px 2px #ffffff, 0 0 25px #ffffff, 0 0 5px #ffffff; */
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
    let editor, editor1, editor2;
    $(document).ready(function() {

        var textarea = document.getElementById('editor');
        var textarea1 = document.getElementById('editor1');
        var textarea2 = document.getElementById('editor2');

        sceditor.create(textarea, {
            format: 'bbcode',
            style: 'https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/content/default.min.css',
            emoticonsEnabled: false
        });

        sceditor.create(textarea1, {
            format: 'bbcode',
            style: 'https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/content/default.min.css',
            emoticonsEnabled: false
        });

        sceditor.create(textarea2, {
            format: 'bbcode',
            style: 'https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/content/default.min.css',
            emoticonsEnabled: false
        });

        editor = sceditor.instance(textarea);
        editor1 = sceditor.instance(textarea1);
        editor2 = sceditor.instance(textarea2);
        function syncEditors(sourceEditor) {
            var content = sourceEditor.val();
            $(".content").val(content);
            if (editor !== sourceEditor && editor.val() !== content) {
                editor.val(content);
            }
            if (editor1 !== sourceEditor && editor1.val() !== content) {
                editor1.val(content);
            }
            if (editor2 !== sourceEditor && editor2.val() !== content) {
                editor2.val(content);
            }
        }

        editor.blur(function() {
            syncEditors(editor);
        });

        editor1.blur(function() {
            syncEditors(editor1);
        });

        editor2.blur(function() {
            syncEditors(editor2);
        });

        const bannerUpload = document.getElementById('banner-upload');

        bannerUpload.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $(".sidebar").html(`<img src="${e.target.result}" alt="Banner" />`);
                };
                reader.readAsDataURL(file);
            }

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
                    $(".side-url").val(responseData.path);
                    console.log('File uploaded successfully');
                } else {
                    console.error('File upload failed');
                }
            };

            xhr.onerror = function() {
                console.error('Request failed');
            };

            xhr.send(formData);
        });

        $("#banner").on('click', function() {
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
                        console.log("percent => ", percentComplete)

                        document.querySelector('.progress').style.display = 'block';
                        document.querySelector('.progress-bar').style.width = percentComplete + '%';
                        document.querySelector('.progress-bar').setAttribute('aria-valuenow', percentComplete);
                        document.querySelector('.progress-bar').innerText = Math.round(percentComplete) + '%';
                    }
                };

                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var responseData = JSON.parse(xhr.responseText);
                        $(".banner-url").val(responseData.path);
                        $(".banner-img").attr("src", '{{ static_asset('uploads') }}' + '/' + responseData.path);
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

        $(".choose-layout img").on('click', function() {
            layout = $(this).data("layout");
            $(".layout").val(layout);
            chooselayout(layout);
        })

        function chooselayout(layout) {
            if(layout == "full") {
                $(".full-width-layout").show();
                $(".left-sidebar-layout").hide();
                $(".right-sidebar-layout").hide();
            } else if(layout == "right") {
                $(".full-width-layout").hide();
                $(".left-sidebar-layout").show();
                $(".right-sidebar-layout").hide();
            } else if(layout == "left") {
                $(".full-width-layout").hide();
                $(".left-sidebar-layout").hide();
                $(".right-sidebar-layout").show();
            }
        }

        $(".sidebar").on('click', function() {
            $("#banner-upload").trigger('click');

        })

        // chooselayout('full');
        chooselayout('{{$layout}}');
    });

</script>
