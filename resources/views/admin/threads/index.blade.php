@extends('admin.partials.master')

@section('title')
    Forum
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
                            <h4>Forum</h4>
                            <a href="{{ route('admin.threads.create') }}" class="btn btn-icon icon-left btn-outline-primary">
                                <i class="bx bx-plus"></i>Create New Article</a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-md">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Topic</th>
                                        <th>Creator</th>
                                        <th>Last Updated</th>
                                        <th>Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody id="result">
                                    @foreach($threads as $thread)
                                        <tr>
                                            <td>{{$thread -> id}}</td>
                                            <td>{{$thread -> title}}</td>
                                            <td>{{$thread -> user->full_name}}</td>
                                            <td>{{ \Carbon\Carbon::parse($thread->created_at)->format('d-m-Y H:i:s') }}</td>
                                            <td>@if($thread->article_status != 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td class="d-flex justify-content-center">
                                            <div class="form-group">
                                                    <button class="btn btn-info view-thread-btn" data-thread-id="{{ $thread -> id }}"  data-toggle="tooltip" data-placement="top" title="View thread"><i class="bx bxs-show"></i></button>
                                                    <button class="btn btn-outline-primary edit-thread-btn" data-thread-id="{{ $thread -> id }}"  data-toggle="tooltip" data-placement="top" title="Edit thread"><i class="bx bx-edit"></i></button>
                                                    <button class="btn btn-warning edit-customer-btn" data-thread-id="{{ $thread -> id }}"  data-toggle="tooltip" data-placement="top" title="View Statistic"><i class="bx bxs-chart"></i></button>
                                                    <button class="btn btn-danger delete-thread-btn" style="border-radius: 4px" data-thread-id="{{ $thread -> id }}"  data-toggle="tooltip" data-placement="top" title="Delete thread"><i class="bx bx-trash"></i></button>
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

        // Delete Button
        $('.delete-thread-btn').on('click', function() {
            var threadId = $(this).data('thread-id');
            var baseRouteUrl = "{{ route('admin.threads.destroy', ['thread' => 'PLACEHOLDER']) }}";
            var fullRouteUrl = baseRouteUrl.replace('PLACEHOLDER', threadId);
            if (confirm('Are you sure you want to delete this thread?')) {
                $.ajax({
                    url: fullRouteUrl,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert('Thread deleted successfully');
                        location.reload();
                    },
                    error: function(xhr) {
                        alert('Error deleting thread');
                    }
                });
            }
        });

        // Edit Button
        $('.edit-thread-btn').on('click', function() {
            var threadId = $(this).data('thread-id');
            var editUrl = '{{ route('admin.threads.edit', ':id') }}';
            editUrl = editUrl.replace(':id', threadId);
            window.location.href = editUrl;
        });

        // View Button
        $('.view-thread-btn').on('click', function() {
            var threadId = $(this).data('thread-id');
            // window.location.href = '/admin/threads/' + threadId;
        });
    });
</script>
@endpush
