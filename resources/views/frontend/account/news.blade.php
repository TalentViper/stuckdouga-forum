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

    <div id="content" class="page-account-news">
        <div class="content_box">
            <div class="container-fluit p-5 pt-4">
                <div class="row">
                    @include('frontend.partials.sidebar1')
                    <div class="col-md-10 center primary p-4">
                        <h2>NEWS & UPDATES  <button id="toggleButton" class="toggle-button flex-end">+</button></h2>
                        <div id="uploadSection" style="display: none;">
                            <form class="pt-4">
                                @csrf
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
                            <form id="newsForm" action="{{ route('newsupdates.store') }}"  method="POST">
                                @csrf
                                <h5 class="mt-5 mb-5">ADD NEW ITEM TO NEWS:</h5>
                                <h6>Today's date {{ \Carbon\Carbon::now()->format('d/m/Y') }}</h6>
                                <div class="row">
                                    <label for="description" class="col-sm-2 col-form-label" required >News Content:</label>
                                    <div class="col-sm-10">
                                        <textarea name="content" id="editor"></textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row mt-3">
                                    <div class="col-sm-12">
                                        <button type="submit" class="create">Add News</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="my-contents">
                            <h5 class="mt-5 mb-5">NEWS HISTORY:</h5>
                            <table class="table table-striped table-md">
                                <thead>
                                    <tr>
                                        <th width="20%">Date:</th>
                                        <th wdith="60%">Content:</th>
                                        <th width="20%">Actions:</th>
                                    </tr>
                                </thead>
                                <tbody id="result">
                                    @if($news->isEmpty())
                                        <p>No News found.</p>
                                    @else
                                            @foreach($news as $new)
                                                <tr data-id="{{ $new->id }}">
                                                <td>{{ \Carbon\Carbon::parse($new->created_at)->format('d-m-Y') }}</td>
                                                <td>@stripBBCode($new->content)</td>
                                                <td>
                                                    <a href="{{ route('news.update', $new->id) }}" class="edit-button">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <a href="#" class="remove-button"  data-id="{{ $new->id }}">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                </td>
                                                </tr>
                                            @endforeach
                                    @endif
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
    .page-account-news h2 {
        width: 100%;
        border-bottom: 1px solid white;
        text-align: left;
    }

    .page-account-news h6 {
        text-align: left;
    }

    .page-account-news input ,.page-account-news textarea, .page-account-news select  {
        border-radius: 0px;
    }

    .page-account-news .upload, .page-account-news .change, .page-account-news .create {
        padding: 5px 40px;
        background: red;
        color: white;
        float: left;
    }

    .page-account-news .create {
        float: right;
    }

    .page-account-news h5 {
        text-align: left;
    }

    .col-form-label {
        text-align: left;
    }

    .page-account-news form {
        padding-bottom: 20px;
        border-bottom: 1px solid white;
    }

    .page-account-news table td,.page-account-news table th {
        background: transparent!important;
        color: white;
        vertical-align: middle;
    }

    .page-account-news table a {
        color: white;
        text-decoration: none;
        margin-right: 10px;
        font-size: 30px
    }

    .page-account-news .d-flex {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%; /* Ensure the container takes the full height */
    }

    .page-account-news .change {
        padding: 5px 40px;
        background: red;
        color: white;
    }

    .sceditor-container {
        width: 100%!important;
        height: 250px!important;
        margin-top: 10px;
    }

    td a:hover {
        opacity: 0.65;
    }

    h1, h2, h3 {
        font-family: 'DrukTextWideBold', sans-serif;
    }

    .toggle-button {
        background: red;
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        font-size: 20px;
        float: right;
        margin-top: -10px;
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
                url: '{{ route('user.updateNewsPassword') }}',
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

        $("#toggleButton").on('click', function() {
            $("#uploadSection").toggle();
            $(this).text($(this).text() == '+' ? '-' : '+');
        });

        $("#toggleButton").trigger('click');

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

        // Edit button click event
        // $(".edit-button").on('click', function(e) {
        //     e.preventDefault();
        //     var newsId = $(this).closest('tr').data('id');
        //     var newsContent = $(this).closest('tr').find('td').eq(1).text();

        //     // Populate the form with the news content
        //     $("#editor").val(newsContent);
        //     $("#newsForm").attr('action', '{{ route('newsupdates.update', ':id') }}'.replace(':id', newsId));
        //     $("#newsForm").append('<input type="hidden" name="_method" value="PUT">');
        // });

        // Remove button click event
        $(".remove-button").on('click', function(e) {
            e.preventDefault();
            var itemId = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'red',
                cancelButtonColor: 'grey',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('newsupdates.destroy', ':id') }}'.replace(':id', itemId),
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: 'News item has been deleted.',
                                    icon: 'success',
                                    confirmButtonColor: 'red',
                                })
                                // Remove the row from the table
                                $("tr[data-id='" + itemId + "']").remove();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Failed to delete news item.',
                                    cancelButtonColor: 'grey',
                                    confirmButtonColor: 'grey',
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'An error occurred while deleting the news item.',
                                    cancelButtonColor: 'grey',
                                    confirmButtonColor: 'grey',
                                });
                        }
                    });
                }
            });
        });
    });
</script>
