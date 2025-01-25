@extends('frontend.partials.master')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="{{ static_asset('frontend/plugin/jquery.hippo-password-strength.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@section('main-content')

<main id="main" class="main-content">

    <div id="content" class="contact-page">
        <div class="content_box">
            <div class="container-fluit pt-4">
                <div class="row ">
                    @include('frontend.partials.sidebar')

                    <div class="col-md-10 center primary">
                        <h2>CONTACT US</h2>
                        <div class="contact-form">
                            <form action="{{ route('contact.send') }}" id="contact-form-mail" method="POST" style="width: 100%;">
                                <div class="mb-3 row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Name:</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" class="form-control" id="inputName" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email:</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" class="form-control" id="inputEmail" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputLocation" class="col-sm-2 col-form-label">Location:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputLocation" name="location">
                                    </div>
                                </div>
                                <div class="mb-3 row pb30">
                                    <label for="inputSubject" class="col-sm-2 col-form-label">Subject:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputSubject" name="subject">
                                    </div>
                                </div>
                                <div class="row text-row">
                                    <label for="inputMessage" class="form-label col-sm-2">Message:</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="inputMessage" rows="10" required name="message"></textarea>
                                    </div>
                                </div>
                                    <!-- <form action="?" method="POST"> -->
                                        <div class="g-recaptcha" style="float: right; margin-top: 10px; margin-bottom: 10px;" data-sitekey="6LfSSHsqAAAAAEtMgEsVpK5iKyATQVohI3WKX0cb"></div>
                                    <!-- </form> -->
                                    <br />
                                <div class="clear"></div>
                                <button type="submit">Send Message</button>
                                <div class="clear"></div>
                            </form>
                        </div>
                        <div class="banner">
                            <img src="{{ static_asset('images/img/contact-2.jpg') }}" alt="">
                            <img src="{{ static_asset('images/img/contact-1.jpg') }}" alt="">
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

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $('#contact-form-mail').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        $('#contact-form-mail')[0].reset();
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Message sent successfully!',
                            confirmButtonText: 'OK',
                            confirmButtonColor: 'red'
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'something went wrong!',
                            confirmButtonText: 'OK',
                            confirmButtonColor: 'red'
                        })
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'something went wrong!',
                        confirmButtonText: 'OK',
                        confirmButtonColor: 'red'
                    })
                }
            });
        });
    })
</script>