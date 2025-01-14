@extends('admin.partials.master')

@section('title')
    Rubbishes
@endsection
@section('rubbishes')
    active
@endsection
@php
    if(isset($_GET['q'])){
        $q          = $_GET['q'];
    }
@endphp
@section('main-content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
<style>
    .circle-btn {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        border: 1px solid #0d6efd;
        align-items: center;
        cursor: pointer;
        background: white;
    }
    .btn-primary{
        background-color: #0d6efd !important;
        border: 1px solid #0d6efd !important;
    }
    .custom-btn-width {
        max-width: 250px; /* Adjust the width as needed */
        width: 100%;
    }

    .cancel-btn-width {
        max-width: 150px; /* Adjust the width as needed */
        width: 100%;
    }

    .rating {
        font-size: 30px; /* Adjust the size of the stars */
    }

    .rating .fa-star {
        color: lightgrey; /* Set the color of unfilled stars */
    }

    .rating .checked {
        color: #FFD700; /* Set the color of filled stars */
    }
    #timeDropdown option:disabled {
        color: #999; /* Change this to your desired color */
    }
</style>
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-sm-xs-12 col-md-12">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <h4>Booking / Job : #EGB{{str_pad($rubbish->id, 4, '0', STR_PAD_LEFT)}} </h4>
                            <p>Created on: {{ $rubbish->created_at->format('d/m/Y | H:i') }}</p>
                        </div>
                        <div class="card-body p-2">
                            <div class="row justify-content-between pl-3 pr-3 mb-1">
                                <div class="form-group col-md-4">
                                    <label for="customer_name">Customer Name</label>
                                    <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{ $rubbish->user->first_name . ' ' . $rubbish->user->last_name }}" disabled>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="customer_email">Customer E-mail</label>
                                    <input type="email" class="form-control" id="customer_email" name="customer_email" value="{{ $rubbish->user->email }}" disabled>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="customer_phone">Customer Telephone</label>
                                    <input type="text" class="form-control" id="customer_phone" name="customer_phone" value="{{ $rubbish->user->phone }}" disabled>
                                </div>
                            </div>
                            <div class="row pl-3 pr-3">
                                <div class="form-group col-md-12">
                                    <button class="btn btn-secondary" id="edit_customer_btn" data-customer-id="{{ $rubbish->user->id }}">View Account</button>
                                </div>
                            </div>
                            <div class="row justify-content-between pl-3 pr-3 mb-1">
                                <div class="form-group col-md-12">
                                    <label for="address">Job Address</label>
                                    <p>{{ $rubbish->address }}</p>
                                </div>
                            </div>
                            <div class="row justify-content-between pl-3 pr-3 mb-1">
                                <!-- Job Date -->
                                <div class="form-group col-md-2">
                                    <label for="job_date">Job Date</label>
                                    <p>{{ date('Y-m-d', strtotime(str_replace(" of", "", $rubbish->start_date))) }}</p>
                                </div>

                                <!-- Job Time -->
                                <div class="form-group col-md-2">
                                    <label for="timeDropdown">Job Starting Time</label>
                                    <p>
                                        <?php echo date('H:i', strtotime($rubbish->start_time)); ?>
                                    </p>
                                </div>

                                <!-- Job Status -->
                                <div class="form-group col-md-2">
                                    <label for="job_status">Job Status</label>
                                    <select class="form-control" name="job_status" id="job_status" disabled>
                                        <option value="pending" {{ $rubbish->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="cancelled" {{ $rubbish->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        <option value="completed" {{ $rubbish->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                    </select>
                                </div>
                                <!-- View/Edit Account Button -->
                                <div class="form-group col-md-4 pt-4 text-md-right">
                                    <button class="btn btn-primary">Show Job On Map</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Edit Customer Modal -->
    <div class="modal fade" id="viewCustomerModal" tabindex="-1" role="dialog" aria-labelledby="viewCustomerModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- Modal content goes here -->
                <div class="modal-header">
                    <h5 class="modal-title" id="viewCustomerModalLabel">View Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <p id="viewCustomerTitle"></p>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="firstName">First Name</label>
                            <p id="viewCustomerFirstName"></p>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="lastName">Last Name</label>
                            <p id="viewCustomerLastName"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <p id="viewCustomerEmail"></p>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <p id="viewCustomerPhone"></p>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <p id="viewCustomerAddress"></p>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="city">City</label>
                            <p id="viewCustomerCity"></p>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="postcode">Postcode</label>
                            <p id="viewCustomerPostcode"></p>
                        </div>
                    </div>
                    <!-- Add the is_active field -->
                    <div class="form-group">
                        <label for="is_active">Active Status</label>
                        <p id="viewCustomerIsActive"></p>
                    </div>
                    <!-- Add other fields for viewing customer data -->
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


@endsection
@include('admin.common.delete-ajax')
@include('admin.common.common-modal')
@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

<script>
    $(document).ready(function(){
        $('#edit_customer_btn').click(function () {
            var customerId = $(this).data('customer-id');

            // Make an AJAX request to fetch the customer data
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `{!! route("admin.customers.show", '') !!}` + '/' + customerId, // Updated URL
                type: 'GET',
                cache: false,
                success: function (data) {
                    // Populate the edit modal form fields with the retrieved data
                    $('#viewCustomerId').text(data.id);
                    $('#viewCustomerTitle').text(data.title);
                    $('#viewCustomerFirstName').text(data.first_name);
                    $('#viewCustomerLastName').text(data.last_name);
                    $('#viewCustomerEmail').text(data.email);
                    $('#viewCustomerPhone').text(data.phone);
                    $('#viewCustomerAddress').text(data.address);
                    $('#viewCustomerCity').text(data.city);
                    $('#viewCustomerPostcode').text(data.postcode);
                    $('#viewCustomerIsActive').text(data.is_active);
                    // Show the edit modal
                    $('#viewCustomerModal').modal('show');
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    // Handle error if necessary
                }
            });
        });
    });
</script>
@endpush
