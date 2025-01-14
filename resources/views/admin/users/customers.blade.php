@extends('admin.partials.master')

@section('title')
    Customers
@endsection
@section('customers')
    active
@endsection
@php
    if(isset($_GET['q'])){
        $q          = $_GET['q'];
    }
@endphp
@section('main-content')
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-sm-xs-12 col-md-12">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <h4>Users</h4>
                            <a href="#" class="btn btn-icon icon-left btn-outline-primary" data-toggle="modal" data-target="#userRegistrationModal">
                                <i class="bx bx-plus"></i>Create New Customer</a>
                        </div>
                        <div class="card-body p-0">
                            <div class="search-box d-flex justify-content-end p-2 mb-1">
                                <div class="card-header-form">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="keyword" name="q" value="{{ @$q }}"
                                                placeholder="{{ __('Search') }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-outline-primary" id="search_btn"><i class="bx bx-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-md">
                                    <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Location</th>
                                        <th>Last Updated</th>
                                        <th>Active</th>
                                        <th class="d-flex justify-content-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody id="result">
                                    @foreach($customers as $customer)
                                        <tr>
                                            <td>{{$customer->full_name}}</td>
                                            <td>{{$customer->email}}</td>
                                            <td>{{$customer->location}}</td>
                                            <td>{{ \Carbon\Carbon::parse($customer->updated_at)->format('d-m-Y H:i:s') }}</td>
                                            <td>
                                                @if($customer->is_active == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td class="d-flex justify-content-center">
                                                <div class="form-group">
                                                    <button class="btn btn-outline-primary edit-customer-btn" data-customer-id="{{ $customer->id }}" data-toggle="tooltip" data-placement="top" title="Edit Customer">
                                                        <i class="bx bx-edit"></i>
                                                    </button>

                                                    <button class="btn btn-danger remove-customer-btn" style="border-radius: 4px" data-customer-id="{{ $customer->id }}" data-toggle="tooltip" data-placement="top" title="Remove Customer">
                                                        <i class="bx bx-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <nav class="d-flex justify-content-center" id="pagination">
                                 {{ $customers->appends(Request::except('page'))->links('pagination::bootstrap-4') }}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Customer Registration Modal -->
    <div class="modal fade" id="userRegistrationModal" tabindex="-1" role="dialog" aria-labelledby="userRegistrationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- Modal content goes here -->
                <div class="modal-header">
                    <h5 class="modal-title" id="userRegistrationModalLabel">Create New Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="userRegistrationForm" action="{{route('admin.customers.create')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="fullName">Full Name</label>
                            <input type="text" class="form-control" id="fullName" name="fullName" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" class="form-control" id="location" name="location">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <!-- Add more fields as needed -->
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Customer Modal -->
    <div class="modal fade" id="editCustomerModal" tabindex="-1" role="dialog" aria-labelledby="editCustomerModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- Modal content goes here -->
                <div class="modal-header">
                    <h5 class="modal-title" id="editCustomerModalLabel">Edit Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editCustomerForm" action="{{ route('admin.customers.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="editCustomerId" value="">
                        <div class="form-group">
                            <label for="fullName">Full Name</label>
                            <input type="text" class="form-control" id="editCustomerFullName" name="fullName" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="editCustomerEmail" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" class="form-control" id="editCustomerLocation" name="location">
                        </div>
                        <!-- Add the is_active field -->
                        <div class="form-group">
                            <label for="is_active">Active Status</label>
                            <select class="form-control" id="editCustomerIsActive" name="is_active" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="editCustomerPassword" name="password">
                        </div>
                        <!-- Add other fields for editing customer data -->
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('admin.customers') }}" method="GET">
        <input type="text" name="keyword1" id="keyword1" placeholder="Search..." hidden>
        <button type="submit" id="search_btn1" hidden>Search</button>
    </form>
@endsection
@include('admin.common.delete-ajax')
@include('admin.common.common-modal')
@push('script')
<script>
    $(document).ready(function () {
        // Handler for clicking the "Edit Customer" button
        $('[data-toggle="tooltip"]').tooltip();

        $('.edit-customer-btn').click(function () {
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
                    console.log(data);
                    // Populate the edit modal form fields with the retrieved data
                    $('#editCustomerId').val(data.id);
                    $('#editCustomerFullName').val(data.full_name);
                    $('#editCustomerEmail').val(data.email);
                    $('#editCustomerLocation').val(data.location);
                    $('#editCustomerIsActive').val(data.is_active);
                    $('#editCustomerModal').modal('show');
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    // Handle error if necessary
                }
            });
        });

        $('.remove-customer-btn').click(function () {
            Swal.fire({
                icon: 'warning',
                title: 'Warning!',
                text: 'Are you sure you want to remove this customer?',
                showConfirmButton: true,
                confirmButtonText: "Remove Customer",
                showCancelButton: true,
            }).then((response)=>{
                if(response.isConfirmed){
                    var customerId = $(this).data('customer-id');

                    // Make an AJAX request to fetch the customer data
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: `{!! route("admin.customers.remove", '') !!}` + '/' + customerId, // Updated URL
                        type: 'DELETE',
                        cache: false,
                        success: function (data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: data.msg,
                                showCancelButton: false,
                                confirmButtonText: 'Continue',
                            }).then((result) => {
                                // If the user clicks the confirm button
                                if (result.isConfirmed) {
                                    // Redirect to another page
                                    window.location.href = "{{ route('admin.customers') }}";
                                }
                            });
                        },
                        error: function (xhr, status, error) {
                            console.error(xhr.responseText);
                            // Handle error if necessary
                        }
                    });
                }
            })
        });

        $('#search_btn').click(function() {
            var keyword = $('#keyword').val();
            $("#keyword1").val(keyword);
            $("#search_btn1").click();
        });
    });
</script>
@endpush
