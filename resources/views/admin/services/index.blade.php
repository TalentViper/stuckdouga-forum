@extends('admin.partials.master')

@section('title')
    Services
@endsection
@section('services')
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
                            <h4>Services</h4>
                            <a href="#" class="btn btn-icon icon-left btn-outline-primary">
                                <i class="bx bx-plus"></i>Add Service</a>
                        </div>
                        <div class="card-body p-0">
                            <div class="search-box d-flex justify-content-between p-2 mb-1">
                                <div class="form-group">
                                    <select class="form-control page-count" name="s">
                                        <option value="10">10</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                                <div class="card-header-form">
                                    <form class="form-inline" id="sorting">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="q" value="{{ @$q }}"
                                                   placeholder="{{ __('Search') }}">
                                            <div class="input-group-btn">
                                                <button class="btn btn-outline-primary"><i class="bx bx-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-md">
                                    <tbody>
                                        <tr>
                                            <th>Service ID</th>
                                            <th>Service Name</th>
                                            <th>Price per hour</th>
                                            <th>Total Bookings</th>
                                            <th class="d-flex justify-content-center">Actions</th>
                                        </tr>
                                        @foreach($services as $service)
                                        <tr>
                                            <td>#{{$service->id}}</td>
                                            <td>{{$service->name}}</td>
                                            <td>&pound; {{$service->price}}</td>
                                            <td>6564</td>
                                            <td class="d-flex justify-content-center">
                                                <div class="form-group">
                                                    <select class="form-control" name="s">
                                                        <option value="0">Action</option>
                                                        <option value="1">Edit Service</option>
                                                        <option value="2">Service Bookings</option>
                                                        <option value="3">Service Jobs</option>
                                                        <option value="4">Statistics</option>
                                                        <option value="5">Remove Service</option>
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
                            {{--<nav class="d-flex justify-content-center">
                                 {{ $users->appends(Request::except('page'))->links('pagination::bootstrap-4') }}
                            </nav>--}}
                            <nav aria-label="Page navigation example" class="d-flex justify-content-center">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </li>
                                </ul>
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
