@extends('frontend.partials.master')

@section('main-content')

<link rel="stylesheet" href="https://icons.getbootstrap.com/assets/font/bootstrap-icons.min.css">
<main id="main" class="main-content">
    <div id="content" class="page-gallery-view">
        <div class="content_box">
            <div class="container-fluit p-5 pt-4">
                <div class="row">
                    <div class="col-md-2 sider">
                        <div class="side_title">
                            <h5>{{ $user->full_name }}</h5>
                        </div>
                        <div class="tag-page-gallery mb30">
                            <img src="{{ $user->avatar ? static_asset('uploads/' . $user->avatar) : ( $user->gender == 'female' ? static_asset('images/img/female_default.jpg') : static_asset('images/img/male_default.jpg') ) }}" alt="" width="200">
                            <a class="{{ Request::routeIs('user.profile') ? 'active' : '' }} mt-10" href="{{ route('user.profile', ['id' => $user->id, 'galleryId' => $galleryId]) }}">View Profile</a>
                            <a class="" href="{{ route('openMessageForm', $user->username) }}">Send Message</a>
                            <a 
                                class="{{ Request::routeIs('user.gallery') ? 'active' : '' }}" 
                                href="{{ route('user.gallery', ['id' => $user->id, 'galleryId' => $galleryId]) }}"
                            >
                                All Galleries
                            </a>
                            <!-- <a class="" href="#">User Topics</a> -->
                            <a 
                                class="{{ Request::routeIs('user.private') ? 'active' : '' }}" 
                                href="{{ route('user.private', ['id' => $user->id, 'galleryId' => $galleryId]) }}"
                            >
                                Private Area
                            </a>
                        </div>
                    </div>
                    <div class="col-md-10 center primary detail-info">
                        <h3>User Profile</h3>

                        <div class="gallery-content">
                            <div class="row">
                                <div class="col-md-12">
                                    @if($banner != NULL)
                                        <img src="{{ static_asset('uploads/' . $banner) }}" alt="" class="banner-img">
                                    @endif
                                </div>
                            </div>
                            <div class="row mt-4">
                                @if($layout == "full")
                                    <div class="full-width-layout">
                                        <div class="main-content1">
                                            <div  class="text-lg text-left" id="editor">{{$content}}</div>
                                            <!-- Content goes here -->
                                        </div>
                                    </div>
                                @elseif($layout == "left")
                                    <div class="left-sidebar-layout">
                                        <div class="sidebar left">
                                            <img src="{{ $side == NULL ? static_asset('images/img/member.jpg') : static_asset('uploads/' . $side) }}" alt="Banner" />
                                        </div>
                                        <div class="main-content1">
                                            <div class="text-lg text-left" id="editor1">{{$content}}</div>
                                            <!-- Content goes here -->
                                        </div>
                                    </div>
                                @else 
                                    <div class="right-sidebar-layout">
                                        <div class="main-content1">
                                            <div class="text-lg text-left" id="editor2">{{$content}}</div>
                                            <!-- Content goes here -->
                                        </div>
                                        <div class="sidebar right">
                                            <img src="{{ $side == NULL ? static_asset('images/img/member.jpg') : static_asset('uploads/' . $side) }}" alt="Banner" />
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

</main><!-- End #main -->
@endsection

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<style>
    h2 {
        font-family: 'DrukTextWideBold', sans-serif;
    }

    .banner-img {
        max-width: 100%;
    }
    
    .full-width-layout {
        display: flex;
        flex-direction: column;
        width: 100%;
    }

    .left-sidebar-layout, .right-sidebar-layout {
        display: flex;
        width: 100%;
        gap: 1.5rem
    }

    .main-content1 {
        word-wrap: break-word;
        white-space: pre-wrap;
        width: 100%;
        flex: 1;
    }

    .sidebar {
        width: 300px;
    }

    .sidebar.left {
        order: -1;
    }

    .sidebar.right {
        order: 1;
    }

    .full-width-layout, .left-sidebar-layout, .right-sidebar-layout {
        min-height:800px;
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
        text-align: center !important;
        top: -35px;
        color: grey !important;
    }

    .text-lg {
        font-size: 1.2rem;
    }
    .text-left {
        text-align: left;
    }
</style>
