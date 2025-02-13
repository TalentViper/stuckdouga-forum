@extends('frontend.partials.master')

@section('main-content')
<link rel="stylesheet" href="https://icons.getbootstrap.com/assets/font/bootstrap-icons.min.css">

<main id="main" class="main-content">

    <div id="content" class="page-latest">
        <div class="content_box">
            <div class="container-fluit pt-4">
                <div class="row">
                    <div class="col-md-2 sider">
                        <div class="side_title">
                            <h5>Show Galleries</h5>
                        </div>
                        <div class="tag-page-gallery mb30">
                            <a class="mt-10 active" href="{{ route('latest') }}">Latest Galleries</a>
                            <a class="" href="{{ route('update') }}">Updated Galleries</a>
                            <a class="" href="{{ route('popular') }}">Popular Galleries</a>
                            <a class="" href="{{ route('populartag') }}">Popular Tags</a>
                            <a class=""  href="{{ route('tags') }}">All Tags</a>
                        </div>
                        <div class="side_title">
                            <h5>Browse by Name</h5>
                        </div>
                        <div class="tag-page-browsername mt10">
                            <a href="{{ route('latest', 'A') }}">A</a>
                            <a href="{{ route('latest', 'B') }}">B</a>
                            <a href="{{ route('latest', 'C') }}">C</a>
                            <a href="{{ route('latest', 'D') }}">D</a>
                            <a href="{{ route('latest', 'E') }}">E</a>
                            <a href="{{ route('latest', 'F') }}">F</a>
                        </div>
                        <div class="tag-page-browsername">
                            <a href="{{ route('latest', 'G') }}">G</a>
                            <a href="{{ route('latest', 'H') }}">H</a>
                            <a href="{{ route('latest', 'I') }}">I</a>
                            <a href="{{ route('latest', 'J') }}">J</a>
                            <a href="{{ route('latest', 'K') }}">K</a>
                            <a href="{{ route('latest', 'L') }}">L</a>
                        </div>
                        <div class="tag-page-browsername">
                            <a href="{{ route('latest', 'M') }}">M</a>
                            <a href="{{ route('latest', 'N') }}">N</a>
                            <a href="{{ route('latest', 'O') }}">O</a>
                            <a href="{{ route('latest', 'P') }}">P</a>
                            <a href="{{ route('latest', 'Q') }}">Q</a>
                            <a href="{{ route('latest', 'R') }}">R</a>
                        </div>
                        <div class="tag-page-browsername">
                            <a href="{{ route('latest', 'S') }}">S</a>
                            <a href="{{ route('latest', 'T') }}">T</a>
                            <a href="{{ route('latest', 'U') }}">U</a>
                            <a href="{{ route('latest', 'V') }}">V</a>
                            <a href="{{ route('latest', 'W') }}">W</a>
                            <a href="{{ route('latest', 'X') }}">X</a>
                        </div>
                        <div class="tag-page-browsername">
                            <a href="{{ route('latest', 'Y') }}">Y</a>
                            <a href="{{ route('latest', 'Z') }}">Z</a>
                            <a href="{{ route('latest', '#') }}">#</a>
                            <a href="{{ route('latest', '?') }}">?</a>
                        </div> 
                    </div>
                    <div class="col-md-10 center primary">
                        <h2>LATEST GALLERIES</h2>
                        <div class="row action-buttons align-items-center">
                            <div class="view-buttons col-md-4">
                                <div class="input-group flex-nowrap" style="margin-top: 0px !important;">
                                    <span class="input-group-text" id="addon-wrapping">
                                        <i class="bi bi-search"></i>
                                    </span>
                                    <input type="text" id="search-input" class="form-control" placeholder="Search galleries"
                                        aria-label="Search galleries" aria-describedby="addon-wrapping">
                                </div>
                            </div>
                            <ul class="pagination col-md-8 justify-content-end" role="menubar" aria-label="Pagination">
                                {{ $search->appends(Request::except('page'))->links('pagination::bootstrap-4') }}
                            </ul>
                            <!-- <div class="social-buttons col-md-3 text-end">
                                <a href="#">
                                    <i class="bi bi-list"></i>
                                </a>
                                <a href="">
                                    <i class="bi bi-grid-3x3-gap-fill"></i>
                                </a>
                            </div> -->
                        </div>
                        <div class="gallery-content grid">
                            @if(count($search) > 0)
                                @foreach($search as $gallery)
                                    <div class="gallery-item" data-id="{{$gallery->id}}">
                                        <img src="{{ static_asset('uploads') . '/' . $gallery->gallery_url }}" alt="{{ $gallery->gallery_name }}">
                                        <div class="name">{{ $gallery->gallery_name }}</div>
                                        <div class="sub" data-id="{{ optional($gallery->user)->id }}">{{ optional($gallery->user)->full_name }}</div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-center mt-8" style="width: 90%;">No galleries found.</p>
                            @endif
                        </div>
                        <div class="row action-buttons">
                            <ul class="pagination" role="menubar" aria-label="Pagination">
                                {{ $search->appends(Request::except('page'))->links('pagination::bootstrap-4') }}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main><!-- End #main -->
@endsection
<!-- <script type="text/javascript" src="{{ static_asset('frontend/js/jquery-3.6.0.min.js') }}"></script> -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    $(document).ready(function() {
        $('.form-control').on('keypress', function(e) {
            if (e.which == 13) {
                console.log("???");
                e.preventDefault();
                var keyword = $(this).val();
                window.location.href = '{{ route("latest") }}/' + keyword;
            }
        });

        $(".gallery-content .gallery-item img").on('click', function(){
            var galleryId = $(this).parent().data('id');
            window.location.href = '{{ route("gallery", ["id" => "PLACEHOLDER"]) }}'.replace('PLACEHOLDER', galleryId);
        });

        $(".gallery-content .gallery-item .name").on('click', function(){
            var galleryId = $(this).parent().data('id');
            window.location.href = '{{ route("gallery", ["id" => "PLACEHOLDER"]) }}'.replace('PLACEHOLDER', galleryId);
        });

        $(".gallery-content .gallery-item .sub").on('click', function(){
            var userId = $(this).data('id');
            window.location.href = '{{ route("member", ["id" => "PLACEHOLDER"]) }}'.replace('PLACEHOLDER', userId);
        });

        var width = $(".gallery-content").width();
        var padding = (width % 205) / 2;
        $(".gallery-content").css("padding-left", padding + "px");
    });
</script>

<style>
    h2 {
        font-family: 'DrukTextWideBold', sans-serif;
    }

    .gallery-content {
        min-height: 500px;
    }

    .gallery-content .gallery-item img {
        width: 185px !important;
        height: 185px !important;
    }
</style>
