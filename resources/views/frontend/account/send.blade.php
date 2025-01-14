
@extends('frontend.partials.master')
<link rel="stylesheet" href="https://icons.getbootstrap.com/assets/font/bootstrap-icons.min.css">
@section('main-content')
<main id="main" class="main-content">

    <div id="content" class="page-account-message-send">
        <div class="content_box">
            <div class="container-fluit p-5 pt-4">
                <div class="row">
                    @include('frontend.partials.sidebar1')
                    <div class="col-md-10 center primary">
                        <h1 class="">SEND MESSAGES</h1>
                        <form action="{{ route('messages.send') }}" method="POST">
                            @csrf
                            <div class="form-group mt-3 row">
                                <label for="receiver_id" class="col-md-4">Receiver ID:</label>
                                <input type="text" id="receiver_id" name="receiver_id" class="col-md-8" required>
                            </div>
                            <div class="form-group mt-3 row">
                                <label for="message_content" class="col-md-4" >Message:</label>
                                <textarea id="message_content" name="content" class="col-md-8"  required></textarea>
                            </div>
                            <button type="submit mt-3" class="send">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

<style>
    .page-account-message-send .send {
        padding: 5px 40px;
        background: red;
        color: white;
        margin-top: 16px;
    }

    .page-account-message-send form {
        width: 500px;
        margin: 0 auto;
    }

    .page-account-message-send textarea {
        height: 300px;
    }
</style>