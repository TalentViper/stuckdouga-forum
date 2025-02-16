@extends('frontend.partials.master')

@section('main-content')
<link rel="stylesheet" href="https://icons.getbootstrap.com/assets/font/bootstrap-icons.min.css">

<main id="main" class="main-content">

    <div id="content" class="page-update">
        <div class="content_box">
            <div class="container-fluit pt-4">
                <div class="row">
                    <div class="col-md-2 sider">
                        <div class="side_title">
                            <h5>UPDATED Galleries</h5>
                        </div>
                        <div class="tag-page-gallery mb30">
                            <a class="mt-10" href="{{ route('latest') }}">Latest Galleries</a>
                            <a class="active" href="{{ route('update') }}">Updated Galleries</a>
                            <a class="" href="{{ route('popular') }}">Popular Galleries</a>
                            <a class="" href="{{ route('populartag') }}">Popular Tags</a>
                            <a class=""  href="{{ route('tags') }}">All Tags</a>
                        </div>
                        <div class="side_title">
                            <h5>Browse by Name</h5>
                        </div>
                        <div class="tag-page-browsername mt10">
                            <a href="{{ route('update', 'A') }}">A</a>
                            <a href="{{ route('update', 'B') }}">B</a>
                            <a href="{{ route('update', 'C') }}">C</a>
                            <a href="{{ route('update', 'D') }}">D</a>
                            <a href="{{ route('update', 'E') }}">E</a>
                            <a href="{{ route('update', 'F') }}">F</a>
                        </div>
                        <div class="tag-page-browsername">
                            <a href="{{ route('update', 'G') }}">G</a>
                            <a href="{{ route('update', 'H') }}">H</a>
                            <a href="{{ route('update', 'I') }}">I</a>
                            <a href="{{ route('update', 'J') }}">J</a>
                            <a href="{{ route('update', 'K') }}">K</a>
                            <a href="{{ route('update', 'L') }}">L</a>
                        </div>
                        <div class="tag-page-browsername">
                            <a href="{{ route('update', 'M') }}">M</a>
                            <a href="{{ route('update', 'N') }}">N</a>
                            <a href="{{ route('update', 'O') }}">O</a>
                            <a href="{{ route('update', 'P') }}">P</a>
                            <a href="{{ route('update', 'Q') }}">Q</a>
                            <a href="{{ route('update', 'R') }}">R</a>
                        </div>
                        <div class="tag-page-browsername">
                            <a href="{{ route('update', 'S') }}">S</a>
                            <a href="{{ route('update', 'T') }}">T</a>
                            <a href="{{ route('update', 'U') }}">U</a>
                            <a href="{{ route('update', 'V') }}">V</a>
                            <a href="{{ route('update', 'W') }}">W</a>
                            <a href="{{ route('update', 'X') }}">X</a>
                        </div>
                        <div class="tag-page-browsername">
                            <a href="{{ route('update', 'Y') }}">Y</a>
                            <a href="{{ route('update', 'Z') }}">Z</a>
                            <a href="{{ route('update', '#') }}">#</a>
                            <a href="{{ route('update', '?') }}">?</a>
                        </div> 
                    </div>
                    <div class="col-md-10 primary">
                        <h2 class="center">UPDATED GALLERIES</h2>
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
                            <ul class="pagination top-pagination col-md-8 justify-content-end" role="menubar" aria-label="Pagination">
                                {{ $search->appends(Request::except('page'))->links('pagination::bootstrap-4') }}
                            </ul>
                        </div>
                        <div class="gallery-content grid pt-4">
                            @if(count($search))
                                @foreach($search as $gallery)
                                    <div class="row item" data-id="{{ $gallery->id }}">
                                        <div class="col">
                                            <div class="d-flex p-2">
                                                <div class="flex-shrink-0">
                                                    <img src="{{ static_asset('uploads') . '/' . $gallery->gallery_url }}" class="img-fluid rounded-start member-title" alt="..." style="width: 139px; height: 139px;" data-id="{{ $gallery->user->id }}">
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h5 class="gallery-title text-left"  data-id="{{ $gallery->id }}">{{ $gallery->gallery_name }}</h5>
                                                    <p class="member-title" data-id="{{ $gallery->user->id }}"><small class="text-body-secondary">by {{ $gallery->user->full_name }}</small></p>
                                                    <p class=""><small class="text-body-secondary">updated: {{ $gallery->updated_at->format('d/m/Y \a\t h:ia') }}</small></p>
                                                    <p class=""><small class="text-body-secondary">artwork: {{ $gallery->artwork_count }} items</small></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col explore">
                                            <div>
                                                @foreach($gallery->artworks as $artwork)
                                                    <img class="artwork" data-id="{{ $artwork->id }}" src="{{ static_asset('uploads') . '/' . $artwork->img_main }}" alt="">
                                                @endforeach

                                                @if($gallery->artwork_count > 5)
                                                    <span>Explore</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else 
                                <p class="text-center mt-8" style="width: 100%;">No galleries found.</p>
                            @endif
                        </div>
                        <div class="row action-buttons justify-content-center">
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

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    $(document).ready(function() {
        $('.form-control').on('keypress', function(e) {
            if (e.which == 13) {
                console.log("???");
                e.preventDefault();
                var keyword = $(this).val();
                window.location.href = '{{ route("update") }}/' + keyword;
            }
        });

        $(".gallery-content .item").on('click', function() {
            var galleryId = $(this).data('id');
        });

        $(".gallery-content .item .member-title").on('click', function() {
            var userId = $(this).data('id');
            window.location.href = '{{ route("member", ["id" => "PLACEHOLDER"]) }}'.replace('PLACEHOLDER', userId);
        });

        $(".gallery-content .item .gallery-title").on('click', function() {
            var galleryId = $(this).data('id');
            window.location.href = '{{ route("gallery", ["id" => "PLACEHOLDER"]) }}'.replace('PLACEHOLDER', galleryId);
        });

        $(".gallery-content .item .artwork").on('click', function() {
            var artworkId = $(this).data('id');
            window.location.href = '{{ route("artwork", ["id" => "PLACEHOLDER"]) }}'.replace('PLACEHOLDER', artworkId);
        });
    })
</script>

<style>
    h2 {
        font-family: 'DrukTextWideBold', sans-serif;
    }
    .gallery-content {
        min-height: 500px;
    }
    .action-buttons {
        height: 66px;
    }

    .page-update .explore {
        padding-top: 20px;
    }
</style>
