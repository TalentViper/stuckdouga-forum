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

    <div id="content" class="page-account-detail">
        <div class="content_box">
            <div class="container-fluit p-5 pt-4">
                <div class="row">
                    @include('frontend.partials.sidebar1')
                    <div class="col-md-10 center primary p-4">
                        <h1>PERSONAL DETAILS</h1>
                            <form id="detailForm">
                            @csrf
                                <div class="row pb-2 personal-info">
                                    <div class="col-md-6 p-5">

                                        <div class="row">
                                            <label for="fullname" class="col-sm-3 col-form-label"  required >Full Name:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="fullname" name="fullname" value="{{$user->full_name}}" required >
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <label for="email" class="col-sm-3 col-form-label"  required >Email:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}" required>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <label for="telephone" class="col-sm-3 col-form-label"  required >Telephone:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="telephone" name="telephone" value="{{$user->telephone}}"  required>
                                            </div>
                                        </div>
                                        <div class="row mt-3 mb-5">
                                            <label for="location" class="col-sm-3 col-form-label"  required >Location:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="location" name="location" value="{{$user->location}}"  required>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <label for="gender" class="col-sm-3 col-form-label"  required >Gender:</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="gender" name="gender" value="{{$user->gender}}" required>
                                                    <option value="male" {{$user->gender == "male" ? "selected" : ""}}>male</option>
                                                    <option value="female" {{$user->gender == "female" ? "selected" : ""}}>female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <label for="address" class="col-sm-3 col-form-label"  required >Address:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="address" name="address" value="{{$user->address}}" required>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <label for="postcode" class="col-sm-3 col-form-label"  required >Postcode:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="postcode" name="postcode" value="{{$user->postcode}}" required>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <label for="city" class="col-sm-3 col-form-label"  required >City/Town:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="city" name="city" value="{{$user->city}}"  required>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <label for="country" class="col-sm-3 col-form-label"  required >Country:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="country" name="country" value="{{$user->country}}" required>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-sm-12">
                                                <button type="button" class="update" id="updateDetailsBtn">Update Details</button>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6 p-5">
                                        <div class="row">
                                            <label for="username" class="col-sm-3 col-form-label"  required >Username:</label>
                                            <div class="col-sm-9">
                                                <input type="text" disabled readonly class="form-control" id="username" name="username" value="{{$user->username}}"  required>
                                            </div>
                                        </div>
                                        <div class="row mt-3 position-relative">
                                            <img src="{{ $user->avatar == NULL ? ($user->gender == 'female' ? static_asset('images/img/female_default.jpg') : static_asset('images/img/male_default.jpg')) : static_asset('uploads') . '/' . $user->avatar }}" alt="" width="300" class="avatar-img" style="width: 300px; height: 300px; margin: auto">
                                            <button type="button" class="remove-profile" id="removeThumbnail"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-sm-12">
                                                <button type="button" class="update-profile" id="thumbnail">Update Profile Photo</button>
                                                
                                            </div>
                                            <p style="color:#999">(300 <i class="bi bi-plus-lg"></i> 300px)</p>
                                            <div class="progress mt-2" style="display: none;">
                                                <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control avatar-url" name="avatar" value="{{ $user->avatar }}" hidden>
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <div class="col-md-6 p-5">
                                    <form id="passwordForm">
                                        @csrf
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
                                                <button type="button" class="change" id="changePasswordBtn">Change Password</button>
                                            </div>
                                        </div>
                                        <div class="mb-3 row form-group">
                                            <div class="col-md-12">
                                                <span id="passwordError" style="color: red;"></span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-6 p-5 contact-buttons">
                                    <a href="{{ route('openMessageForm', ['to_admin' => 'admin']) }}"><button type="button">Contact Admin Support</button></a>
                                    <button type="button">Temporary Suspend Account</button>
                                    <button type="button">Request Account Removal</button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

