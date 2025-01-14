@extends('frontend.partials.master')

@section('main-content')
<main id="main" class="main-content">

    <div id="content" class="page-account">
        <div class="content_box pt-4">
            <div class="container-fluit">
                <div class="row">
                    @include('frontend.partials.sidebar1')
                    <div class="col-md-10 center primary">
                        <h1>MY ACCOUNT</h1>
                        <img src="{{ static_asset('images/img/account_bg.jpg') }}" alt="" class="bg-1">
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
                        <div class="desc">
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

        </div>
    </div>

</main><!-- End #main -->

@endsection

<style>
    h1, h2 {
        font-family: 'DrukTextWideBold', sans-serif;
    }
</style>