@extends('frontend.partials.master')

@section('main-content')
<main id="main" class="main-content">
  <div id="content" class="page-sign">
    <div class="content_box">

      <div class="center intro-txt">
        Welcome to Stuckdouga,<br>
        a social network for,<br>
        collectors of animation art.
      </div>

      <div class="container-fluit">
        <div class="row">
          @include('frontend.partials.sidebar')

          <div class="col-md-10 center primary">
            <h2>SIGN IN</h2>
            <form class="mt-4" action="{{route('user.login')}}" method="POST">
              @csrf
              <div class="contact-form">
                <div class="mb-3 row form-group">
                  <label for="inputName" class="col-sm-4 col-form-label">Email:</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="eamil" id="inputEmail3" name="email"
                      placeholder="Email">
                  </div>
                </div>
                <div class="mb-3 row form-group">
                  <label for="inputPassword" class="col-sm-4 col-form-label">Password:</label>
                  <div class="col-sm-8">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                  </div>
                </div>
                <div class="forgot">
                  <i class="bi bi-play-fill"></i>
                  <a href="#">Forgotten password?</a>
                </div>
                <div class="clear"></div>
                <div class="form-check">
                  <input class="" type="checkbox" value="" id="flexCheckChecked">
                  <label class="form-check-label" for="flexCheckChecked">
                    Keep me logged in
                  </label>
                  <div class="clear"></div>
                  <div class="form-group mt-2">
                    <button type="submit" class="sign-button">Sign In</button>
                  </div>
                  <div class="clear"></div>
                </div>
              </div>
            </form>
            <div class="clear"></div>
            <div class="sign-another">
              <div class="row fxg-buttons">
                <div class="col">
                  <p>Or Sign in with:</p>
                  <a href="#">
                    <img src="{{ static_asset('images/img/f_button.jpg') }}" alt="">
                  </a>
                  <a href="#">
                    <img src="{{ static_asset('images/img/x_button.jpg') }}" alt="">
                  </a>
                  <a href="#">
                    <img src="{{ static_asset('images/img/g_button.jpg') }}" alt="">
                  </a>
                </div>
                <div class="col register-col">
                  <p>Are you new here?<br><br>Create new account now:</p>
                  <button type="button" class="register-button" onclick="window.location.href='{{ route('register') }}'">Register</button>
                </div>
              </div>
            </div>
            <div class="banner">
              <img src="{{ static_asset('images/img/banner2.jpg') }}" alt="">
              <img src="{{ static_asset('images/img/banner3.jpg') }}" alt="">
              <img src="{{ static_asset('images/img/banner4.jpg') }}" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main><!-- End #main -->
<script src="https://accounts.google.com/gsi/client" async defer></script>
@endsection
<style>
  h2 {
        font-family: 'DrukTextWideBold', sans-serif;
    }
</style>