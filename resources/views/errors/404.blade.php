@extends('frontend.partials.master')
@section('main-content')
<main id="main" class="main-content">
  <div id="content" class="page-404">
    <div class="content_box pt-4">
      <div class="container-fluit">
        <div class="row">
          @include('frontend.partials.sidebar')

          <div class="col-md-10 center primary">
            <h2>PAGE NOT FOUND</h2>
            <img src="{{ static_asset('images/img/404.png') }}" alt="" class="img-404">
            <h1>404</h1>
            <h6>This URL is incorrect. Please continue to main page.</h6>
            <a class="continue-button" href="{{route('home')}}">Continue</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</main><!-- End #main -->
<script src="https://accounts.google.com/gsi/client" async defer></script>
@endsection

<style>
    .page-404 .continue-button {
        padding: 5px 40px;
        background: red;
        color: white;
        border: none;
        margin-top: 20px;
        display: inline-block;
        text-decoration: none;
    }

    .page-404 .continue-button:hover {
        background: black;
    }
    .page-404 .img-404 {
        margin-top: 30px;
        opacity: 0.5;
    }

    .page-404 h2 {
        margin-top: 20px;
    }

    .page-404 h1{
        margin-top: 30px;
        font-size: 100px;
        font-weight: 600;
        opacity: 0.5
    }
</style>