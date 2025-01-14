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
              <form class="mt-4" action="{{route('password.email')}}" method="POST">
                @csrf
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 col-form-label">Email:</label>
                  <div class="col-sm-9">
                    <input type="email" class="form-control custom-input" id="inputEmail3" name="email" placeholder="Email">
                  </div>
                </div>
                <div class="form-group text-center mt-5">
                  <button type="submit" class="custom-btn">Request Now</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Login Section -->

  </main><!-- End #main -->
@endsection
