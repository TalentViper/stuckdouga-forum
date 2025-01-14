@extends('admin.partials.master')

@section('title')
    Support
@endsection
@section('support')
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
                            <h4>Support</h4>
                            <a href="#" class="btn btn-icon icon-left btn-outline-primary">
                                <i class="bx bx-plus"></i>Compose Message</a>
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
                                        <th>Ticket ID</th>
                                        <th>Title</th>
                                        <th>Customer</th>
                                        <th>Started Date</th>
                                        <th>Status</th>
                                        <th class="d-flex justify-content-center">Actions</th>
                                    </tr>
                                    @for ($i = 0; $i < 10; $i++)
                                        <tr>
                                            <td>#4564</td>
                                            <td>I received hirer price than quoted...</td>
                                            <td>John Malcovich</td>
                                            <td>10.6.23 | 5:21pm</td>
                                            <td>Customer Waiting</td>
                                            <td class="d-flex justify-content-center">
                                                <div class="form-group">
                                                    <select class="form-control" name="s">
                                                        <option value="0">Action</option>
                                                        <option value="1">View Ticket</option>
                                                        <option value="2">Close Ticket</option>
                                                        <option value="3">Block Ticket</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                    @endfor
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
