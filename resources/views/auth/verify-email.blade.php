@extends('frontend.partials.master')

@section('main-content')

<main id="main" class="main-content">
    <div id="content" class="page-verify">
        <div class="content_box">
            <div class="container-fluit pt-4" style="min-height: 500px">
                <h1>Verify Your Email Address</h1>
                <p>A verification link has been sent to your email address. Please check your inbox to verify your account.</p>

                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="button">Resend Verification Email</button>
                </form>

                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf
                    <button type="submit" class="button">Log Out</button>
                </form>
            </div>
        </div>
    </div>

</main><!-- End #main -->
<style>
    .page-verify .button {
        padding: 5px 40px;
        background: red;
        color: white;
        border: none!important;
    }
</style>

@endsection

