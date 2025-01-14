@extends('admin.partials.master')

@section('title')
    Tags
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
                            <h4>Tags</h4>
                            <a href="" class="btn btn-icon icon-left btn-outline-primary">
                                <i class="bx bx-plus"></i>Create New Tag</a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-md">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tag Name</th>
                                        <th>Last Updated</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody id="result">
                                    @foreach($search as $tag)
                                        <tr>
                                            <td>{{$tag -> id}}</td>
                                            <td>{{$tag -> name}}</td>
                                            <td>{{ \Carbon\Carbon::parse($tag->created_at)->format('d-m-Y H:i:s') }}</td>
                                            <td>
                                                <div class="form-group">
                                                    <button class="btn btn-outline-primary edit-customer-btn" data-customer-id="{{ $tag -> id }}"  data-toggle="tooltip" data-placement="top" title="Edit Tag"><i class="bx bx-edit"></i></button>
                                                    <button class="btn btn-danger remove-customer-btn" style="border-radius: 4px" data-customer-id="{{ $tag -> id }}"  data-toggle="tooltip" data-placement="top" title="Delete Tag"><i class="bx bx-trash"></i></button>
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
                            <nav class="d-flex " id="pagination">
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
