@extends('frontend.partials.master')
<link rel="stylesheet" href="https://icons.getbootstrap.com/assets/font/bootstrap-icons.min.css">
@section('main-content')
<main id="main" class="main-content">

    <div id="content" class="page-account-message">
        <div class="content_box">
            <div class="container-fluit p-5 pt-4">
                <div class="row">
                    @include('frontend.partials.sidebar1')
                    <div class="col-md-10 center primary">
                        <h1 class="">MESSAGES</h1>
                        <div class="row action-buttons">
                            <div class="view-buttons col-md-4 mt-1">
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="addon-wrapping">
                                        <i class="bi bi-search"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Search galleries"
                                        aria-label="Search galleries" aria-describedby="addon-wrapping">
                                </div>
                            </div>
                            <ul class="pagination col-md-5 justify-content-end" role="menubar" aria-label="Pagination">
                                {{ $messages->appends(Request::except('page'))->links('pagination::bootstrap-4') }}
                            </ul>
                            <div class="col-md-3 text-end mt-2">
                                Total Messages: {{ $totalMessagesCount }}
                            </div>
                        </div>
                        <div class="row tool-buttons">
                            <div class="col-md-6" style="display: flex; padding-left:0px!important">
                                <div class="form-check mr-3">
                                    <input class="form-check-input" type="checkbox" id="selectAllCheckbox">
                                    <label class="form-check-label" for="selectAllCheckbox">Select All</label>
                                </div>
                                <a href="#" class="ml-1" id="deleteSelected" style="margin-left: 30px!important">
                                    <i class="bi bi-trash"></i>
                                </a>
                                <a href="#" class="ml-1" style="margin-left: 30px!important">
                                    <i class="bi bi-arrow-repeat"></i>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="send-message" id="sendMessageButton">Send Message</button>
                            </div>
                        </div>
                        <div class="message-box">
                            <table class="table">
                                <tbody>
                                    @foreach($messages as $message)
                                        <tr data-id="{{ $message->id }}" style="width: 100%;">
                                            <td style="width: 5%;">
                                                <input class="form-check-input message-checkbox m-2" type="checkbox">
                                            </td>
                                            <td style="width: 10%;">
                                                <img src="{{ static_asset('uploads') . '/' . $message->sender->avatar }}" alt="" width="50px">
                                            </td>
                                            <td style="width: 15%;">{{ $message->sender->full_name }}</td>
                                            <td style="width: 50%; text-align: center;">{{ $message->content }}</td>
                                            <td><div>{{ \Carbon\Carbon::parse($message->updated_at)->format('d-m-Y H:i:s') }}</div></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row action-buttons justify-content-center">
                            <ul class="pagination" role="menubar" aria-label="Pagination">
                                {{ $messages->appends(Request::except('page'))->links('pagination::bootstrap-4') }}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

<style>
    .page-account-message h2 {
        width: 100%;
        border-bottom: 1px solid white;
        text-align: left;
        padding-left: 16px;
        margin-bottom: 0px!important;
    }

    .page-account-message h6 {
        text-align: left;
    }

    .page-account-message input ,.page-account-message textarea, .page-account-message select  {
        border-radius: 0px;
    }

    .page-account-message .change, .page-account-message .create {
        padding: 5px 40px;
        background: red;
        color: white;
        float: right;
    }

    .page-account-message .create {
        float: right;
    }

    .page-account-message h5 {
        text-align: left;
    }

    .col-form-label {
        text-align: left;
    }

    .page-account-message form {
        padding-bottom: 20px;
        border-bottom: 1px solid white;
    }

    .page-account-message table td,.page-account-message table th {
        background: transparent!important;
        color: white;
        vertical-align: middle;
    }

    .page-account-message table a {
        color: white;
        text-decoration: none;
        margin-right: 10px;
        font-size: 30px
    }

    .page-account-message .update,.page-account-message .update-profile {
        padding: 5px 40px;
        background: red;
        color: white;
    }

    .page-account-message .view-buttons span {
        border-top-left-radius: 20px;
        border-bottom-left-radius: 20px;
    }

    .page-account-message .view-buttons input {
        border-top-right-radius: 20px;
        border-bottom-right-radius: 20px;
    }

    .action-buttons
    {
        margin-left: 0px!important;
        margin-right: 0px!important;
        padding: 5px 3px;
        /* justify-content: space-between; */
        background-color: #595f61;
    }

    .send-message {
        padding: 5px 40px;
        background: red;
        color: white;
        float: right;
    }

    .tool-buttons a {
        color: white;
        text-decoration: none;
        font-size: 30px;
    }

    .tool-buttons {
        background: #393c3c;
        margin: 0px!important;
        padding: 16px;
    }

    .tool-buttons .form-check {
        margin-top: 5px;
    }

    .tool-buttons a {
        margin-left: 10px;
    }

    .tool-buttons a:hover {
        opacity: 0.65;
    }

    .page-account-message table td,.page-account-message table th {
        background: transparent!important;
        color: white;
        vertical-align: middle;
    }

    .page-account-message tr:nth-of-type(even) {
       background-color: #454849;
    }

    .page-account-message tr:nth-of-type(odd) {
        background-color: #4c5152;
    }

    .page-account-message tr:hover {
        background: #444!important;
        cursor: pointer;
    }

     a:hover {
        opacity: 0.65;
    }

    h1, h2, h3 {
        font-family: 'DrukTextWideBold', sans-serif;
    }
</style>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAllCheckbox = document.getElementById('selectAllCheckbox');
        const messageCheckboxes = document.querySelectorAll('.message-checkbox');
        const deleteSelected = document.getElementById('deleteSelected');
        const sendMessageButton = document.getElementById('sendMessageButton');

        selectAllCheckbox.addEventListener('change', function() {
            messageCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });

        messageCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const allChecked = Array.from(messageCheckboxes).every(checkbox => checkbox.checked);
                selectAllCheckbox.checked = allChecked;
            });
        });

        deleteSelected.addEventListener('click', function(event) {
            event.preventDefault();

            const selectedMessages = Array.from(messageCheckboxes).filter(checkbox => checkbox.checked);
            const messageIds = selectedMessages.map(checkbox => checkbox.closest('tr').getAttribute('data-id'));

            if (messageIds.length > 0) {
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
                            url: '{{ route('deleteMessages') }}', // Replace with your actual endpoint
                            method: 'POST',
                            data: {
                                messageIds: messageIds
                            },
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token for security
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: 'Your messages have been deleted.',
                                    icon: 'success',
                                    confirmButtonColor: 'red',
                                }).then(() => {
                                    location.reload();
                                });
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Something went wrong!',
                                    cancelButtonColor: 'grey',
                                    confirmButtonColor: 'grey',
                                });
                            }
                        });
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'No messages selected!',
                    cancelButtonColor: 'grey',
                    confirmButtonColor: 'grey',
                });
            }
        });

        sendMessageButton.addEventListener('click', function() {
            window.location.href = '{{ route('openMessageForm') }}';
        });
    });
</script>
