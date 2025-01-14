@extends('frontend.partials.master')
@section('main-content')

<main id="main" class="main-content">

    <div id="content" class="page-resource">
        <div class="content_box">
            <div class="container-fluit pt-4">
                <div class="row">
                    <div class="col-md-2 sider">
                        <!-- <div class="side_title"><h5>Krenky</h5></div>
                        <div class="tag-page-gallery mb30">
                            <img src="{{ static_asset('images/img/art_thumb1.jpg') }}" alt="">
                            <a class="mt-10" href="#">My Profile</a>
                            <a class="" href="#">Logout</a>
                        </div> -->
                        <div class="tag-page-gallery mb30">
                            <div class="side_title"><h5>Resources</h5></div>
                            <a class="" href="#">Main</a>
                            <a class="" href="{{ route('coming') }}">FAQ</a>
                            <a class="" href="{{ route('coming') }}">Help & Support</a>
                            <a class="" href="{{ route('coming') }}">Become a Sponsor</a>
                            <a class="" href="{{ route('coming') }}">Printable Gallery</a>
                            <a class="" href="{{ route('coming') }}">Production Art Links</a>
                            <a class="" href="#">Logout</a>
                        </div>
                    </div>
                    <div class="col-md-10 center primary p-4">
                        <h3>RESOURCES</h3>
                        <h2>MAIN</h2>   
                        <p class="mt-3">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. 
                        </p>
                        <img src="{{ static_asset('images/img/resource-bg.jpg') }}" alt=""  class="mt-3">
                        <p  class="mt-3">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. 
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main><!-- End #main -->
@endsection

<style>
    .page-resource h2 {
        text-align: left;
    }
    .page-resource p {
        word-break: break-all;
        text-align: left;
    }

    .page-resource img {
        width: 100%;
    }
</style>

<style>
    h2, h3 {
        font-family: 'DrukTextWideBold', sans-serif;
    }
</style>