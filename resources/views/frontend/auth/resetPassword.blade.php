@extends('frontend.partials.master')

@section('main-content')
<main id="main" class="main-content">

    <!-- ======= Forgot Password Section ======= -->
    <section class="login">
      <div class="container" data-aos="fade-up">
        <div class="row">
          <div class="col-lg-12 d-flex align-items-stretch">
            <div class="custom-card">
              <h2>Forgot Password:</h2>
              <form class="mt-4" action="{{route('password.update')}}" method="POST">
                @csrf
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 col-form-label">Email:</label>
                  <div class="col-sm-9">
                    <input type="email" class="form-control custom-input" id="inputEmail3" name="email" value="{{$_GET['email']}}" readonly>
                  </div>
                </div>
                <div class="form-group row mt-3">
                  <label for="password" class="col-sm-4 col-form-label">Password:</label>
                  <div class="col-sm-8">
                    <input type="password" class="form-control custom-input" id="password" name="password" placeholder="" required>
                  </div>
                </div>
                <div class="form-group row mt-3">
                  <label for="password_confirmation" class="col-sm-4 col-form-label">Confirm Pw:</label>
                  <div class="col-sm-8">
                    <input type="password" class="form-control custom-input" id="password_confirmation" name="password_confirmation"
                      placeholder="" required>
                  </div>
                </div>
                <div class="form-group text-center mt-5">
                    <input type="hidden" name="token" value="{{$token}}">
                  <button type="submit" class="custom-btn">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Login Section -->

  </main><!-- End #main -->
@endsection
