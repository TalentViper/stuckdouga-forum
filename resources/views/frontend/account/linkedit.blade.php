@extends('frontend.partials.master')
<link rel="stylesheet" href="https://icons.getbootstrap.com/assets/font/bootstrap-icons.min.css">
@section('main-content')
<main id="main" class="main-content">

    <div id="content" class="page-account-link">
        <div class="content_box">
            <div class="container-fluit p-5 pt-4">
                <div class="row">
                    @include('frontend.partials.sidebar1')
                    <div class="col-md-10 center primary p-4">
                        <h2>LINKS <a href="{{ redirect()->back()->getTargetUrl() }}" class="toggle-button flex-end">Go back</a></h2>  
                        <div id="uploadSection" >
                            <form action="{{ route('link.update') }}" method="POST">
                                <h5 class="mt-5 mb-5">UPDATE LINK</h5>
                                @csrf
                                <div class="gallery-form">
                                    <input type="hidden" name="id" value="{{ $link->id }}">
                                    <div class="mb-3 row form-group">
                                        <label for="name" class="col-sm-2 col-form-label" required>Link Name:</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="" required value="{{ $link->name }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row form-group">
                                        <label for="url" class="col-sm-2 col-form-label" required>URL:</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="url" name="url" placeholder="https://example.com" required value="{{ $link->url }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row form-group">
                                        <label for="desc" class="col-sm-2 col-form-label" required>Description:</label>
                                        <div class="col-sm-7">
                                            <textarea class="form-control" id="desc" name="desc" rows="10">{{ $link->desc }}</textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-9">
                                            <button type="submit" class="create">Update Link</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

<style>
    .page-account-link h2 {
        width: 100%;
        border-bottom: 1px solid white;
        text-align: left;
    }

    .page-account-link input ,.page-account-link textarea, .page-account-link select  {
        border-radius: 0px;
    }

    .page-account-link .upload, .page-account-link .create {
        padding: 5px 40px;
        background: red;
        color: white;
        float: left;
    }

    .page-account-link .create {
        float: right;
    }

    .page-account-link h5 {
        text-align: left;
    }

    .col-form-label {
        text-align: left;
    }

    .page-account-link form {
        padding-bottom: 20px;
        border-bottom: 1px solid white;
    }

    .page-account-link table td,.page-account-link table th {
        background: transparent!important;
        color: white;
        vertical-align: middle;
    }

    .page-account-link table a {
        color: white;
        text-decoration: none;
        margin-right: 10px;
        font-size: 30px
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
        font-size: 13px;
        text-decoration: none;
        float: right;
        margin-top: -10px;
    }
</style>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Edit button click event
        $(".edit-button").on('click', function(e) {
            e.preventDefault();
            var newsId = $(this).closest('tr').data('id');
            var newsContent = $(this).closest('tr').find('td').eq(1).text();

            // Populate the form with the news content
            $("#editor").val(newsContent);
            $("#newsForm").attr('action', '{{ route('newsupdates.update', ':id') }}'.replace(':id', newsId));
            $("#newsForm").append('<input type="hidden" name="_method" value="PUT">');
        });

        $("#toggleButton").on('click', function() {
            $("#uploadSection").toggle();
            $(this).text($(this).text() == '+' ? '-' : '+');
        });

        $("#toggleButton").trigger('click');

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
                        url: '{{ route('links.destroy', ':id') }}'.replace(':id', itemId),
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: 'Link item has been deleted.',
                                    icon: 'success',
                                    confirmButtonColor: 'red',
                                })
                                // Remove the row from the table
                                $("tr[data-id='" + itemId + "']").remove();
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: 'Failed to delete news item.',
                                    icon: 'error',
                                    confirmButtonColor: 'grey',
                                })
                            }
                        },
                        error: function() {
                            Swal.fire({
                                    title: 'Error',
                                    text: 'An error occurred while deleting the news item.',
                                    icon: 'error',
                                    confirmButtonColor: 'grey',
                                })
                        }
                    });
                }
            });
        });
    });
</script>



