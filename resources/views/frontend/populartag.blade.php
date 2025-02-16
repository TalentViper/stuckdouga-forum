@extends('frontend.partials.master')

@section('main-content')
<link rel="stylesheet" href="https://icons.getbootstrap.com/assets/font/bootstrap-icons.min.css">

<main id="main" class="main-content">

    <div id="content" class="page-latest">
        <div class="content_box">
            <div class="container-fluit pt-4 p-5">
                <div class="row">
                    <div class="col-md-2 sider">
                        <div class="side_title">
                            <h5>Show Galleries</h5>
                        </div>
                        <div class="tag-page-gallery mb30">
                            <a class="mt-10" href="{{ route('latest') }}">Latest Galleries</a>
                            <a class="" href="{{ route('update') }}">Updated Galleries</a>
                            <a class="" href="{{ route('popular') }}">Popular Galleries</a>
                            <a class="active" href="{{ route('populartag') }}">Popular Tags</a>
                            <a class=""  href="{{ route('tags') }}">All Tags</a>
                        </div>
                        <div class="side_title">
                            <h5>Browse by Name</h5>
                        </div>
                        <div class="tag-page-browsername mt10">
                            <a href="{{ route('populartag', 'A') }}">A</a>
                            <a href="{{ route('populartag', 'B') }}">B</a>
                            <a href="{{ route('populartag', 'C') }}">C</a>
                            <a href="{{ route('populartag', 'D') }}">D</a>
                            <a href="{{ route('populartag', 'E') }}">E</a>
                            <a href="{{ route('populartag', 'F') }}">F</a>
                        </div>
                        <div class="tag-page-browsername">
                            <a href="{{ route('populartag', 'G') }}">G</a>
                            <a href="{{ route('populartag', 'H') }}">H</a>
                            <a href="{{ route('populartag', 'I') }}">I</a>
                            <a href="{{ route('populartag', 'J') }}">J</a>
                            <a href="{{ route('populartag', 'K') }}">K</a>
                            <a href="{{ route('populartag', 'L') }}">L</a>
                        </div>
                        <div class="tag-page-browsername">
                            <a href="{{ route('populartag', 'M') }}">M</a>
                            <a href="{{ route('populartag', 'N') }}">N</a>
                            <a href="{{ route('populartag', 'O') }}">O</a>
                            <a href="{{ route('populartag', 'P') }}">P</a>
                            <a href="{{ route('populartag', 'Q') }}">Q</a>
                            <a href="{{ route('populartag', 'R') }}">R</a>
                        </div>
                        <div class="tag-page-browsername">
                            <a href="{{ route('populartag', 'S') }}">S</a>
                            <a href="{{ route('populartag', 'T') }}">T</a>
                            <a href="{{ route('populartag', 'U') }}">U</a>
                            <a href="{{ route('populartag', 'V') }}">V</a>
                            <a href="{{ route('populartag', 'W') }}">W</a>
                            <a href="{{ route('populartag', 'X') }}">X</a>
                        </div>
                        <div class="tag-page-browsername">
                            <a href="{{ route('populartag', 'Y') }}">Y</a>
                            <a href="{{ route('populartag', 'Z') }}">Z</a>
                            <a href="{{ route('populartag', '#') }}">#</a>
                            <a href="{{ route('populartag', '?') }}">?</a>
                        </div> 
                    </div>
                    <div class="col-md-10 center primary">
                        <h2>POPULAR TAGS</h2>
                        <div class="row action-buttons">
                            <div class="view-buttons col-md-4">
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="addon-wrapping">
                                        <i class="bi bi-search"></i>
                                    </span>
                                    <input type="text" class="form-control" id="search-input" placeholder="Search galleries"
                                        aria-label="Search galleries" aria-describedby="addon-wrapping">
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                            <ul class="pagination col-md-6 justify-content-end" role="menubar" aria-label="Pagination">
                                {{ $search->appends(Request::except('page'))->links('pagination::bootstrap-4') }}
                            </ul>
                        </div>
                        <div class="gallery-content grid">
                            @foreach($search as $tag)
                                <div class="gallery-item">
                                    <img src="{{ static_asset('uploads') . '/' . $tag->img }}" alt="{{ $tag->name }}">
                                    <div class="name">{{ $tag->name }}</div>
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

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    $(document).ready(function() {
        $(".form-control").on('keypress', function(e) {
            if (e.which == 13) {
                var keyword = $(this).val();
                e.preventDefault();
                window.location.href = "{{ route('populartag') }}/" + encodeURIComponent(keyword);
            }
        });

        $(".gallery-content .gallery-item").on('click', function() {
            console.log('clicked')
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

    .action-buttons {
        height: 66px;
    }
</style>
