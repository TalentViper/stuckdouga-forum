@extends('frontend.partials.master')

@section('main-content')
<main id="main" class="main-content">
    @if($user->my_background)
        <div id="content" class="page-account" style="background-image: url({{ static_asset('uploads/'. $user->my_background) }}) !important; background-repeat: no-repeat; background-size: 100% 100%;">
    @else
        <div id="content" class="page-account">
    @endif
        <div class="content_box pt-4">
            <div class="container-fluit p-5 pt-4">
                <div class="row">
                    @include('frontend.partials.sidebar1')
                    <div class="col-md-10 center primary">
                        <h1>MY ACCOUNT</h1>
                        @if(!empty($user->my_banner))
                            <img src="{{ static_asset('uploads/'. $user->my_banner) }}" alt="" class="bg-1" style="height: 400px">
                        @else
                            <img src="{{ static_asset('images/img/account-banner.jpg') }}" alt="" class="bg-1">
                        @endif
                        <div class="user-info">
                            <span class="name">{{ $user->full_name }}</span>
                            <span class="location">From:  {{ $user->location }}</span>
                            <span class="created">Joined: {{ $user->created_at->format('d.m.Y') }}</span>
                            <span class="posts">Galleries: {{ $gallery_count }}</span>
                        </div>
                        <div class="user-archive-info">
                            <div class="row">
                                <div class="item col-md-2 col-sm-3 col-xs-6">
                                    <div class="title">Last Logged</div>
                                    <div class="sub-title">Yesterday 9:20pm</div>
                                </div>
                                <div class="item col-md-2 col-sm-3 col-xs-6">
                                    <div class="title">Followers</div>
                                    <div class="sub-title">500</div>
                                </div>
                                <div class="item col-md-2 col-sm-3 col-xs-6">
                                    <div class="title">Following</div>
                                    <div class="sub-title">24</div>
                                </div>
                                <div class="item col-md-2 col-sm-3 col-xs-6">
                                    <div class="title">Totial Posts</div>
                                    <div class="sub-title">108 789</div>
                                </div>
                                <div class="item col-md-2 col-sm-3 col-xs-6">
                                    <div class="title">Profile Views</div>
                                    <div class="sub-title">1 654 646 </div>
                                </div>
                                <div class="item col-md-2 col-sm-3 col-xs-6">
                                    <div class="title">Likes</div>
                                    <div class="sub-title">5 453</div>
                                </div>
                            </div>
                        </div>
                        <div class="desc w-full" style="padding: 0; margin: 0;">
                                <div class="row min-h-500">
                                    @if($user->layout == "right")
                                        @if(!empty($user->my_side))
                                            <div class="col-md-3 img" style="padding-right: 0;">
                                                <img src="{{ static_asset('uploads/'. $user->my_side) }}" alt="">
                                            </div>
                                        @endif
                                    @endif

                                    <!-- style="background-image: url({{ static_asset('uploads/'. $user->my_background) }}); overflow: hidden;" -->
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
                </div>
            </div>

        </div>
    </div>

</main><!-- End #main -->

@endsection

<style>

    .page-account .desc img {
        height: 100%;   
    }
    .h-full {
        height: 100%;
    }
    .sidebar-profile {
        width: 260px !important;
        flex: 1;
    }

    .row>* {
        overflow: hidden;
    }
    .w-flexible {
        width: calc(100% - 260px) !important;
    }
    h1, h2 {
        font-family: 'DrukTextWideBold', sans-serif;
    }
    .my-content-profile {
        white-space: pre-wrap;
        text-align: left;
    }

    .min-h-500 {
        min-height: 500px;
    }

    .bg-cover {
        background-repeat: no-repeat;
        background-size: 100% 100%;
    }

    .aspects {
        object-fit: cover;
        aspect-ratio: 2/1;
    }
</style>