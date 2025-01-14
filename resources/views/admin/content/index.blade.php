@extends('admin.partials.master')

@section('title')
    Content
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
                            <h4>Content</h4>
                            <a href="{{ route('admin.content.create') }}" class="btn btn-icon icon-left btn-outline-primary">
                                <i class="bx bx-plus"></i>Create Content Page</a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-md">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Page Name</th>
                                        <th>Last Updated</th>
                                        <th>Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody id="result">
                                    @foreach($search as $page)
                                        <tr>
                                            <td>{{$page -> id}}</td>
                                            <td>{{$page -> title}}</td>
                                            <td>{{ \Carbon\Carbon::parse($page->created_at)->format('d-m-Y H:i:s') }}</td>
                                            <td>@if($page->status != 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td class="justify-content-center">
                                                <div class="form-group">
                                                <a href="{{ route('admin.content.show', $page->id) }}" class="btn btn-info">View</a>
                                                <a href="{{ route('admin.content.edit', $page->id) }}" class="btn btn-primary">Edit</a>
                                                <form action="{{ route('admin.content.destroy', $page->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                                    <!-- <button class="btn btn-outline-primary edit-customer-btn" data-customer-id="{{ $page -> id }}"   data-toggle="tooltip" data-placement="top" title="Edit Content"><i class="bx bx-edit"></i></button> -->
                                                    <!-- <button class="btn btn-danger remove-customer-btn" style="border-radius: 4px" data-customer-id="{{ $page -> id }}"   data-toggle="tooltip" data-placement="top" title="Delete Content"><i class="bx bx-trash"></i></button> -->
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

