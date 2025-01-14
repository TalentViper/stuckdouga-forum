@extends('frontend.partials.master')

@section('main-content')
    <div class="threads-index-page">
        <div id="content" class="page-threads">
            <div class="content_box">
                <div class="container-fluid pt-4">
                    <h1>COMMUNITY</h1>
                    <div class="sort-buttons">
                        <button type="button" class="latest-button">Latest Posts</button>
                        <button type="button" class="post-button">Post a New Topic</button>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            Sonsor Announcements and Deals
                        </div>
                        <div class="card-body">
                            <div class="list">
                                <div class="list-item row">
                                    <div class="col-md-7 title">
                                        <div class="icon-text">
                                            <i class="fa-classic fa-regular fa-comments fa-fw"></i>
                                            <span>
                                                <a href="{{ route('threads.show', 1) }}">Sponsor Announcements and Deals</a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <p class="count">Threads</p>
                                        <p>4.9K</p>
                                    </div>
                                    <div class="col-md-1">
                                        <p class="count">Messages</p>
                                        <p>316.3K</p>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="img-container">
                                            <img src="{{ static_asset('images/img/t2.jpg') }}" alt="Profile Picture">
                                            <div class="text-container">
                                                <div class="title">ifi audio ZEN Stream - Streaming</div>
                                                <div class="name">
                                                    <span class="time">31 minutes ago</sapn>
                                                    <span class="author">iFi audio</sapn>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            Help and Getting Started
                        </div>
                        <div class="card-body">
                            <div class="list">
                                <div class="list-item row">
                                    <div class="col-md-7 title">
                                        <div class="icon-text">
                                            <i class="fa-classic fa-regular fa-comments fa-fw"></i>
                                            <span>
                                                <a href="{{ route('threads.show', 1) }}">Introductions, Help and Recommendations</a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <p class="count">Threads</p>
                                        <p>70.1K</p>
                                    </div>
                                    <div class="col-md-1">
                                        <p class="count">Messages</p>
                                        <p>519.6K</p>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="img-container">
                                            <img src="{{ static_asset('images/img/t2.jpg') }}" alt="Profile Picture">
                                            <div class="text-container">
                                                <div class="title">aptX Adaptive / aptX Lossiess US</div>
                                                <div class="name">
                                                    <span class="time">26 minutes ago</sapn>
                                                    <span class="author">helmutcheese</sapn>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            Equipment Forums
                        </div>
                        <div class="card-body equipment">
                            <div class="list">
                                
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            Sonsor Announcements and Deals
                        </div>
                        <div class="card-body">
                            <div class="list">
                                <div class="list-item row">
                                    <div class="col-md-7 title">
                                        <div class="icon-text">
                                            <i class="fa-classic fa-regular fa-comments fa-fw"></i>
                                            <span>
                                                <a href="{{ route('threads.show', 1) }}">Sponsor Announcements and Deals</a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <p class="count">Threads</p>
                                        <p>4.9K</p>
                                    </div>
                                    <div class="col-md-1">
                                        <p class="count">Messages</p>
                                        <p>316.3K</p>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="img-container">
                                            <img src="{{ static_asset('images/img/t2.jpg') }}" alt="Profile Picture">
                                            <div class="text-container">
                                                <div class="title">ifi audio ZEN Stream - Streaming</div>
                                                <div class="name">
                                                    <span class="time">31 minutes ago</sapn>
                                                    <span class="author">iFi audio</sapn>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            Help and Getting Started
                        </div>
                        <div class="card-body">
                            <div class="list">
                                <div class="list-item row">
                                    <div class="col-md-7 title">
                                        <div class="icon-text">
                                            <i class="fa-classic fa-regular fa-comments fa-fw"></i>
                                            <span>
                                                <a href="{{ route('threads.show', 1) }}">Introductions, Help and Recommendations</a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <p class="count">Threads</p>
                                        <p>70.1K</p>
                                    </div>
                                    <div class="col-md-1">
                                        <p class="count">Messages</p>
                                        <p>519.6K</p>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="img-container">
                                            <img src="{{ static_asset('images/img/t2.jpg') }}" alt="Profile Picture">
                                            <div class="text-container">
                                                <div class="title">aptX Adaptive / aptX Lossiess US</div>
                                                <div class="name">
                                                    <span class="time">26 minutes ago</sapn>
                                                    <span class="author">helmutcheese</sapn>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .threads-index-page {
            background: #e2e2e2;
        }

        .threads-index-page .content_box {
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .threads-index-page .container-fluid {
            background: #262626;
            padding-bottom: 20px;
        }

        .threads-index-page h1 {
            text-align: center;
        }

        .threads-index-page .latest-button,.threads-index-page .post-button {
            background: #555555;
            color: #979797;
            padding: 5px 40px;
            border: none !important;
        }

        .threads-index-page .card {
            border: none !important;
            border-radius: 0px;
        }

        .threads-index-page .card-header {
            background: #4d4d4d;
            color: white;
            font-size: 20px;
            font-weight: 700;
            border-radius: 0px;
        }

        .threads-index-page .card {
            margin-top: 20px;
        }

        .threads-index-page .card-body {
            background: #e6e6e6!important;
            padding: 0px!important;
        }

        .threads-index-page .list-item {
            padding-top: 5px;
            padding-bottom: 5px;
            padding-left: 20px;
        }

        .threads-index-page .icon-text {
            margin-top: 8px;
        }

        .icon-text {
            display: inline-flex;
            align-items: center;
            color: #4d4d4d;
        }

        /* .icon-text span {
            font-size: 16px;
        }         */

        .icon-text span a{
            font-size: 16px;
            font-weight: 600;
            color: #4d4d4d;
        }        

        .icon-text i {
            margin-right: 8px; /* Adjust the spacing as needed */
            font-size: 30px;
        }

        .list-item .count {
            font-size:12px;
            color: #999;
        }

        .list-item p {
            text-align: center;
            margin-bottom: 3px!important
        }

        .img-container {
            display: flex;
            align-items: center;
            gap: 16px; /* Adjust the spacing as needed */
            /* padding: 16px; */
            /* border: 1px solid #ccc; */
            border-radius: 8px;
            max-width: 400px;
            /* margin: 20px auto; */
        }
        .img-container img {
            width: 40px; /* Adjust the image size as needed */
            height: 40px; /* Adjust the image size as needed */
        }
        .text-container {
            display: flex;
            flex-direction: column;
        }
        .text-container .title {
            font-size: 12px;
            color: #6b6969;
            margin-bottom: 4px;
        }
        .text-container .name {
            font-size: 14px;
            color: #ad99a3;
        }

        .text-container .author {
            color: #936969;
        }

        h1, h3 {
            font-family: 'DrukTextWideBold', sans-serif;
        }
    </style>
@endsection
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function() {
        $(".post-button").on('click', function() {
            window.location.href = '{{ route('threads.create') }}';
        })

        for(i = 0; i < 10; i++) {
            $( ".equipment .list" ).append(
                '<div class="list-item row">\
                                        <div class="col-md-7 title">\
                                            <div class="icon-text">\
                                                <i class="fa-classic fa-regular fa-comments fa-fw"></i>\
                                                <span><a href="{{ route('threads.show', 1) }}">Introductions, Help and Recommendations</a></span>\
                                            </div>\
                                        </div>\
                                        <div class="col-md-1">\
                                            <p class="count">Threads</p>\
                                            <p>70.1K</p>\
                                        </div>\
                                        <div class="col-md-1">\
                                            <p class="count">Messages</p>\
                                            <p>519.6K</p>\
                                        </div>\
                                        <div class="col-md-3">\
                                            <div class="img-container">\
                                                <img src="{{ static_asset('images/img/t2.jpg') }}" alt="Profile Picture">\
                                                <div class="text-container">\
                                                    <div class="title">aptX Adaptive / aptX Lossiess US</div>\
                                                    <div class="name">\
                                                        <span class="time">26 minutes ago</sapn>\
                                                        <span class="author">helmutcheese</sapn>\
                                                    </div>\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>'
            );

        }
    })
</script>


