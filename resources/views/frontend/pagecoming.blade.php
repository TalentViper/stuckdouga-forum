@extends('frontend.partials.master')
@section('main-content')
<main id="main" class="main-content">
  <div id="content" class="page-coming">
    <div class="content_box pt-4">
      <div class="container-fluit">
        <div class="row">
          @include('frontend.partials.sidebar')

          <div class="col-md-10 center primary">
            <h2>COMING SOON</h2>
            <img src="{{ static_asset('images/img/coming-soon.png') }}" alt="" class="img-404">
            <h1>COMING SOON...</h1>
            <h6>This page is currently under construction.</h6>
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
    .page-coming .continue-button {
        padding: 5px 40px;
        background: red;
        color: white;
        border: none;
        margin-top: 20px;
        display: inline-block;
        text-decoration: none;
    }

    .page-coming .continue-button:hover {
        background: black;
    }

    .page-coming .img-404 {
        margin-top: 30px;
        opacity: 0.5;
    }

    .page-coming h2 {
        margin-top: 20px;
    }

    .page-coming h1{
        margin-top: 30px;
        font-size: 60px;
        font-weight: 600;
        opacity: 0.5
    }

    h2 {
        font-family: 'DrukTextWideBold', sans-serif;
    }
</style>