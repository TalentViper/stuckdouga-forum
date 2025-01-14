@extends('frontend.partials.master')

@section('main-content')

<link rel="stylesheet" href="https://icons.getbootstrap.com/assets/font/bootstrap-icons.min.css">
<header class="my_head">
    <div id="member">
        <a href="#" class="hover"><img src="{{ static_asset('images/img/stuckdouga_logo.jpg') }}" alt="Stuck Douga" /></a>
        <div class="buttons">
            <button type="button">Send Message</button>
            <button type="button" onclick="window.location.href='{{ route('account') }}'">My Account</button>
            <button type="button" onclick="window.history.back()" >Go Back</button>
        </div>
    </div>
</header>
<main id="main" class="main-content">
    <div id="content" class="page-member">
        <div class="content_box">
            <div class="container-fluit pt-4">
                <div class="row">
                    <div class="col-md-12 center primary">
                        <img src="{{ static_asset('images/img/member_bg1.jpg') }}" alt="" class="bg-1">
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
                            <li class="nav-item">
                              <a class="nav-link" onclick="showTab('news-updates')">News & Updates</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link"  onclick="showTab('galleries')">Galleries</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" onclick="showTab('private-areas')">Private Areas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"  onclick="showTab('links')">Links</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"  onclick="showTab('wishlist')">Wishlist</a>
                            </li>
                          </ul>
                        <div id="profile-info" class="tab-content">
                            <div class="desc">
                                <div class="row">
                                    <div class="col-md-3 img">
                                        <img src="{{ static_asset('images/img/member.jpg') }}" alt="">
                                    </div>
                                    <div class="col-md-9 text">
                                        <h2>ABOUT MY WORK</h2>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.
                                        </p>
                                        <img src="{{ static_asset('images/img/account_bg1.jpg') }}" alt="">
                                        <h2>MY BIO</h2>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="news-updates" class="tab-content">
                            <!-- Content for News & Updates -->
                            <p>News & Updates content goes here.</p>
                        </div>
                        <div id="galleries" class="tab-content">
                            <!-- Content for Galleries -->
                            <div class="row action-buttons">
                                <div class="view-buttons col-md-4">
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="addon-wrapping">
                                            <i class="bi bi-search"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Search galleries"
                                            aria-label="Search galleries" aria-describedby="addon-wrapping">
                                    </div>
                                </div>
                                <ul class="pagination col-md-5 justify-content-end" role="menubar" aria-label="Pagination">
                                    {{ $search->appends(Request::except('page'))->links('pagination::bootstrap-4') }}
                                </ul>
                                <div class="social-buttons col-md-3 text-end">
                                    <a href="#" class="show-list">
                                        <i class="bi bi-list"></i>
                                    </a>
                                    <a href="#" class="show-table">
                                        <i class="bi bi-grid-3x3-gap-fill"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="gallery-content grid row">
                                @foreach($search as $gallery)
                                    <div class="gallery-item col-md-3" data-id="{{$gallery->id}}">
                                        <img src="{{ static_asset('uploads') . '/' . $gallery->gallery_url }}" alt="{{ $gallery->gallery_name }}">
                                        <div class="name">{{ $gallery->gallery_name }}</div>
                                        <div class="sub" data-id="{{$gallery->user->id}}">{{ $gallery->user->full_name }}</div>
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

                                        </tbody>
                                    </table>
                                </div>
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

                                        </tbody>
                                    </table>
                                </div>
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
                            <form class="password-form">
                                <p>This content is password protected. Please contact this user to obtain the access.</p>
                                <div class="password-input-container">
                                    <input type="text" id="password-input" name="password-input" placeholder="Insert Password">
                                </div>
                                <button type="submit" class="password-button">Submit</button>
                            </form>
                        </div>
                        <div id="links" class="tab-content">
                            <!-- Content for Links -->
                            <h1>Links</h1>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="priority">
                                            RubberSlug
                                        </td>
                                        <td class="description">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="priority">
                                            My YouTube Channel
                                        </td>
                                        <td class="description">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="priority">
                                            Japanese Anime Art Group
                                        </td>
                                        <td class="description">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="priority">
                                            My Personal Website
                                        </td>
                                        <td class="description">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.
                                        </td>
                                    </tr>
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
                                <tr>
                                    <td class="description">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.
                                    </td>
                                    <td>
                                        <img src="{{ static_asset('images/img/t3.jpg') }}" alt="">
                                    </td>
                                    <td class="priority">
                                        High
                                    </td>
                                </tr>
                                <tr>
                                    <td class="description">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.
                                    </td>
                                    <td>
                                        <img src="{{ static_asset('images/img/t3.jpg') }}" alt="">
                                    </td>
                                    <td class="priority">
                                        High
                                    </td>
                                </tr>
                                <tr>
                                    <td class="description border-bottom-none">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.
                                    </td>
                                    <td class="border-bottom-none">
                                        <img src="{{ static_asset('images/img/t3.jpg') }}" alt="">
                                    </td>
                                    <td class="priority border-bottom-none">
                                        High
                                    </td>
                                </tr>
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
    .tab-content {
        display: none;
        min-height: 840px;
        max-height: 840px;
        padding: 16px;
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
        width: 80%;
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
        margin-bottom: 20px;
    }

    #links thead {
        opacity: 0;
    }

    #links .priority {
        width: 20%;
    }

    .left-data {
        border-right: 1px solid white;
    }

    .left-data table{
        width: 70%;
        float: right;
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

    $(".gallery-content .gallery-item img").on('click', function(){
        // Handle image click
    });

    $(".gallery-content .gallery-item .name").on('click', function(){
        // Handle name click
    });

    $(".gallery-content .gallery-item .sub").on('click', function(){
        // Handle sub click
    });

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
});
</script>
