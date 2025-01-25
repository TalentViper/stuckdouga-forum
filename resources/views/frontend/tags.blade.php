@extends('frontend.partials.master')

@section('main-content')
<link rel="stylesheet" href="https://icons.getbootstrap.com/assets/font/bootstrap-icons.min.css">

<main id="main" class="main-content">
    <div id="content">
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
                            <a class="" href="{{ route('populartag') }}">Popular Tags</a>
                            <a class="active"  href="{{ route('tags') }}">All Tags</a>
                        </div>
                        
                    </div>
                    <div class="col-md-10 center primary tag-page">
                        <h2>ALL TAGS</h2>
                        <div class="row p-30">
                            @foreach($search as $tag)
                                <a class="col-md-3 col-sm-6 col-xs-12 gallery-item tag-item pointer">
                                    {{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main><!-- End #main -->
@endsection

<style>
    .action-buttons {
        height: 66px;
    }
</style>
