@extends('frontend.partials.master')
<link rel="stylesheet" href="https://icons.getbootstrap.com/assets/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="{{ static_asset('frontend/plugin/password_strength.css') }}" />
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="{{ static_asset('frontend/plugin/jquery.hippo-password-strength.js') }}"></script>
<script>
  $(function($){
    $('#password').hippoPasswordStrength({
        indicator_prefix: "pass_state0" // default "password_strength"
    });
  });
</script>
@section('main-content')
<main id="main" class="main-content">

    <div id="content" class="page-account-private">
        <div class="content_box">
            <div class="container-fluit p-5 pt-4">
                <div class="row">
                    @include('frontend.partials.sidebar1')
                    <div class="col-md-10 center primary p-4">
                        <h1>PRIVATE AREA</h1>
                        <form class="pt-4">
                            <div class="mb-3 row">
                                <div class="col-md-6">
                                    <div class="mb-3 row form-group">
                                        <label for="password" class="col-sm-5 col-form-label" required >Set Password:</label>
                                        <div class="col-sm-7">
                                            <input type="password" class="form-control" id="password"  data-indicator="strengthLevel" name="password" placeholder="" value="{{ old('password') }}" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row form-group">
                                        <label for="confirmpassword" class="col-sm-5 col-form-label" required >Confirm Password:</label>
                                        <div class="col-sm-7">
                                            <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder=""  required>
                                            <div id="strengthLevel" class="password_strength pass_state01"></div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row form-group">
                                        <div class="col-md-12">
                                            <span id="passwordError" style="color: red;"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex justify-content-center align-items-center" style="height: 108px">
                                    <button type="button" class="change" id="changePasswordBtn">Change Password</button>
                                </div>

                            </div>
                        </form>
                        <form action="{{ route('user.updatePrivateContent') }}"  method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <textarea name="content" id="editor" name="content">{{ $user->private_content}}</textarea>
                                </div>
                            </div>
                            <div class="mb-3 row mt-3">
                                <div class="col-sm-12">
                                    <button type="submit" class="create">Save Updates</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    var textarea = document.getElementById('editor');
    sceditor.create(textarea, {
        format: 'bbcode',
        style: 'https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/content/default.min.css',
        emoticonsEnabled: false
    });
</script>
@endsection

<style>
    .page-account-private h1 {
        width: 100%;
        border-bottom: 1px solid white;
        /* text-align: left; */
    }

    .page-account-private h6 {
        text-align: left;
    }

    .page-account-private input ,.page-account-private textarea, .page-account-private select  {
        border-radius: 0px;
    }

    .page-account-private .upload, .page-account-private .change, .page-account-private .create {
        padding: 5px 40px;
        background: red;
        color: white;
        float: left;
    }

    .page-account-private .create {
        float: right;
    }

    .page-account-private h5 {
        text-align: left;
    }

    .col-form-label {
        text-align: left;
    }

    .page-account-private form {
        padding-bottom: 20px;
        border-bottom: 1px solid white;
    }

    .page-account-private table td,.page-account-private table th {
        background: transparent!important;
        color: white;
        vertical-align: middle;
    }

    .page-account-private table a {
        color: white;
        text-decoration: none;
        margin-right: 10px;
        font-size: 30px
    }

    .page-account-private .d-flex {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%; /* Ensure the container takes the full height */
    }

    .page-account-private .change {
        padding: 5px 40px;
        background: red;
        color: white;
    }

    .sceditor-container {
        width: 100%!important;
        height: 500px!important;
        margin-top: 10px;
    }

    td a:hover {
        opacity: 0.65;
    }

    h1, h2, h3 {
        font-family: 'DrukTextWideBold', sans-serif;
    }
</style>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $("#changePasswordBtn").on('click', function() {
            var password = $("#password").val();
            var confirmPassword = $("#confirmpassword").val();
            var passwordError = $("#passwordError");

            // Check if passwords match
            if (password !== confirmPassword) {
                passwordError.text("Passwords do not match.");
                return;
            }

            // Check password strength
            var strength = checkPasswordStrength(password);
            if (strength !== "Strong") {
                passwordError.text("Password is not strong enough. It should contain at least 8 characters, including uppercase, lowercase, numbers, and special characters.");
                return;
            }

            $.ajax({
                url: '{{ route('user.updatePrivatePassword') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    password: password,
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                                    title: 'Success',
                                    text: 'Password changed successfully!',
                                    icon: 'success',
                                    confirmButtonColor: 'red',
                                })
                    } else {
                        Swal.fire({
                                    title: 'Error',
                                    text: 'Failed to change password.',
                                    icon: 'error',
                                    confirmButtonColor: 'grey',
                                })
                    }
                },
                error: function() {
                    Swal.fire({
                                    title: 'Error',
                                    text: 'An error occurred while changing the password.',
                                    icon: 'error',
                                    confirmButtonColor: 'grey',
                                })
                }
            });

            // If all checks pass, you can proceed with the password change logic
            passwordError.text("");
        });

        function checkPasswordStrength(password) {
            var strength = 0;
            if (password.length >= 8) strength++;
            if (password.match(/[A-Z]/)) strength++;
            if (password.match(/[a-z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[\W_]/)) strength++;

            if (strength >= 4) return "Strong";
            else if (strength >= 3) return "Medium";
            else return "Weak";
        }
    });
</script>



