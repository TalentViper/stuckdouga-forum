@extends('admin.partials.master')

@section('title')
    Edit Gallery
@endsection
@section('bookings')
    active
@endsection
@php
    if(isset($_GET['q'])){
        $q = $_GET['q'];
    }
@endphp
@section('main-content')
    <section class="section">
        <div class="section-body">
            <form id="galleryForm" method="POST" action="{{ route('admin.galleries.update', $gallery->id) }}" enctype="multipart/form-data">
                <h5 class="mt-3 mb-3">EDIT GALLERY</h5>
                @csrf
                @method('PUT')
                <div class="gallery-form">
                    <div class="mb-3 row form-group">
                        <label for="title" class="col-sm-2 col-form-label">Title:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="title" name="title" value="{{ $gallery->gallery_name }}" required>
                        </div>
                    </div>
                    <div class="mb-3 row form-group">
                        <label for="description" class="col-sm-2 col-form-label">Description:</label>
                        <div class="col-sm-7">
                            <textarea class="form-control" id="description" name="description" rows="10">{{ $gallery->description }}</textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="thumbnail" class="col-sm-2 col-form-label" name="thumbnail" required>Thumbnail:</label>
                        <div class="col-sm-4">
                            <button type="button" class="upload" id="thumbnail">Upload File</button>
                            <div class="progress mt-2" style="display: none;">
                                <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <input type="text" class="form-control gallery-url" name="url" value="{{ $gallery->gallery_url }}" hidden>
                        <label class="col-sm-1"></label>
                        <label for="series" class="col-sm-1 col-form-label" required>Series:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="series" name="series" value="{{ $gallery->series }}" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="type" class="col-sm-2 col-form-label">Type:</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="type">
                                <option value="Classic" {{ $gallery->type == 'Classic' ? 'selected' : '' }}>Classic</option>
                                <option value="Hidden" {{ $gallery->type == 'Hidden' ? 'selected' : '' }}>Hidden</option>
                                <option value="Locked" {{ $gallery->type == 'Locked' ? 'selected' : '' }}>Locked</option>
                            </select>
                        </div>
                        <label class="col-sm-1"></label>
                        <label for="tags" class="col-sm-1 col-form-label">Tags:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="tags" name="tags" value="{{ $gallery->tags }}" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="create">Update Gallery</button>
                    </div>
                </div>
            </form>

            <div class="my-contents">
                <h5 class="mt-3 mb-3">ARTWORKS IN THIS GALLERY:</h5>
                <table class="table table-striped table-md">
                    <thead>
                        <tr>
                            <th>Title:</th>
                            <th>Type</th>
                            <th>Thumbnail</th>
                            <th>Added/Updated:</th>
                            <th width="20%">Actions:</th>
                        </tr>
                    </thead>
                    <tbody id="result">
                        @if($items->isEmpty())
                            <p>No Items found.</p>
                        @else
                                @foreach($items as $item)
                                    <tr>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->type }}</td>
                                        <td>
                                            <img src="{{ static_asset('uploads') . '/' . $item->img_main }}" width="100px"/>
                                        </td>
                                        <td> {{ $item->updated_at }}</td>
                                        <td>
                                            <div class="row">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="visibleSwitch{{ $item->id }}" {{ $item->visible ? 'checked' : '' }}>
                                                </div>
                                                <button class="btn btn-outline-primary edit-artwork-btn" data-artwork-id="{{ $item->id }}" data-toggle="tooltip" data-placement="top" title="Edit Artwork">
                                                    <i class="bx bx-edit"></i>
                                                </button>

                                                <!-- Remove Customer Button with Tooltip -->
                                                <button class="btn btn-danger remove-artwork-btn" style="margin-left: 5px;border-radius: 4px" data-artwork-id="{{ $item->id }}" data-toggle="tooltip" data-placement="top" title="Remove Artwrok">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <!-- Add more fields as needed -->
                                    </tr>
                                @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
@include('admin.common.delete-ajax')
@include('admin.common.common-modal')
@push('script')
<script>
    $(document).ready(function() {
        $(".form-control .gallery-url").val('123123123');
        $("#thumbnail").on('click', function() {
            var input = document.createElement('input');
            input.type = 'file';
            input.onchange = function(event) {
                var file = event.target.files[0];
                var formData = new FormData();
                formData.append('thumbnail', file);

                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('uploadItems') }}', true);
                xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

                // Handle progress events
                xhr.upload.onprogress = function(event) {
                    if (event.lengthComputable) {
                        var percentComplete = (event.loaded / event.total) * 100;
                        document.querySelector('.progress').style.display = 'block';
                        document.querySelector('.progress-bar').style.width = percentComplete + '%';
                        document.querySelector('.progress-bar').setAttribute('aria-valuenow', percentComplete);
                        document.querySelector('.progress-bar').innerText = Math.round(percentComplete) + '%';
                    }
                };

                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var responseData = JSON.parse(xhr.responseText);
                        $(".gallery-url").val(responseData.path);
                        console.log($(".gallery-url"));
                        console.log('File uploaded successfully');
                    } else {
                        console.error('File upload failed');
                    }
                };

                xhr.onerror = function() {
                    console.error('Request failed');
                };

                xhr.send(formData);
            };
            input.click();
        });

        $("#galleryForm").on('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Gallery updated successfully!',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '{{ route('admin.gallery') }}';
                        }
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });

        $('.remove-artwork-btn').click(function() {
            var artworkId = $(this).data('artwork-id');
            var row = $(this).closest('tr');
            var baseRouteUrl = "{{ route('admin.artworks.destroy', ['artwork' => 'PLACEHOLDER']) }}";
            var fullRouteUrl = baseRouteUrl.replace('PLACEHOLDER', artworkId);
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
                            alert('Artwork deleted successfully!');
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

        $('.edit-artwork-btn').on('click', function() {
            var artworkId = $(this).data('artwork-id');
            var editUrl = '{{ route('admin.artworks.edit', ':id') }}';
            editUrl = editUrl.replace(':id', artworkId);
            window.location.href = editUrl;
        });
    });
</script>
@endpush
