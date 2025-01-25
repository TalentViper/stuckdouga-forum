@extends('frontend.partials.master')

@section('main-content')
<link rel="stylesheet" href="https://icons.getbootstrap.com/assets/font/bootstrap-icons.min.css">

<main id="main" class="main-content">
    <div id="content" class="page-latest">
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
                    <div class="col-md-10 center primary">
                        <h2>All Galleries</h2>

                            <div class="row action-buttons">
                                
                                <ul class="pagination col-md-8 justify-content-end" role="menubar" aria-label="Pagination">
                                    {{ $gallery->appends(Request::except('page'))->links('pagination::bootstrap-4') }}
                                </ul>
                            </div>
                            <div class="gallery-content grid min-h-55">
                                @foreach($gallery as $gallery_item)
                                    <div class="gallery-item " data-id="{{ $gallery_item->id }}">
                                        <img src="{{ static_asset('uploads') . '/' . $gallery_item->gallery_url }}" alt="{{ $gallery_item->gallery_name }}">
                                        <div class="name" data-id="{{ $gallery_item->id }}">{{ $gallery_item->gallery_name }}</div>
                                        <div class="sub" data-id="{{ $gallery_item->user->id }}">{{ $gallery_item->user->full_name }}</div>
                                        <div class="sub sub-likes">Likes:<span style="font-size:14px;color:white"> {{ $gallery_item->likes }}</span></div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row action-buttons">
                                <ul class="pagination" role="menubar" aria-label="Pagination">
                                    {{ $gallery->appends(Request::except('page'))->links('pagination::bootstrap-4') }}
                                </ul>
                            </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

</main><!-- End #main -->
@endsection

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    $(document).ready(function() {
        var width = $(".gallery-content").width();
        var padding = (width % 205) / 2;
        $(".gallery-content").css("padding-left", padding + "px");
    });
</script>
<style>
    h2 {
        font-family: 'DrukTextWideBold', sans-serif;
    }

    .gallery-content .gallery-item img {
        width: 185px !important;
        height: 185px !important;
    }
</style>