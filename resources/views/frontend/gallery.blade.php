@extends('frontend.partials.master')

@section('main-content')

<link rel="stylesheet" href="https://icons.getbootstrap.com/assets/font/bootstrap-icons.min.css">
<main id="main" class="main-content">
    <div id="content" class="page-gallery-view">
        <div class="content_box">
            <div class="container-fluit pt-4 p-4">
                <div class="row">
                    <div class="col-md-2 sider">
                        <div class="side_title">
                            <h5>{{ $gallery->user->full_name }}</h5>
                        </div>
                        <div class="tag-page-gallery mb30">
                            <img src="{{ $gallery->user->avatar ? static_asset('uploads/' . $gallery->user->avatar) : ( $gallery->user->gender == 'female' ? static_asset('images/img/female_default.jpg') : static_asset('images/img/male_default.jpg') ) }}" alt="" width="200">
                            <!-- <img src="{{ static_asset('images/img/art_thumb1.jpg') }}" alt=""> -->
                            <a class="mt-10" href="{{ route('user.profile', ['id' => $gallery->user->id, 'galleryId' => $gallery->id]) }}">View Profile</a>
                            <a class="" href="{{ route('openMessageForm', $gallery->user->username) }}">Send Message</a>
                            <a 
                                class="{{ Request::routeIs('user.gallery') ? 'active' : '' }}" 
                                href="{{ route('user.gallery', ['id' => $gallery->user->id, 'galleryId' => $gallery->id]) }}"
                            >
                                All Galleries
                            </a>
                            <!-- <a class="" href="#">User Topics</a> -->
                            <a 
                                class="{{ Request::routeIs('user.private') ? 'active' : '' }}" 
                                href="{{ route('user.private', ['id' => $gallery->user->id, 'galleryId' => $gallery->id]) }}"
                            >
                                Private Area
                            </a>
                        </div>
                    </div>
                    <div class="col-md-10 center primary detail-info">
                        <h3>{{$gallery->gallery_name}}</h3>
                        <p class="desc">{{$gallery->description}}</p>
                        <div class="row upload-info">
                            <div class="col">
                                <div>Created</div>
                                <div>{{ \Carbon\Carbon::parse($gallery->created_at)->format('d-m-Y H:i:s') }}</div>
                            </div>
                            <div class="col">
                                <div>ArtWorks</div>
                                <div>{{$gallery->artwork_count}}</div>
                            </div>
                            <div class="col">
                                <div>Last Updated</div>
                                <div>{{ \Carbon\Carbon::parse($gallery->updated_at)->format('d-m-Y H:i:s') }}</div>
                            </div>
                            <div class="col">
                                <div>Gallery Views</div>
                                <div>{{$gallery->views}}</div>
                            </div>
                            <div class="col">
                                <div>Likes</div>
                                <div id="like-count">{{$gallery->likes}}</div>
                            </div>
                        </div>
                        <div class="row buttons">
                            @if($prevGalleryId)
                                <a href="{{ route('gallery', $prevGalleryId) }}" style="width: unset;"><button type="button">Previous Gallery</button></a>
                            @endif
                            <a href="{{ route('gallery.back') }}" style="width: unset;"><button type="button">Go Back</button></a>
                            @if($nextGalleryId)
                                <a href="{{ route('gallery', $nextGalleryId) }}" style="width: unset;"><button type="button">Next Gallery</button></a>
                            @endif
                        </div>
                        <div class="row action-buttons">
                            <div class="view-buttons col-md-2">
                                <!-- <a href="#">
                                    <i class="bi bi-phone-landscape"></i>
                                </a>
                                <a href="#">
                                    <i class="bi bi-grid-3x3-gap-fill"></i>
                                </a> -->
                            </div>
                            <ul class="pagination col-md-7 justify-content-center" role="menubar" aria-label="Pagination">
                                {{ $search->appends(Request::except('page'))->links('pagination::bootstrap-4') }}
                            </ul>
                            <div class="social-buttons col-md-3">
                                <a id="like-button">
                                    <i class="bi bi-heart{{ $gallery->isLikedByUser() ? '-fill' : '' }}"></i>
                                </a>
                                <!-- <a href="#">
                                    <i class="bi bi-share"></i>
                                </a>
                                <a href="">
                                    <i class="bi bi-exclamation-triangle"></i>
                                </a> -->
                            </div>
                        </div>
                        <div class="gallery-content min-h-45">
                            <div class="row bs-gutter-y-1">
                                @foreach($search as $artwork)
                                    <div class="gallery-item col-md-3" data-id="{{$artwork->id}}">
                                        <img src="{{ static_asset('uploads') . '/' . $artwork->img_main }}" alt="">
                                        <div class="name">{{$artwork->title}}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="row action-buttons justify-content-center">
                            <ul class="pagination" role="menubar" aria-label="Pagination">
                                {{ $search->appends(Request::except('page'))->links('pagination::bootstrap-4') }}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main><!-- End #main -->
@endsection

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function() {
        $(".gallery-content .gallery-item").on('click', function(){
            var artworkId = $(this).data('id');
            window.location.href = '{{ route("artwork", ["id" => "PLACEHOLDER"]) }}'.replace('PLACEHOLDER', artworkId);
        });

        $('#like-button').on('click', function(e) {
            e.preventDefault();
            var galleryId = {{ $gallery->id }};
            var likeButton = $(this);
            var likeIcon = likeButton.find('i');
            var isLiked = likeIcon.hasClass('bi-heart-fill');

            $.ajax({
                url: '{{ route("gallery.like", ["id" => "PLACEHOLDER"]) }}'.replace('PLACEHOLDER', galleryId),
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    is_liked: isLiked
                },
                success: function(response) {
                    if (response.success) {
                        likeIcon.toggleClass('bi-heart bi-heart-fill');
                        $('#like-count').text(response.likes);
                    }
                },
                error: function(xhr) {
                    if(xhr.responseText == '{"message":"Unauthenticated."}') {
                        alert("You need to log in to perform this action.");
                        window.location.href = "{{ route('login') }}";
                    }
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>

<style>
    h2 {
        font-family: 'DrukTextWideBold', sans-serif;
    }

    .gallery-content .gallery-item img {
        /* width: 185px!important;
        height: 185px!important; */
    }

    .detail-info .desc {
        white-space: pre-wrap;
        word-wrap: break-word;
    }

    .page-gallery-view .gallery-item img {
        height: 100%
    }
</style>
