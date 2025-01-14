@extends('frontend.partials.master')
@section('main-content')
<main id="main">
<!-- ======= Logout Section ======= -->
    <section id="created" class="created" style="margin-top:105px;">
        <div class="container" data-aos="fade-up">
            <div class="">
                <h2>Account Created:</h2>
            </div>
            <div class="row content">
                <div class="col-lg-12 d-flex justify-content-center p-3 pt-lg-0">
                    <img src="{{ static_asset('images/elite/check.png') }}" alt="">
                </div>
                <div class="col-lg-12 d-flex justify-content-center p-3 pt-lg-0">
                    <h4 style="color:#249316; font-weight:normal">Congratulation</h4>
                </div>
                <div class="col-lg-12 d-flex justify-content-center p-3 pt-lg-0">
                    <p>Your account has been successfully created.</p>
                </div>
                
            </div>

        </div>
    </section><!-- End About Us Section -->
</main>
@endsection

