@extends('admin.partials.master')

@section('title')
    Gallery
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
                            <h4>Gallery</h4>
                            <a href="{{ route('admin.galleries.create') }}" class="btn btn-icon icon-left btn-outline-primary">
                                <i class="bx bx-plus"></i>Create New Gallery</a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-md">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Gallery</th>
                                        <th>Last Updated</th>
                                        <th>ArtWorks</th>
                                        <th>Popularity</th>
                                        <th>Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody id="result">
                                    @foreach($search as $gallery)
                                        <tr>
                                            <td>{{$gallery -> gallery_name}}</td>
                                            <td><img class="side_links"
                                                src="{{ static_asset('uploads') .'/' . $gallery->gallery_url }}" alt="sidebar links" width="100px"/></td>
                                            <td>{{ \Carbon\Carbon::parse($gallery->created_at)->format('d-m-Y H:i:s') }}</td>
                                            <td>{{$gallery -> artwork_count}}</td>
                                            <td>{{$gallery -> likes}}</td>
                                            <td>@if($gallery->status != 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td class="justify-content-center">
                                                <div class="form-group">
                                                    <button class="btn btn-outline-primary edit-customer-btn" data-gallery-id="{{ $gallery->id }}" data-toggle="tooltip" data-placement="top" title="Edit Gallery">
                                                        <i class="bx bx-edit"></i>
                                                    </button>

                                                    <!-- Remove Customer Button with Tooltip -->
                                                    <button class="btn btn-danger remove-customer-btn" style="border-radius: 4px" data-gallery-id="{{ $gallery->id }}" data-toggle="tooltip" data-placement="top" title="Remove Gallery">
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

        $('.remove-customer-btn').click(function() {
            var galleryId = $(this).data('gallery-id');
            var row = $(this).closest('tr');
            var baseRouteUrl = "{{ route('admin.galleries.destroy', ['gallery' => 'PLACEHOLDER']) }}";
            var fullRouteUrl = baseRouteUrl.replace('PLACEHOLDER', galleryId);
            if (confirm('Are you sure you want to delete this gallery?')) {
                $.ajax({
                    url: fullRouteUrl, // Update this URL to match your route
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.success) {
                            row.remove();
                            alert('Gallery deleted successfully!');
                            location.reload();
                        } else {
                            alert('Failed to delete gallery.');
                        }
                    },
                    error: function(xhr) {
                        alert('An error occurred: ' + xhr.responseText);
                    }
                });
            }
        });

        $('.edit-customer-btn').on('click', function() {
            var galleryId = $(this).data('gallery-id');
            var editUrl = '{{ route('admin.galleries.edit', ':id') }}';
            editUrl = editUrl.replace(':id', galleryId);
            window.location.href = editUrl;
        });
    });
    
</script>
@endpush
