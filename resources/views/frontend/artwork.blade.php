@extends('frontend.partials.master')
<link rel="stylesheet" href="https://icons.getbootstrap.com/assets/font/bootstrap-icons.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include Fancybox CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
<!-- Include Fancybox JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
@section('main-content')

<main id="main" class="main-content">

    <div id="content" class="page-artwork">
        <div class="content_box">
            <div class="container-fluit pt-4">
                <div class="row">
                    <div class="col-md-2 sider">
                    <div class="side_title"><h5>Dragon</h5></div>
                    <div class="tag-page-gallery mb30">
                        <img src="{{ static_asset('images/img/art_thumb1.jpg') }}" alt="">
                        <a class="mt-10" href="#">View Profile</a>
                        <a class="" href="#">Send Message</a>
                        <a class="" href="#">Follow</a>
                        <a class="" href="#">Galleries</a>
                        <a class="" href="#">News & Updates</a>
                        <a class="" href="#">Private Area</a>
                        <a class="" href="#">Links</a>
                        <a class="" href="#">Wishlist</a>
                    </div>
                    <div class="side_title"><h5>ArtWork Info:</h5></div>
                        <div class="info">
                            <!-- <h6>Krenky</h6> -->
                            <h6>Source: {{ $sources[$artwork->source] }}</h6>
                            <h6>Layers: {{ $artwork->layers }}</h6>
                            <h6>sketches: {{ $artwork->sketch }}</h6>
                            <h6>Type: {{ $artwork->type }}</h6>
                            <br/>
                        </div>
                    </div>
                    <div class="col-md-10 center primary detail-info">
                        <h3>{{$artwork->gallery->gallery_name}}</h3>
                        <h2>{{$artwork->title}}</h2>
                        <div class="row upload-info">
                            <div class="col">
                                <div>Uploaded</div>
                                <div>{{ \Carbon\Carbon::parse($artwork->created_at)->format('d-m-Y H:i:s') }}</div>
                            </div>
                            <div class="col">
                                <div>ArtWork Views</div>
                                <div>{{$artwork->views}}</div>
                            </div>
                            <div class="col">
                                <div>Likes</div>
                                <div class="like-count">{{$artwork->likes}}</div>
                            </div>
                        </div>
                        <div class="row buttons">
                            @if($prevArtworkId)
                                <a href="{{ route('artwork', $prevArtworkId) }}" style="width: unset;"><button type="button">Previous ArtWork</button></a>
                            @endif
                            <button type="button" id="goBackToGalleryButton">Go Back to Gallery</button>
                            @if($nextArtworkId)
                                <a href="{{ route('artwork', $nextArtworkId) }}" style="width: unset;">
                                    <button type="button">Next ArtWork</button>
                                </a>
                            @endif
                        </div>
                        <div class="row favorite-buttons p-2">
                            <!-- <a href="#" class="pointer">
                                <i class="bi bi-hand-thumbs-up"></i>
                            </a> -->
                            <a id="like-button" class="pointer">
                                <i class="bi bi-heart{{ $artwork->isLikedByUser() ? '-fill' : '' }}"></i>
                            </a>
                            <a href="#" class="pointer">
                                <i class="bi bi-share"></i>
                            </a>
                            <a class="pointer">
                                <i class="bi bi-exclamation-triangle"></i>
                            </a>
                        </div>
                        <a href="{{ static_asset('images/img/art_big.jpg') }}" data-lightbox="artwork" data-title="Unknown ArtWork #1" class="light-detail mt-2" data-fancybox="gallery">
                            <img src="{{ static_asset('images/img/art_big.jpg') }}" alt="">
                        </a>
                        <div class="row attaches p-4">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="{{ static_asset('images/img/t7.jpg') }}" data-lightbox="artwork" data-title="Image 1" data-fancybox="gallery">
                                            <img src="{{ static_asset('images/img/t7.jpg') }}" alt="">
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ static_asset('images/img/t7.jpg') }}" data-lightbox="artwork" data-title="Image 2" data-fancybox="gallery">
                                            <img src="{{ static_asset('images/img/t7.jpg') }}" alt="">
                                        </a>
                                    </div>
                                    <div class="col-md-6 mt-4">
                                        <a href="{{ static_asset('images/img/t7.jpg') }}" data-lightbox="artwork" data-title="Image 3" data-fancybox="gallery">
                                            <img src="{{ static_asset('images/img/t7.jpg') }}" alt="">
                                        </a>
                                    </div>
                                    <div class="col-md-6 mt-4">
                                        <a href="{{ static_asset('images/img/t7.jpg') }}" data-lightbox="artwork" data-title="Image 4" data-fancybox="gallery">
                                            <img src="{{ static_asset('images/img/t7.jpg') }}" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 explanation">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main><!-- End #main -->
@endsection

<style>
    .attaches img {
        width: 100%;
    }

    .attaches img:hover {
        opacity: 0.65;
    }

    .explanation {
        word-break: break-all;
    }

    .favorite-buttons a {
        font-size: 22px;
    }
</style>

<script>
$(document).ready(function() {
    // $('[data-fancybox="gallery"]').fancybox({
    //     // Options go here
    // });
    $('#goBackToGalleryButton').on('click', function(e) {
        window.history.back();
    });

    $('#like-button').on('click', function(e) {
        var artworkId = {{ $artwork->id }};
        var likeButton = $(this);
        var likeIcon = likeButton.find('i');
        var isLiked = likeIcon.hasClass('bi-heart-fill');

        $.ajax({
            url: '{{ route("artwork.like", ["id" => "PLACEHOLDER"]) }}'.replace('PLACEHOLDER', artworkId),
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
                    $('.like-count').text(response.likes);
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
