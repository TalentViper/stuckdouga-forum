@extends('frontend.partials.master')

@section('main-content')

<link rel="stylesheet" href="https://icons.getbootstrap.com/assets/font/bootstrap-icons.min.css">
<header class="my_head">
    <div id="member">
        <a href="{{ route('home') }}" class="hover"><img src="{{ static_asset('images/img/stuckdouga_logo.jpg') }}" alt="Stuck Douga" /></a>
        <div class="buttons">
            <button type="button" onclick="window.location.href='{{ route('openMessageForm', ['to_admin' => $user->username]) }}'">Send Message</button>
            <button type="button" onclick="window.location.href='{{ route('account') }}'">My Account</button>
            <button type="button" onclick="window.history.back()" >Go Back</button>
        </div>
    </div>
</header>
<main id="main" class="main-content">
    @if($user->my_background)
        <div id="content" class="page-member" style="background-image: url({{ static_asset('uploads/'. $user->my_background) }}) !important;">
    @else
        <div id="content" class="page-member">
    @endif
        <div class="content_box">
            <div class="container-fluit pt-4 p-4">
                <div class="row">
                    <div class="col-md-12 center primary">
                        @if(!empty($user->my_banner))
                            <img src="{{ static_asset('uploads/'. $user->my_banner) }}" alt="" class="bg-1" style="height: 400px">
                        @else
                            <img src="{{ static_asset('images/img/account-banner.jpg') }}" alt="" class="bg-1">
                        @endif
                        <div class="user-info">
                            <img width="160px" src="{{ $user->avatar == NULL ? ($user->gender == 'male' ? static_asset('images/img/male_default.jpg') : static_asset('images/img/female_default.jpg')) : static_asset('uploads') . '/' . $user->avatar }}" alt="">
                            <span class="name">{{$user->full_name}}</span>
                            <span class="location">From:  {{$user->location}}</span>
                            <span class="created">Joined: {{\Carbon\Carbon::parse($user->created_at)->format('d.m.y');}}</span>
                            <span class="posts">Galleries: {{$count}}</span>
                        </div>
                        <div class="user-archive-info">
                            <div class="row">
                                <div class="item col-md-2 col-sm-3 col-xs-6">
                                    <div class="title">Last Logged</div>
                                    <div class="sub-title">Yesterday {{\Carbon\Carbon::parse($user->created_at)->format('d.m.y');}}</div>
                                </div>
                                <div class="item col-md-2 col-sm-3 col-xs-6">
                                    <div class="title">Followers</div>
                                    <div class="sub-title">{{ $followerCount }}</div>
                                </div>
                                <div class="item col-md-2 col-sm-3 col-xs-6">
                                    <div class="title">Following</div>
                                    <div class="sub-title">{{ $followingCount }}</div>
                                </div>
                                <div class="item col-md-2 col-sm-3 col-xs-6">
                                    <div class="title">Totial Posts</div>
                                    <div class="sub-title">{{ $thread }}</div>
                                </div>
                                <div class="item col-md-2 col-sm-3 col-xs-6">
                                    <div class="title">Profile Views</div>
                                    <div class="sub-title">{{$user->views}}</div>
                                </div>
                                <div class="item col-md-2 col-sm-3 col-xs-6">
                                    <div class="title">Likes</div>
                                    <div class="sub-title">5 453</div>
                                </div>
                            </div>
                        </div>
                        <ul class="nav nav-underline tab-buttons">
                            <li class="nav-item">
                              <a class="nav-link" aria-current="page" onclick="showTab('profile-info')">Profile Info</a>
                            </li>
                            @if(count($news) > 0)
                                <li class="nav-item">
                                    <a class="nav-link" onclick="showTab('news-updates')">News & Updates</a>
                                </li>
                            @endif
                            @if(count($search) > 0)
                                <li class="nav-item">
                                    <a class="nav-link"  onclick="showTab('galleries')">Galleries</a>
                                </li>
                            @endif
                            @if(!empty($user->private_content))
                                <li class="nav-item">
                                    <a class="nav-link" onclick="showTab('private-areas')">Private Areas</a>
                                </li>
                            @endif
                            @if(count($links) > 0)
                                <li class="nav-item">
                                    <a class="nav-link"  onclick="showTab('links')">Links</a>
                                </li>
                            @endif
                            @if(count($whishlists) > 0)
                                <li class="nav-item">
                                    <a class="nav-link"  onclick="showTab('wishlist')">Wishlist</a>
                                </li>
                            @endif
                          </ul>
                        <div id="profile-info" class="tab-content">
                            <div class="desc" style="overflow: hidden;">
                                <div class="row">
                                    @if($user->layout == "right")
                                        @if(!empty($user->my_side))
                                            <div class="col-md-3 img" style="padding-right: 0;">
                                                <img src="{{ static_asset('uploads/'. $user->my_side) }}" alt="">
                                            </div>
                                        @endif
                                    @endif

                                    <!-- style="background-image: url({{ static_asset('uploads/'. $user->my_background) }});" -->
                                    <div class="{{ (($user->layout == 'full' || empty($user->my_side)) ? 'col-md-12' : 'col-md-9') }} text p-0 bg-cover" >
                                        <div class="p-4 mr-2">
                                            @if(!empty($user->my_content))
                                                <div class="my-content-profile"> @stripBBCode($user->my_content)</div>
                                            @else 
                                                <h5 style="color: #999;" class="mt-4">
                                                    Upload your content here
                                                </h5>
                                            @endif
                                        </div>
                                    </div>

                                    @if($user->layout == "left")
                                        @if(!empty($user->my_side))
                                            <div class="col-md-3 img" style="padding-left: 0;">
                                                <img src="{{ static_asset('uploads/'. $user->my_side) }}" alt="">
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div id="news-updates" class="tab-content">
                            <!-- Content for News & Updates -->
                             @if(count($news) > 0)
                                <table class="table">
                                    <tbody>
                                        @foreach($news as $newsItem)
                                            <tr>
                                                <td class="description" width="90%">
                                                @stripBBCode($newsItem->content)
                                                </td>
                                                <td width="10%" class="text-center">
                                                    {{ \Carbon\Carbon::parse($newsItem->created_at)->format('d/m/Y') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else 
                                <p>No news found.</p>
                            @endif
                        </div>
                        <div id="galleries" class="tab-content">
                            <!-- Content for Galleries -->
                            <div class="row action-buttons">
                                <div class="view-buttons col-md-4">
                                    <form class="m-0">
                                        <div class="input-group flex-nowrap">
                                            <span class="input-group-text" id="addon-wrapping">
                                                <i class="bi bi-search"></i>
                                            </span>
                                            <input type="text" class="form-control" placeholder="Search galleries"
                                                aria-label="Search galleries" aria-describedby="addon-wrapping"
                                                name="keyword"
                                            >
                                        </div>
                                    </form>
                                </div>
                                <ul class="pagination col-md-5 justify-content-end" role="menubar" aria-label="Pagination">
                                    {{ $search->appends(Request::except('page'))->links('pagination::bootstrap-4') }}
                                </ul>
                                <div class="social-buttons col-md-3 text-end">
                                    <a class="show-list cursor-pointer">
                                        <i class="bi bi-list"></i>
                                    </a>
                                    <a class="show-table cursor-pointer">
                                        <i class="bi bi-grid-3x3-gap-fill"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="gallery-content grid row">
                                @foreach($search as $gallery)
                                    <div class="gallery-item col-md-2 cursor-pointer" data-id="{{$gallery->id}}">
                                        <div class="border-4">
                                            <img src="{{ static_asset('uploads') . '/' . $gallery->gallery_url }}" alt="{{ $gallery->gallery_name }}" />
                                        </div>
                                        <div class="name">{{ $gallery->gallery_name }}</div>
                                        <div class="sub" data-id="{{$gallery->user->id}}">{{ $gallery->updated_at->format('d/m/Y') }}</div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="gallery-content1 row">
                                <div class="col-md-6 left-data">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th width="33%" class="description border-bottom-none">Title</th>
                                                <th width="33%" class="border-bottom-none">ArtWork</th>
                                                <th width="33%" class="border-bottom-none">Last Updated</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($search as $key => $gallery)
                                                @if($key < 12)
                                                    <tr>
                                                        <td colspan="3" style="padding-top: 7px; padding-bottom: 7px;">
                                                            <p style="margin-bottom: 0px;">
                                                                {{ $gallery->gallery_name }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <span style="color: #ccc;">
                                                                    .... ({{ count($gallery->artworks) }}) .... &nbsp;&nbsp;&nbsp; {{\Carbon\Carbon::parse($gallery->created_at)->format('d/m/y');}}
                                                                </span>
                                                            </p>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @if(count($search) >= 12)
                                    <div class="col-md-6 right-data">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th width="33%" class="description border-bottom-none">Title</th>
                                                    <th width="33%" class="border-bottom-none">ArtWork</th>
                                                    <th width="33%" class="border-bottom-none">Last Updated</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($search as $key => $gallery)
                                                    @if($key >= 12)
                                                        <tr>
                                                            <td colspan="3" style="padding-top: 7px; padding-bottom: 7px;">
                                                                <p style="margin-bottom: 0px;">
                                                                    {{ $gallery->gallery_name }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <span style="color: #ccc;">
                                                                        .... ({{ count($gallery->artworks) }}) .... &nbsp;&nbsp;&nbsp; {{\Carbon\Carbon::parse($gallery->created_at)->format('d/m/y');}}
                                                                    </span>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                            <div class="row action-buttons bottom-actions">
                                <ul class="pagination" role="menubar" aria-label="Pagination">
                                    {{ $search->appends(Request::except('page'))->links('pagination::bootstrap-4') }}
                                </ul>
                            </div>
                        </div>
                        <div id="private-areas" class="tab-content">
                            <!-- Content for Private Areas -->
                            <h1>Private Area</h1>
                            @if(session()->has('user_private'))
                                <p>
                                @stripBBCode( session()->get('user_private') )
                                </p>
                            @else
                                <form class="password-form">
                                    <p>This content is password protected. Please contact this user to obtain the access.</p>
                                    <div class="password-input-container">
                                        <input type="password" id="password-input" name="password-input" placeholder="Insert Password" autocomplete="off">
                                    </div>
                                    <button type="submit" class="password-button">Submit</button>
                                </form>
                            @endif
                        </div>
                        <div id="links" class="tab-content">
                            <!-- Content for Links -->
                            <h1>Links</h1>
                            <table class="table">
                                <tbody>
                                    @foreach($links as $link)
                                        <tr>
                                            <td class="priority">
                                                <a href="{{ $link->url }}" target="_blank">{{ $link->name }}</a>
                                            </td>
                                            <td class="description">
                                                {{ $link->desc }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                        <div id="wishlist" class="tab-content">
                            <!-- Content for Wishlist -->
                            <h1>Wishlist</h1>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th width="70%" class="description border-bottom-none">Series / Description</th>
                                    <th width="15%" class="border-bottom-none">Sample</th>
                                    <th width="15%" class="border-bottom-none">Priority</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($whishlists as $list)
                                        <tr>
                                            <td class="description">
                                                {{ $list->description }}
                                            </td>
                                            <td>
                                                @if($list->url) 
                                                    <img src="{{ static_asset('uploads/'. $list->url) }}" alt="">
                                                @endif
                                            </td>
                                            <td class="priority">
                                                {{ $list->priority }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main><!-- End #main -->

<script>
    function showTab(tabId) {
        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(function(content) {
            content.classList.remove('active');
        });

        // Show the selected tab content
        document.getElementById(tabId).classList.add('active');

        // Remove active class from all tab links
        document.querySelectorAll('.nav-link').forEach(function(link) {
            link.parentElement.classList.remove('active');
        });

        // Add active class to the clicked tab link
        document.querySelector(`a[onclick="showTab('${tabId}')"]`).parentElement.classList.add('active');

        // Store the active tab in local storage
        localStorage.setItem('activeTab', tabId);
    }
</script>

<style>

    ul.tab-buttons li {
        padding: 0 !important;
    }

    .page-member .tab-buttons li a {
        padding: 10px 22px !important;
    }
    .tab-content {
        display: none;
        min-height: 350px;
        padding: 16px;
    }

    .bg-cover {
        background-repeat: no-repeat;
        background-size: cover;
    }

    .my-content-profile {
        white-space: pre-wrap;
        text-align: left;
    }

    #links table tr td a {
        color: red;
        text-decoration: underline;
    }

    #links table tr td a:hover {
        text-decoration: underline;
    }

    #news-updates table td {
        background-color: transparent;
        color: #fff;
        padding-top: 25px;
        vertical-align: middle;
    }

    .border-4 {
        border: 4px solid #fff;
    }

    #password-input {
        text-align: center;
        padding: 10px 120px;
    }

    #profile-info {
        padding: 0px;
    }

    .tab-content.active {
        display: block;
    }

    .password-button {
        padding: 5px 40px;
        color: white;
        background: red;
        border: none;
        margin-top: 16px;
    }

    .password-button:hover {
        background:black;
    }

    #password-input {
        width: 450px;
        padding: 10px 150px;
        border-radius: 20px;
    }

    .password-form {
        padding-top: 150px;
        padding-bottom: 200px;
        border-bottom: 1px solid white;
    }

    #password-input::placeholder {
        color: grey;
    }

    h1 {
        text-align: left;
        padding-left: 10px;
    }

    .nav-link:hover {
        cursor: pointer;
    }

    #wishlist th, #wishlist td, #links th, #links td, #galleries th, #galleries td {
        background: transparent!important;
        color: white!important;
        padding-top: 10px;
        padding-bottom: 10px;
    }

    #galleries td {
        border: none!important;
    }

    #links th, #links td {
        padding-top: 20px;
        padding-bottom: 20px;
    }

    #wishlist td img {
        width: 60%;
        object-fit: 60%;
        aspect-ratio: 1/1;
    }

    #wishlist .description,#links .description {
        text-align: left;
        word-break: break-all;
    }

    #wishlist tr {
        padding-top: 10px!important;
        padding-bottom: 10px!important;
    }

    #wishlist .priority {
        vertical-align: middle;
    }

    .border-bottom-none {
        border-bottom: none!important;
    }

    .gallery-item {
        text-align: center;
    }

    .gallery-item img {
        width: 100%;
        object-fit: cover;
        aspect-ratio: 1/1;
    }

    #galleries {
        padding:0px!important;
    }

    .gallery-content {
        margin: 0px;
        padding: 16px;
        max-height: 730px;
        overflow: auto;
    }

    .page-member .view-buttons {
        margin-top: 4px;
    }

    .page-member .view-buttons span {
        border-top-left-radius: 20px;
        border-bottom-left-radius: 20px;
    }

    .page-member .view-buttons input {
        border-top-right-radius: 20px;
        border-bottom-right-radius: 20px;
    }

    .gallery-item .name {
        opacity: 0.8;
    }

    .gallery-item .sub {
        opacity: 0.5;
        font-size: 12px;
        margin-bottom: 12px;
    }

    #links thead {
        opacity: 0;
    }

    #links .priority {
        width: 20%;
    }

    .left-data table{
        width: 70%;
        float: right;
    }
    .right-data {
        border-left: 1px solid white;
    }

    .right-data table{
        width: 70%;
        float: left;
        margin-left: 45px;
    }

    .gallery-content1 {
        padding-top: 30px;
        padding-bottom: 30px;
    }

    #galleries table tr td:nth-child(2),#galleries table tr td:nth-child(3) {
        font-size: 16px;
        opacity: 0.6;
    }
</style>

@endsection

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
$(document).ready(function() {
    $(".gallery-content1").hide();

    $(".show-table").on('click', function(){
        $(".gallery-content1").hide();
        $(".bottom-actions").show();
        $(".gallery-content").show();
    });

    $(".show-list").on('click', function(){
        $(".gallery-content1").show();
        $(".bottom-actions").hide();
        $(".gallery-content").hide();
    });

    // Check for the active tab in local storage and show it
    const activeTab = localStorage.getItem('activeTab');
    if (activeTab) {
        showTab(activeTab);
    } else {
        // Set a default active tab if none is stored
        showTab('profile-info');
    }

    $(".gallery-content .gallery-item").on('click', function() {
        var galleryId = $(this).data('id');
        window.location.href = '{{ route("gallery", ["id" => "PLACEHOLDER"]) }}'.replace('PLACEHOLDER', galleryId);
    });
});
</script>
