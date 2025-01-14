@extends('frontend.partials.master')
@section('main-content')
<main id="main" class="main-content">
  <div id="content" class="page-logout">
    <div class="content_box pt-4">
      <div class="container-fluit">
        <div class="row">
          @include('frontend.partials.sidebar')

          <div class="col-md-10 center primary">
            <h2>LOG OUT</h2>
            <img src="{{ static_asset('images/img/logout.png') }}" alt="" class="img-404">
            <h6>You have successfully logged out from your account.</h6>
            <h6>Please continue wtih button below:</h6>
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
    .page-logout .continue-button {
        padding: 5px 40px;
        background: red;
        color: white;
        border: none;
        margin-top: 20px;
        display: inline-block;
        text-decoration: none;
    }

    .page-logout .continue-button:hover {
        background: black;
    }

    .page-logout .img-404 {
        margin-top: 30px;
        opacity: 0.5;
    }

    .page-logout h2 {
        margin-top: 20px;
    }

    .page-logout h1{
        margin-top: 30px;
        font-size: 100px;
        font-weight: 600;
        opacity: 0.5
    }

    h2 {
        font-family: 'DrukTextWideBold', sans-serif;
    }
</style>