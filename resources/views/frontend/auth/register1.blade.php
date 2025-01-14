@extends('frontend.partials.master')

@section('main-content')
<link rel="stylesheet" href="{{ static_asset('frontend/plugin/password_strength.css') }}" />
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="{{ static_asset('frontend/plugin/jquery.hippo-password-strength.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
  $(function($){
    $('#password').hippoPasswordStrength({
        indicator_prefix: "pass_state0" // default "password_strength"
    });
  });
</script>
<main id="main" class="main-content">

  <div id="content" class="page-register">
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
            <h2 class="pb30">Registration</h2>
            <form action="" method="POST" action="{{route('user.register')}}">
              @csrf
              <div class="contact-form">
                <div class="info">
                  <div class="mb-3 row form-group">
                    <label for="full_name" class="col-sm-4 col-form-label" name="full_name" placeholder="" value="{{ old('full_name') }}" required >Full Name:</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="full_name" name="full_name" placeholder="" value="{{ old('full_name') }}" required>
                    </div>
                    @error('full_name')
                        <span class="bg-danger mt-1 py-1 rounded-1 small text-center text-white">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="mb-3 row form-group pb30">
                    <label for="user_name" class="col-sm-4 col-form-label">Choose Username:</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="user_name" name="user_name" placeholder="" value="{{ old('user_name') }}" required>
                    </div>
                    @error('user_name')
                        <span class="bg-danger mt-1 py-1 rounded-1 small text-center text-white">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="mb-3 row form-group">
                    <label for="email" class="col-sm-4 col-form-label">Email:</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control"  id="email" name="email" placeholder="" value="{{ old('email') }}" required>
                    </div>
                    @error('email')
                        <span class="bg-danger mt-1 py-1 rounded-1 small text-center text-white">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="mb-3 row form-group pb30">
                    <label for="location" class="col-sm-4 col-form-label">Your Location:</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="location" name="location" placeholder="" value="{{ old('location') }}" required>
                    </div>
                    @error('location')
                        <span class="bg-danger mt-1 py-1 rounded-1 small text-center text-white">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="mb-3 row form-group">
                    <label for="password" class="col-sm-4 col-form-label">Password :</label>
                    <div class="col-sm-8">
                      <input type="password" class="form-control" id="password"  data-indicator="strengthLevel" name="password" placeholder="" value="{{ old('password') }}" required>
                    </div>
                    @error('password')
                        <span class="bg-danger mt-1 py-1 rounded-1 small text-center text-white">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="mb-3 row form-group">
                    <label for="confirm_password" class="col-sm-4 col-form-label">Confirm Password :</label>
                    <div class="col-sm-8">
                      <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="" value="{{ old('confirm_password') }}" required>
                    </div>
                    @error('confirm_password')
                        <span class="bg-danger mt-1 py-1 rounded-1 small text-center text-white">{{ $message }}</span>
                    @enderror
                  </div>
                  <div id="strengthLevel" class="password_strength pass_state01"></div>
                </div>
                <div class="cap-form">
                  <form action="?" method="POST">
                    <div class="g-recaptcha" data-sitekey="6LfSSHsqAAAAAEtMgEsVpK5iKyATQVohI3WKX0cb"></div>
                    <br />
                  </form>
                </div>
                <div class="clear"></div>
                <div class="form-check">
                  <input class="" type="checkbox" value="" id="flexCheckChecked">
                  <label class="form-check-label" for="flexCheckChecked">
                    I have read and agree to the Stuckdouga terms & privacy policy.
                  </label>
                </div>
                <div class="form-group">
                  <button type="submit" class="custom-btn">Register Now</button>
                </div>
                <div class="pb30">
                  This site is intended for viewers over 18 years of age
                </div>
                <div class="clear"></div>
              </div>
            </form>
            <div class="banner">
              <img src="{{ static_asset('images//img/banner1.jpg') }}" alt="">
              <img src="{{ static_asset('images//img/banner1.jpg') }}" alt="">
            </div>
          </div>
        </div>




      </div>

    </div>
  </div>

</main><!-- End #main -->
@endsection