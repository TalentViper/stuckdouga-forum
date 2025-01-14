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
        <form id="galleryForm" method="POST" action="{{ route('admin.galleries.store') }}" enctype="multipart/form-data">
            <h5 class="mt-3 mb-3">ADD NEW GALLERY</h5>
            @csrf
            <div class="gallery-form">
                <div class="mb-3 row form-group">
                    <label for="title" class="col-sm-2 col-form-label">Title:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="title" name="title" placeholder="" required>
                    </div>
                </div>
                <div class="mb-3 row form-group">
                    <label for="description" class="col-sm-2 col-form-label">Description:</label>
                    <div class="col-sm-7">
                        <textarea class="form-control" id="description" name="description" rows="10"></textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="thumbnail" class="col-sm-2 col-form-label" name="thumbnail" required >Thumbnail:</label>
                    <div class="col-sm-4">
                        <button type="button" class="upload" id="thumbnail">Upload File</button>
                        <div class="progress mt-2" style="display: none;">
                            <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <input type="text" class="form-control gallery-url" name="url" placeholder="" hidden>
                    <label class="col-sm-1"></label>
                    <label for="series" class="col-sm-1 col-form-label" required >Series:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="series" name="series" placeholder=""  required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="type" class="col-sm-2 col-form-label">Type:</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="type">
                            <option value="Classic">Classic</option>
                            <option value="Hidden">Hidden</option>
                            <option value="Locked">Locked</option>
                        </select>
                    </div>
                    <label class="col-sm-1"></label>
                    <label for="tags" class="col-sm-1 col-form-label">Tags:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="tags" name="tags" placeholder="" required>
                    </div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="create">Create Gallery</button>
                </div>
            </div>
        </form>
        </div>
    </section>
            
@endsection
@include('admin.common.delete-ajax')
@include('admin.common.common-modal')
@push('script')
<script>
    $(document).ready(function() {
        $("#thumbnail").on('click', function() {
            var input = document.createElement('input');
            input.type = 'file';
            input.onchange = function(event) {
                var file = event.target.files[0];
                var formData = new FormData();
                formData.append('thumbnail', file);

                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.uploadItems') }}', true);
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
        })

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
                        text: 'Gallery created successfully!',
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
    });
</script>
@endpush
