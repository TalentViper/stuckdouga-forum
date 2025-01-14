@extends('admin.partials.master')

@section('title')
    Employees
@endsection
@section('users')
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
                            <h4>Employees</h4>
                            <a href="{{route('admin.employee.add')}}" class="btn btn-icon icon-left btn-outline-primary">
                                <i class="bx bx-plus"></i>Add Employee</a>
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
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>Postcode</th>
                                            <th>Status</th>
                                            <th class="d-flex justify-content-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="result">
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{$user->first_name.' '.$user->last_name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->phone}}</td>
                                            <td>{{$user->address}}</td>
                                            <td>{{$user->city}}</td>
                                            <td>{{$user->postcode}}</td>
                                            <td>
                                                @if($user->status == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>


                                            <td class="d-flex justify-content-center">
                                                <div class="form-group">
                                                    <select class="form-control user-action" data-user-id="{{$user->id}}" data-user-status="{{$user->status}}">
                                                        <option value="0">Action</option>
                                                        <option value="1">Edit Employee</option>
                                                        <option value="2">{{ $user->status == 1 ? 'Make Inactive' : 'Make Active' }}</option>
                                                        <option value="3">Delete Employee</option>
                                                        <!-- <option value="3">Remove Invoice</option> -->
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="card-footer">
                        <div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="datatable_info" role="status" aria-live="polite"></div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="datatable_previous"><a href="#" aria-controls="datatable" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="datatable" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="datatable" data-dt-idx="2" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item "><a href="#" aria-controls="datatable" data-dt-idx="3" tabindex="0" class="page-link">3</a></li><li class="paginate_button page-item "><a href="#" aria-controls="datatable" data-dt-idx="4" tabindex="0" class="page-link">4</a></li><li class="paginate_button page-item "><a href="#" aria-controls="datatable" data-dt-idx="5" tabindex="0" class="page-link">5</a></li><li class="paginate_button page-item "><a href="#" aria-controls="datatable" data-dt-idx="6" tabindex="0" class="page-link">6</a></li><li class="paginate_button page-item next" id="datatable_next"><a href="#" aria-controls="datatable" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li></ul></div></div></div>
                            <nav class="d-flex justify-content-center" id="pagination">
                                 <!-- {{ $users->appends(Request::except('page'))->links('pagination::bootstrap-4') }} -->
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@include('admin.common.delete-ajax')
@include('admin.common.common-modal')
@push('script')
<script>
    $(document).ready(function () {
        // Listen for changes in the dropdown with the class 'user-action'
        $('.user-action').change(function () {
            // Get the selected value
            var selectedAction = $(this).val();
            // Get the user ID from the 'data-user-id' attribute
            var userId = $(this).data('user-id');
            var status = $(this).data('user-status');

            // Perform actions based on the selected value
            switch (selectedAction) {
                case '1':
                    // Edit User action
                    window.location = "{!! route('admin.employee.show', ['id' => ':id']) !!}".replace(':id', userId);
                    console.log('edit-user');
                    break;
                case '2':
                    // Make Inactive action
                    // Implement your logic here
                    console.log('make inactive');
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        url: "{!! route('admin.employee.active') !!}",
                        data: {id: userId, status: status},
                        cache: false,
                        success: function (data)
                        {
                            console.log(data);
                            if (data)
                            {
                                window.location="{!! route('admin.employees') !!}";
                            }
                            else
                            {
                                alert("Please Try Again Latter..");
                            }
                        }
                    });
                    break;
                case '3':
                    // Remove Invoice action
                    // Implement your logic here
                    console.log('delete employee');
                    if (confirm('Are you sure you want to delete this employee?')) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: "POST",
                            url: "{!! route('admin.employee.delete') !!}",
                            data: {id: userId},
                            cache: false,
                            success: function (data)
                            {
                                if (data)
                                {
                                    window.location="{!! route('admin.employees') !!}";
                                }
                                else
                                {
                                    alert("Please Try Again Latter..");
                                }
                            }
                        });
                    }
                    break;
                default:
                    // Do nothing for 'Action' or other cases
            }
        });

        $('#search_btn').click(function() {
            var keyword = $('#keyword').val();

            $.ajax({
                url: "{{ route('admin.employees') }}",
                type: 'GET',
                data: {
                    keyword: keyword
                },
                success: function(response) {
                    $('#result').html(response.view);
                    $('#pagination').html(response.pagination);
                }
            });
        });
    });
</script>
@endpush
