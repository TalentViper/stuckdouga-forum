@extends('admin.partials.master')

@section('title')
    Message
@endsection
@section('bookings')
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
                            <h4>Message</h4>
                            <a href="" class="btn btn-icon icon-left btn-outline-primary">
                                <i class="bx bx-plus"></i>Create New Message</a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-md">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Subject</th>
                                        <th>Date/Time</th>
                                        <!-- <th>Status</th> -->
                                        <th class="text-center" width="180px">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody id="result">
                                    @foreach($search as $message)
                                        <tr>
                                            <td>{{$message -> sender->full_name}}</td>
                                            <td>{{$message -> content}}</td>
                                            <td>{{ \Carbon\Carbon::parse($message->created_at)->format('d-m-Y H:i:s') }}</td>
                                            <!-- <td>@if($message->status != 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td> -->
                                            <td class="d-flex justify-content-center">
                                            <div class="form-group">
                                                    <button class="btn btn-outline-primary edit-customer-btn" data-customer-id="{{ $message->id }}" data-toggle="tooltip" data-placement="top" title="View Message">
                                                        <i class="bx bx-edit"></i>
                                                    </button>

                                                    <!-- Remove Customer Button with Tooltip -->
                                                    <button class="btn btn-danger remove-customer-btn" style="border-radius: 4px" data-customer-id="{{ $message->id }}" data-toggle="tooltip" data-placement="top" title="Delete Message">
                                                        <i class="bx bx-trash"></i>
                                                    </button>
                                                    <button class="btn btn-info remove-customer-btn" style="border-radius: 4px" data-customer-id="{{ $message->id }}" data-toggle="tooltip" data-placement="top" title="Reply Message">
                                                        <i class="bx bx-reply"></i>
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
                        <div class="row justify-content-center">
                            <nav class="d-flex" id="pagination">
                                {{ $search->appends(Request::except('page'))->links('pagination::bootstrap-4') }}
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
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();        
    });
    
</script>
@endpush
