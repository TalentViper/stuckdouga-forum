@extends('admin.partials.master')

@section('title')
    Website
@endsection
@section('website')
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
                            <h4>Website</h4>
                            <!-- <a href="#" class="btn btn-icon icon-left btn-outline-primary">
                                <i class="bx bx-plus"></i>Add Page</a> -->
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
                                            <th>Page Name</th>
                                            <th>Slug</th>
                                            <th>Url</th>
                                            <th>Status</th>
                                            <th class="d-flex justify-content-center">Actions</th>
                                        </tr>
                                        @foreach($pages as $page)
                                        <tr>
                                            <td>{{$page->title}}</td>
                                            <td>{{$page->slug}}</td>
                                            <td>{{$page->url}}</td>
                                            <td>
                                                @if($page->is_active == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>

                                            <td class="d-flex justify-content-center">
                                                <div class="form-group">
                                                    <a class="btn btn-outline-primary" href="{{route('admin.website.show', $page->id)}}">Edit</a>
                                                    <!-- <button class="btn btn-outline-primary edit-page-btn" data-page-id="{{ $page->id }}">Edit</button> -->
                                                </div>
                                                <!-- <div class="form-group">
                                                    <select class="form-control" name="s">
                                                        <option value="0">Action</option>
                                                        <option value="1">Edit Page</option>
                                                        <option value="2">Make Inactive</option>
                                                        <option value="3">Remove Page</option>
                                                    </select>
                                                </div> -->
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

    <!-- The modal -->
    <div class="modal fade" id="editPageModal" tabindex="-1" role="dialog" aria-labelledby="editPageModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPageModalLabel">Edit Page</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Add form fields for editing page content -->
                    <form id="editPageForm" action="{{ route('admin.website.update') }}" method="POST">
                    @csrf
                        <input type="hidden" name="id" id="editPageId" value="">
                        <div class="form-group">
                            <label for="editTitle">Title</label>
                            <input type="text" class="form-control" id="editTitle" name="title">
                        </div>
                        <div class="form-group">
                            <label for="editSlug">Slug</label>
                            <input type="text" class="form-control" id="editSlug" name="slug" disabled>
                        </div>
                        <div class="form-group">
                            <label for="editContent">Content</label>
                            <textarea class="form-control" id="editContent" name="content" rows="20"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="editUrl">URL</label>
                            <input type="text" class="form-control" id="editUrl" name="url" disabled>
                        </div>
                        <div class="form-group">
                            <label for="is_active">Active Status</label>
                            <select class="form-control" id="editIsActive" name="is_active" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" id="saveChangesBtn">Save Changes</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
@include('admin.common.delete-ajax')
@include('admin.common.common-modal')
@push('script')
    <script>
        $(document).ready(function () {
            // Handler for clicking the "Edit Customer" button
            $('.edit-page-btn').click(function () {
                var pageId = $(this).data('page-id');

                // Make an AJAX request to fetch the customer data
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: `{!! route("admin.website.show", '') !!}` + '/' + pageId, // Updated URL
                    type: 'GET',
                    cache: false,
                    success: function (data) {
                        // console.log(data);
                        // Populate the edit modal form fields with the retrieved data
                        $('#editPageId').val(data.id);
                        $('#editTitle').val(data.title);
                        $('#editSlug').val(data.slug);
                        $('#editContent').val(data.content);
                        $('#editUrl').val(data.url);
                        $('#editIsActive').val(data.is_active);

                        // Show the edit modal
                        $('#editPageModal').modal('show');
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
