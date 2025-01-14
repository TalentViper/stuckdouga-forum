@extends('frontend.partials.master')

@section('main-content')
<link rel="stylesheet" href="{{ static_asset('frontend/plugin/password_strength.css') }}" />
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="{{ static_asset('frontend/plugin/jquery.hippo-password-strength.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<main id="main" class="main-content">

  <div id="content">
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
            <div class="custom-card center row">
              <h2>REGISTERATION</h2>
              <div class="mt-4 center col-md-2"></div>
              <form action="" method="POST" action="{{route('user.register')}}">
                @csrf
                <div class="row" style="text-align: left !important;">
                  <div class="col-md-3"></div>
                  <div class="col-md-6" >
                    
                    <div class="form-group row mt-3">
                      <label for="full_name" class="col-sm-4 col-md-4 col-form-label" style="">Full Name:</label>
                      <div class="col-sm-8  col-md-8">
                        <input type="text" class="form-control custom-input" id="full_name" name="full_name" placeholder="" value="{{ old('full_name') }}" required>
                      </div>
                      @error('full_name')
                        <span class="bg-danger mt-1 py-1 rounded-1 small text-center text-white">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="form-group row mt-3" style="padding-bottom: 5%;">
                      <label for="user_name" class="col-sm-4 col-form-label">Choose UserName:</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control custom-input" id="user_name" name="user_name" placeholder="" value="{{ old('user_name') }}" required>
                      </div>
                      @error('user_name')
                        <span class="bg-danger mt-1 py-1 rounded-1 small text-center text-white">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="form-group row mt-3">
                      <label for="email" class="col-sm-4 col-form-label">Email:</label>
                      <div class="col-sm-8">
                        <input type="email" class="form-control custom-input" id="email" name="email" placeholder="" value="{{ old('email') }}" required>
                      </div>
                      @error('email')
                        <span class="bg-danger mt-1 py-1 rounded-1 small text-center text-white">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="form-group row mt-3" style="padding-bottom: 5%;">
                      <label for="location" class="col-sm-4 col-form-label">Your Location:</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control custom-input" id="location" name="location" placeholder="" value="{{ old('location') }}">
                      </div>
                      @error('location')
                        <span class="bg-danger mt-1 py-1 rounded-1 small text-center text-white">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-3"></div>
                  <div class="col-md-3"></div>
                  <div class="col-lg-6 mt-3 mt-lg-0">
                    
                    
                    
                    <div class="form-group row mt-3">
                      <label for="password" class="col-sm-4 col-form-label">Password:</label>
                      <div class="col-sm-8">
                        <input type="password" class="form-control custom-input" id="password" name="password" placeholder="" value="{{ old('password') }}" required>
                      </div>
                      @error('password')
                        <span class="bg-danger mt-1 py-1 rounded-1 small text-center text-white">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="form-group row mt-3">
                      <label for="confirm_password" class="col-sm-4 col-form-label">Confirm Password:</label>
                      <div class="col-sm-8">
                        <input type="password" class="form-control custom-input" id="confirm_password" name="confirm_password" placeholder="" value="{{ old('confirm_password') }}" required>
                      </div>
                      @error('confirm_password')
                        <span class="bg-danger mt-1 py-1 rounded-1 small text-center text-white">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-3"></div>

                </div>
                
                <div class="form-group mt-4 d-flex justify-content-center">
                  <button type="submit" class="custom-btn">Register Now</button>
                </div>
              </form>
              
              <div class="mt-4 center col-md-2"></div>
            </div>

          </div>
        </div>




      </div>

    </div>
  </div>

</main><!-- End #main -->
@endsection

<style>
  h2 {
        font-family: 'DrukTextWideBold', sans-serif;
    }
</style>