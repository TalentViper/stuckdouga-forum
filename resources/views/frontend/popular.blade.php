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
                            <a class="mt-10" href="{{ route('latest') }}">Latest Galleries</a>
                            <a class="" href="{{ route('update') }}">Updated Galleries</a>
                            <a class="active" href="{{ route('popular') }}">Popular Galleries</a>
                            <a class="" href="{{ route('populartag') }}">Popular Tags</a>
                            <a class=""  href="{{ route('tags') }}">All Tags</a>
                        </div>
                        <div class="side_title">
                            <h5>Browse by Name</h5>
                        </div>
                        <div class="tag-page-browsername mt10">
                            <a href="{{ route('popular', 'A') }}">A</a>
                            <a href="{{ route('popular', 'B') }}">B</a>
                            <a href="{{ route('popular', 'C') }}">C</a>
                            <a href="{{ route('popular', 'D') }}">D</a>
                            <a href="{{ route('popular', 'E') }}">E</a>
                            <a href="{{ route('popular', 'F') }}">F</a>
                        </div>
                        <div class="tag-page-browsername">
                            <a href="{{ route('popular', 'G') }}">G</a>
                            <a href="{{ route('popular', 'H') }}">H</a>
                            <a href="{{ route('popular', 'I') }}">I</a>
                            <a href="{{ route('popular', 'J') }}">J</a>
                            <a href="{{ route('popular', 'K') }}">K</a>
                            <a href="{{ route('popular', 'L') }}">L</a>
                        </div>
                        <div class="tag-page-browsername">
                            <a href="{{ route('popular', 'M') }}">M</a>
                            <a href="{{ route('popular', 'N') }}">N</a>
                            <a href="{{ route('popular', 'O') }}">O</a>
                            <a href="{{ route('popular', 'P') }}">P</a>
                            <a href="{{ route('popular', 'Q') }}">Q</a>
                            <a href="{{ route('popular', 'R') }}">R</a>
                        </div>
                        <div class="tag-page-browsername">
                            <a href="{{ route('popular', 'S') }}">S</a>
                            <a href="{{ route('popular', 'T') }}">T</a>
                            <a href="{{ route('popular', 'U') }}">U</a>
                            <a href="{{ route('popular', 'V') }}">V</a>
                            <a href="{{ route('popular', 'W') }}">W</a>
                            <a href="{{ route('popular', 'X') }}">X</a>
                        </div>
                        <div class="tag-page-browsername">
                            <a href="{{ route('popular', 'Y') }}">Y</a>
                            <a href="{{ route('popular', 'Z') }}">Z</a>
                            <a href="{{ route('popular', '#') }}">#</a>
                            <a href="{{ route('popular', '?') }}">?</a>
                        </div> 
                    </div>
                    <div class="col-md-10 center primary">
                        <h2>POPULAR GALLERIES</h2>
                        <div class="row action-buttons">
                            <div class="view-buttons col-md-4">
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="addon-wrapping">
                                        <i class="bi bi-search"></i>
                                    </span>
                                    <input type="text" id="search-input" class="form-control" placeholder="Search galleries"
                                        aria-label="Search galleries" aria-describedby="addon-wrapping">
                                </div>
                            </div>
                            <ul class="pagination col-md-5 justify-content-end" role="menubar" aria-label="Pagination">
                                {{ $search->appends(Request::except('page'))->links('pagination::bootstrap-4') }}
                            </ul>
                            <div class="social-buttons col-md-3 text-end">
                                <a href="#">
                                    <i class="bi bi-list"></i>
                                </a>
                                <a href="">
                                    <i class="bi bi-grid-3x3-gap-fill"></i>
                                </a>
                            </div>
                        </div>
                        <div class="gallery-content grid">
                            @foreach($search as $gallery)
                                <div class="gallery-item" data-id="{{ $gallery->id }}">
                                    <img src="{{ static_asset('uploads') . '/' . $gallery->gallery_url }}" alt="{{ $gallery->gallery_name }}">
                                    <div class="name" data-id="{{ $gallery->id }}">{{ $gallery->gallery_name }}</div>
                                    <div class="sub" data-id="{{ $gallery->user->id }}">{{ $gallery->user->full_name }}</div>
                                    <div class="sub sub-likes">Likes:<span style="font-size:14px;color:white"> {{ $gallery->likes }}</span></div>
                                </div>
                            @endforeach
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
                window.location.href = '{{ route("popular") }}/' + keyword;
            }
        });

        $(".gallery-content .gallery-item img").on('click', function(){
            var galleryId = $(this).parent().data('id');
            window.location.href = '{{ route("gallery", ["id" => "PLACEHOLDER"]) }}'.replace('PLACEHOLDER', galleryId);
        });

        $(".gallery-content .gallery-item .name").on('click', function(){
            var galleryId = $(this).data('id');
            window.location.href = '{{ route("gallery", ["id" => "PLACEHOLDER"]) }}'.replace('PLACEHOLDER', galleryId);
        });

        $(".gallery-content .gallery-item .sub").on('click', function(){
            var galleryId = $(this).parent().data('id');
            window.location.href = '{{ route("gallery", ["id" => "PLACEHOLDER"]) }}'.replace('PLACEHOLDER', galleryId);
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

    .gallery-content .gallery-item img {
        width: 185px!important;
        height: 185px!important;
    }
</style>