<style>
    .page-account-detail h1 {
        width: 100%;
        border-bottom: 1px solid white;
        /* text-align: left; */
    }

    .page-account-detail h6 {
        text-align: left;
    }

    .page-account-detail input ,.page-account-detail textarea, .page-account-detail select  {
        border-radius: 0px;
    }

    .page-account-detail .change, .page-account-detail .create {
        padding: 5px 40px;
        background: red;
        color: white;
        float: right;
    }

    .page-account-detail .create {
        float: right;
    }

    .page-account-detail h5 {
        text-align: left;
    }

    .col-form-label {
        text-align: left;
    }

    .page-account-detail form {
        padding-bottom: 20px;
        /* border-bottom: 1px solid white; */
    }

    .page-account-detail table td,.page-account-detail table th {
        background: transparent!important;
        color: white;
        vertical-align: middle;
    }

    .page-account-detail table a {
        color: white;
        text-decoration: none;
        margin-right: 10px;
        font-size: 30px
    }

    .page-account-detail .d-flex {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%; /* Ensure the container takes the full height */
    }

    .page-account-detail .update,.page-account-detail .update-profile {
        padding: 5px 40px;
        background: red;
        color: white;
    }

    .page-account-detail .update {
        float: right;
    }

    .personal-info {
        border-bottom: 1px solid white;
    }

    .contact-buttons button {
        width: 300px;
        margin-bottom: 15px;
        background: grey;
        color: white;
        padding: 5px 0px;
    }

    .progress {
        height: 20px;
        background-color: #e9ecef;
        border-radius: 5px;
        overflow: hidden;
        margin-top: 10px;
    }

    .progress-bar {
        height: 100%;
        background-color: #007bff;
        text-align: center;
        line-height: 20px;
        color: white;
    }

    .bi-plus-lg::before {
        transform: rotate(45deg);
    }

    td a:hover {
        opacity: 0.65;
    }

    h1, h2, h3 {
        font-family: 'DrukTextWideBold', sans-serif;
    }

    #removeThumbnail {
        position: absolute;
        width: 36px;
        height: 33px;
        text-align: center;
        color: grey;
        padding: 2px 8px;
        right: -24px;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $("#thumbnail").on('click', function() {
            var input = document.createElement('input');
            input.type = 'file';
            input.onchange = function(event) {
                var file = event.target.files[0];
                var formData = new FormData();
                formData.append('thumbnail', file);

                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('avatar.upload') }}', true);
                xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

                // Handle progress events
                xhr.upload.onprogress = function(event) {
                    if (event.lengthComputable) {
                        var percentComplete = (event.loaded / event.total) * 100;
                        document.querySelector('.progress').style.display = 'block';
                        document.querySelector('.progress-bar').style.width = percentComplete + '%';
                        document.querySelector('.progress-bar').setAttribute('aria-valuenow', percentComplete);
                        document.querySelector('.progress-bar').innerText = Math.round(percentComplete) + '%';
                    }
                };

                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var responseData = JSON.parse(xhr.responseText);
                        $(".avatar-url").val(responseData.path);
                        $(".avatar-img").attr("src", '{{ static_asset('uploads') }}' + '/' + responseData.path);
                        console.log('File uploaded successfully');
                    } else {
                        console.error('File upload failed');
                    }
                };

                xhr.onerror = function() {
                    console.error('Request failed');
                };

                xhr.send(formData);
            };
            input.click();
        });

        $("#removeThumbnail").on('click', function() {
            $.ajax({
                url: "{{route('avatar.remove')}}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                }
            }).then(res => {
                console.log(res)
            })
            $(".avatar-url").val('');
            var defaultImage = '{{ $user->gender == 'male' ? static_asset('images/img/male_default.jpg') : static_asset('images/img/female_default.jpg') }}';
            $(".avatar-img").attr("src", defaultImage);
        });

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
                url: '{{ route('user.updatePassword') }}',
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

        $("#updateDetailsBtn").on('click', function() {
            var formData = new FormData($("#detailForm")[0]);

            $.ajax({
                url: '{{ route('user.updatedetail') }}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                                    title: 'Success',
                                    text: 'User information updated successfully!',
                                    icon: 'success',
                                    confirmButtonColor: 'red',
                                }).then(() => {
                                    window.location.reload();
                                })
                    } else {
                        Swal.fire({
                                    title: 'Error',
                                    text: 'Failed to update user information.',
                                    icon: 'error',
                                    confirmButtonColor: 'grey',
                                })
                    }
                },
                error: function() {
                    Swal.fire({
                                    title: 'Error',
                                    text: 'An error occurred while updating user information.',
                                    icon: 'error',
                                    confirmButtonColor: 'grey',
                                })
                }
            });
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
