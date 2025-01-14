@extends('frontend.partials.master')

@section('main-content')
    <div class="threads-show-page">
        <div id="content">
            <div class="content_box">
                <div class="container-fluid pt-4">
                    <h1>COMMUNITY</h1>
                    <p>Your Total Comments: 1 423</p>
                    <p>Your Total Likes: 10 545</p>
                    <div class="action-buttons">
                        <button type="button" class="new-button">News Feed</button>
                        <button type="button" class="comment-button">Your Comments</button>
                        <button type="button" class="thread-button">Thread Gallery</button>
                        <button type="button" class="go-back">Go Back</button>
                    </div>
                    <div class="clear"></div>
                    <div class="card mt-3">
                        <div class="card-header thread-title gradient-background">
                            The Best Japanese ArtWork for 2024
                        </div>
                        <div class="card-body thread-body">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li><a href="#">Home</a></li>
                                    <li><a href="#">Community</a></li>
                                    <li><a href="#">Top Threads</a></li>
                                    <li class="active">Best Japanese ArtWork for2024</li>
                                </ul>
                            </nav>
                            <div class="info">
                                <div class="icon-text">
                                    <i class="fa-classic fa-regular fa-user fa-fw"></i>
                                    <span>
                                        rlawry
                                    </span>
                                </div>
                                <div class="icon-text">
                                    <i class="fa-classic fa-regular fa-clock fa-fw"></i>
                                    <span>
                                        Jan 13, 2023
                                    </span>
                                </div>
                                <div class="icon-text">
                                    <i class="fa-classic fa-solid fa-tags fa-fw"></i>
                                    <span>
                                        None
                                    </span>
                                </div>
                            </div>
                            <div class="search-group input-group mt-3 mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa-classic fa-solid fa-magnifying-glass fa-fw"></i>    
                                </span>
                                </div>
                                <input type="text" class="form-control" placeholder="Search this thread...">
                            </div>
                            <div class="row justify-content-between pagination-button">
                                <div class="col-md-6">
                                    <ul class="my-pagination" role="menubar" aria-label="Pagination">
                                        <li><a href="#" class="mr-1"><span><i class="fa-classic fa-solid fa-caret-left fa-fw"></i>Prev</span></a></li>
                                        <li><a href="#">1</a></li>
                                        <li><a href="#">...</a></li>
                                        <li><a href="#">45</a></li>
                                        <li><a href="#">46</a></li>
                                        <li><a href="#" class="active">47</a></li>
                                        <li><a href="#">48</a></li>
                                        <li><a href="#">49</a></li>
                                        <li><a href="#">...</a></li>
                                        <li><a href="#">128</a></li>
                                        <li><a href="#" class="ml-1"><span>Next<i class="fa-classic fa-solid fa-caret-right fa-fw"></i></span></a></li>
                                    </ul>
                                </div>
                                <div class="col-md-6 watch-button">
                                    <button type="button" class="button">Watch Thread</button>
                                </div>
                            </div>
                            <div class="card thread-item">
                                <div class="card-header justify-content-between">
                                    <span>Oct11, 2023 at 11:55PM</span>
                                    <span>Post#691 of 1,906</span>
                                </div>  
                                <div class="card-content">
                                    <div class="avatar-panel justify-content-between">
                                        <div class="img-container">
                                            <img src="{{ static_asset('images/img/t2.jpg') }}" alt="Profile Picture">
                                            <div class="text-container">
                                                <div class="title">phoneslave86</div>
                                                <div class="name">
                                                    <span class="time">100+ Head-Fier</sapn>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="avatar-date">
                                            <div class="date-item">
                                                Joined: <span>Jul 3,2023</span>
                                            </div>
                                            <div class="date-item">
                                                Posts: <span>347</span>
                                            </div>
                                            <div class="date-item">
                                                Likes: <span>688</span>
                                            </div>
                                            <div class="date-item">
                                                Location: <span>Florida</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="thread-content">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.
                                    </div>
                                    <div class="likes-panel">
                                        <a href="">
                                            <i class="fa-classic fa-solid fa-share-nodes fa-fw"></i>
                                            Share
                                        </a>
                                        <a href="">
                                            <i class="fa-classic fa-regular fa-thumbs-up fa-fw"></i>
                                            Like
                                        </a>
                                    </div>
                                </div>
                                <div class="card-footer justify-content-between gradient-background">
                                    <a href="#">Report</a>
                                    <a href="#">Reply</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card thread-item mt-3">
                        <div class="card-header justify-content-between">
                            <span>Oct11, 2023 at 11:55PM</span>
                            <span>Post#691 of 1,906</span>
                        </div>  
                        <div class="card-content">
                            <div class="avatar-panel justify-content-between">
                                <div class="img-container">
                                    <img src="{{ static_asset('images/img/t3.jpg') }}" alt="Profile Picture">
                                    <div class="text-container">
                                        <div class="title">phoneslave86</div>
                                        <div class="name">
                                            <span class="time">100+ Head-Fier</sapn>
                                        </div>
                                    </div>
                                </div>
                                <div class="avatar-date">
                                    <div class="date-item">
                                        Joined: <span>Jul 3,2023</span>
                                    </div>
                                    <div class="date-item">
                                        Posts: <span>347</span>
                                    </div>
                                    <div class="date-item">
                                        Likes: <span>688</span>
                                    </div>
                                    <div class="date-item">
                                        Location: <span>Florida</span>
                                    </div>
                                </div>
                            </div>
                            <div class="thread-content">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.
                            </div>
                            <div class="likes-panel">
                                <a href="">
                                    <i class="fa-classic fa-solid fa-share-nodes fa-fw"></i>
                                    Share
                                </a>
                                <a href="">
                                    <i class="fa-classic fa-regular fa-thumbs-up fa-fw"></i>
                                    Like
                                </a>
                            </div>
                        </div>
                        <div class="card-footer justify-content-between gradient-background">
                            <a href="#">Report</a>
                            <a href="#">Reply</a>
                        </div>
                    </div>

                    <div class="card thread-item mt-3">
                        <div class="card-header justify-content-between">
                            <span>Oct11, 2023 at 11:55PM</span>
                            <span>Post#691 of 1,906</span>
                        </div>  
                        <div class="card-content">
                            <div class="avatar-panel justify-content-between">
                                <div class="img-container">
                                    <img src="{{ static_asset('images/img/t3.jpg') }}" alt="Profile Picture">
                                    <div class="text-container">
                                        <div class="title">phoneslave86</div>
                                        <div class="name">
                                            <span class="time">100+ Head-Fier</sapn>
                                        </div>
                                    </div>
                                </div>
                                <div class="avatar-date">
                                    <div class="date-item">
                                        Joined: <span>Jul 3,2023</span>
                                    </div>
                                    <div class="date-item">
                                        Posts: <span>347</span>
                                    </div>
                                    <div class="date-item">
                                        Likes: <span>688</span>
                                    </div>
                                    <div class="date-item">
                                        Location: <span>Florida</span>
                                    </div>
                                </div>
                            </div>
                            <div class="thread-content">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.
                            </div>
                            <div class="likes-panel">
                                <a href="">
                                    <i class="fa-classic fa-solid fa-share-nodes fa-fw"></i>
                                    Share
                                </a>
                                <a href="">
                                    <i class="fa-classic fa-regular fa-thumbs-up fa-fw"></i>
                                    Like
                                </a>
                            </div>
                        </div>
                        <div class="card-footer justify-content-between gradient-background">
                            <a href="#">Report</a>
                            <a href="#">Reply</a>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-content">
                            <div class="row justify-content-between pagination-button mt-2 mb-1">
                                <div class="col-md-6">
                                    <ul class="my-pagination" role="menubar" aria-label="Pagination">
                                        <li><a href="#" class="mr-1"><span><i class="fa-classic fa-solid fa-caret-left fa-fw"></i>Prev</span></a></li>
                                        <li><a href="#">1</a></li>
                                        <li><a href="#">...</a></li>
                                        <li><a href="#">45</a></li>
                                        <li><a href="#">46</a></li>
                                        <li><a href="#" class="active">47</a></li>
                                        <li><a href="#">48</a></li>
                                        <li><a href="#">49</a></li>
                                        <li><a href="#">...</a></li>
                                        <li><a href="#">128</a></li>
                                        <li><a href="#" class="ml-1"><span>Next<i class="fa-classic fa-solid fa-caret-right fa-fw"></i></span></a></li>
                                    </ul>
                                </div>
                            </div>

                            <form  action="{{ route('comments.store', $thread) }}" method="POST" class="mb-2">
                                @csrf
                                <textarea name="body" id="editor"></textarea>
                                <button type="submit">Post Comment</button>
                            </form>

                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li><a href="#">Home</a></li>
                                    <li><a href="#">Community</a></li>
                                    <li><a href="#">Top Threads</a></li>
                                    <li class="active">Best Japanese ArtWork for2024</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
    <!-- <h1>{{ $thread->title }}</h1>
    <p>{{ $thread->body }}</p>
    <p>By: {{ $thread->user->full_name }}</p>

    <h2>Comments</h2>
    <ul>
        @foreach ($thread->comments as $comment)
            <li>
                {{ $comment->body }}
                <p>Likes: {{ $comment->likes_count }}</p>
                <form method="POST" action="{{ $comment->isLikedBy(auth()->user()) ? route('comments.unlike', $comment) : route('comments.like', $comment) }}">
                    @csrf
                    <button type="submit">{{ $comment->isLikedBy(auth()->user()) ? 'Unlike' : 'Like' }}</button>
                </form>
            </li>
        @endforeach
    </ul>

    <h3>Add a Comment</h3>
    <form method="POST" action="{{ route('comments.store', $thread) }}">
        @csrf
        <textarea name="body" placeholder="Add your comment"></textarea>
        <button type="submit">Submit</button>
    </form> -->
    <style>
        .threads-show-page {
            background: #e2e2e2;
        }

        .threads-show-page .content_box {
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .threads-show-page .container-fluid {
            background: #262626;
            padding-bottom: 20px;
        }

        .threads-show-page h1 {
            text-align: center;
        }

        .threads-show-page .action-buttons button {
            background: #555555;
            color: white;
            padding: 5px 40px;
            border: none !important;
        }

        .threads-show-page .go-back {
            float: right;
        }

        .threads-show-page .clear {
            clear: both;
        }
 
        .threads-show-page .card {
            border: none !important;
            border-radius: 0px;
        }

        .threads-show-page .card-body {
            padding: 0px!important;
        }

        .threads-show-page .thread-title {
            font-size: 25px;
            border-radius: 0px;
            font-weight: 600;
            color: white;
        }

        .breadcrumb {
            list-style: none;
            padding: 20px;
            margin: 0;
            display: flex;
            align-items: center;
            border-bottom: 1px solid lightgrey;
        }
        .breadcrumb li {
            display: flex;
            align-items: center;
            padding: 0px;
        }
        .breadcrumb li + li:before {
            content: ">";
            padding: 0 8px;
            color: #ccc;
        }
        .breadcrumb a {
            text-decoration: none;
            color: grey;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        .breadcrumb .active {
            color: #555;
            font-weight: bold;
        }

        .threads-show-page .info {
            padding: 20px;
            border-bottom: 1px solid lightgrey;
        }

        .icon-text {
            display: inline-flex;
            align-items: center;
            color: #4d4d4d;
        }

        .icon-text i {
            margin-right: 3px; /* Adjust the spacing as needed */
        }

        .gradient-background {
            background: linear-gradient(45deg, black, #b2040e);
        }

        .card-footer {
            border-radius: 0px!important;
            display: flex;
        }

        .card-footer a {
            color: white;
            text-decoration: none!important;
            display: block;
        }

        .search-group {
            margin-left: 16px;
            width: 400px;
        }

        .input-group-prepend {
            background: #ededed;
            padding-left: 5px!important;
            padding-right: 5px!important;
            border-top-left-radius: 6px;
            border-bottom-left-radius: 6px;
            color: #9d9d9d;
        }

        .input-group-text {
            margin-top: 5px;
            background: #ededed;
            border: none;
            padding-left: 3px;
            padding-right: 3px;
        }

        .search-group input {
            background: #ededed!important;
            border: none!important;
        }

        .pagination-button .pagination{
            float: left;
        }

        .pagination-button .watch-button button {
            float: right;
            border: none !important;
            box-shadow: 1px 1px;
            border-radius: 5px;
            padding: 5px 20px;
            margin-right: 16px;
            margin-top: 5px;
        }

        .my-pagination {
            float: left;
            padding-left: 0px!important;
            margin-left: 16px;
        }

        .my-pagination,
        .my-pagination li a {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
        }

        .my-pagination li {
            background: #e5eff9;
            list-style: none;
            padding: 0px!important;
        }

        .my-pagination li a {
            text-decoration: none;
            color: grey;
            height: 40px;
            width: 40px;
            font-size: 14px;
            padding-top: 1px;
            border: 1px solid rgba(0, 0, 0, 0.25);
            border-right-width: 1px;
            box-shadow: inset 0px 1px 0px 0px rgba(255, 255, 255, 0.35);
        }

        .my-pagination li:last-child a {
            border-right-width: 1px;
        }

        .my-pagination li a:hover {
            background: rgba(255, 255, 255, 0.2);
            border-top-color: rgba(0, 0, 0, 0.35);
            border-bottom-color: rgba(0, 0, 0, 0.5);
        }

        .my-pagination li.icon a {
            min-width: 120px;
        }

        .my-pagination li:first-child span {
            padding-right: 8px;
        }

        .my-pagination li:last-child span {
            padding-left: 8px;
        }

        .my-pagination li:first-child {
            margin-right: 5px;
        }

        .my-pagination li:last-child {
            margin-left: 5px;
        }

        .my-pagination li:first-child a {
            border-right: 1px solid;
        }
        .my-pagination li:last-child a, .my-pagination li:first-child a{
            width: 70px!important;
            border-radius: 5px!important;
        }
        .my-pagination li a.active {
            border: 1px solid #cf91fe!important;
        }

        .thread-item {
            background: #999!important;
            color: white!important;
        }

        .thread-item .card-header {
            display: flex!important;
        }

        .img-container {
            display: flex;
            gap: 16px; /* Adjust the spacing as needed */
            border-radius: 8px;
            max-width: 400px;
        }

        .img-container .title {
            font-size: 18px;
            font-weight: 600;
            color: #6b696a;
        }

        .img-container .name {
            color:black;
        }

        .img-container img {
            width: 140px; /* Adjust the image size as needed */
            height: 140px; /* Adjust the image size as needed */
        }

        .avatar-panel {
            padding: 16px;
            background: #ddd;
            display: flex;
        }

        .avatar-date {
            text-align: right;
            font-size: 14px;
            color: #9f9f9f;
        }

        .avatar-date span {
            color: black;
        }

        .likes-panel {
            background: #dddddd;
            padding: 6px 16px;
        }

        .thread-content {
            padding: 16px;
            color: black;
            background: #e6e6e6;
        }

        .likes-panel a {
            text-decoration: none!important;
        }

        .likes-panel a + a {
            margin-left: 16px;
        }

        .thread-body {
            background: transparent!important;
        }

        .sceditor-container {
            width: 100%!important;
            height: 250px!important;
        }
        
        form {
            padding: 16px;
        }

        form button {
            padding: 5px 40px;
            background: red;
            color: white;
            float: right;
            margin-top: 10px;
        }
    </style>
    <script>
        var textarea = document.getElementById('editor');
        sceditor.create(textarea, {
            format: 'bbcode',
            style: 'https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/content/default.min.css',
            emoticonsEnabled: false
        });
    </script>

@endsection
