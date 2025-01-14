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
                            <a class="" href="{{ route('popular') }}">Popular Galleries</a>
                            <a class="active" href="{{ route('populartag') }}">Popular Tags</a>
                            <a class=""  href="{{ route('tags') }}">All Tags</a>
                        </div>
                        <div class="side_title">
                            <h5>Browse by Name</h5>
                        </div>
                        <div class="tag-page-browsername mt10">
                            <a href="#">A</a>
                            <a href="#">B</a>
                            <a href="#">C</a>
                            <a href="#">D</a>
                            <a href="#">E</a>
                            <a href="#">F</a>
                        </div>
                        <div class="tag-page-browsername">
                            <a href="#">G</a>
                            <a href="#">H</a>
                            <a href="#">I</a>
                            <a href="#">J</a>
                            <a href="#">K</a>
                            <a href="#">L</a>
                        </div>
                        <div class="tag-page-browsername">
                            <a href="#">M</a>
                            <a href="#">N</a>
                            <a href="#">O</a>
                            <a href="#">P</a>
                            <a href="#">Q</a>
                            <a href="#">R</a>
                        </div>
                        <div class="tag-page-browsername">
                            <a href="#">S</a>
                            <a href="#">T</a>
                            <a href="#">U</a>
                            <a href="#">V</a>
                            <a href="#">W</a>
                            <a href="#">X</a>
                        </div>
                        <div class="tag-page-browsername">
                            <a href="#">Y</a>
                            <a href="#">Z</a>
                            <a href="#">#</a>
                            <a href="#">?</a>
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
        $('#search-input').on('input', function() {
            var keyword = $(this).val();
            var url = "{{ route('populartag') }}?keyword=" + encodeURIComponent(keyword);
            window.location.href = url;
        });

        $(".gallery-content .gallery-item").on('click', function() {
            
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
