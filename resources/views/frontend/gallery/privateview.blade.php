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
                        <h3>Private Area</h3>

                        <div class="gallery-content ">
                            <div class="row">
                                <div class="col-md-12 min-h-50">
                                    <div class="text-lg text-left pre-view">{{$user->private_content}}</div>
                                </div>
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
    .pre-view {
        word-wrap: break-word;
        white-space: pre-wrap;
    }
    .text-lg {
        font-size: 1.15rem;
    }
    .text-left {
        text-align: left;
    }
</style>