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
                    <div class="side_title"><h5>{{ $artwork->gallery->user->full_name }}</h5></div>
                    <div class="tag-page-gallery mb30">
                        <img src="{{ $artwork->gallery->user->avatar ? static_asset('uploads/' . $artwork->gallery->user->avatar) : ( $artwork->gallery->user->gender == 'female' ? static_asset('images/img/female_default.jpg') : static_asset('images/img/male_default.jpg') ) }}" alt="" width="200">
                        <a 
                            class="mt-10 {{ Request::routeIs('user.profile') ? 'active' : '' }}" 
                            href="{{ route('user.profile', ['id' => $artwork->gallery->user->id, 'galleryId' => $artwork->gallery->id]) }}"
                        >
                            View Profile
                        </a>
                        <a class="" href="{{ route('openMessageForm', $artwork->gallery->user->username) }}">Send Message</a>
                        <a 
                            class="{{ Request::routeIs('user.gallery') ? 'active' : '' }}" 
                            href="{{ route('user.gallery', ['id' => $artwork->gallery->user->id, 'galleryId' => $artwork->gallery->id]) }}"
                        >
                            All Galleries
                        </a>
                        <a 
                            class="{{ Request::routeIs('user.private') ? 'active' : '' }}" 
                            href="{{ route('user.private', ['id' => $artwork->gallery->user->id, 'galleryId' => $artwork->gallery->id]) }}"
                        >
                            Private Area
                        </a>
                    </div>
                    <div class="side_title"><h5>ArtWork Info:</h5></div>
                        <div class="info">
                            <!-- <h6>Krenky</h6> -->
                            @if(!empty($artwork->type))
                                <h6>Type: {{ $artwork->type }}</h6>
                            @endif
                            <!-- @if($artwork->section)
                                <h6>Section: {{ $section[$artwork->section] }}</h6>
                            @endif -->
                            <h6>Info Position: {{ $info[$artwork->info] }}</h6>
                        
                            <h6>Visibility: {{ $visibility[$artwork->visibility] }}</h6>

                            @if(!empty($artwork->source))
                                <h6>Source: {{ $sources[$artwork->source] }}</h6>
                            @endif

                            @if(!empty($artwork->background)) 
                                <h6>Background: {{ $background[$artwork->background] }}</h6>
                            @endif

                            @if(!empty($artwork->stype)) 
                                <h6>Sequence Type: {{ $stype[$artwork->stype] }}</h6>
                            @endif
                            @if(!empty($artwork->layers))
                                <h6>Layers: {{ $artwork->layers }}</h6>
                            @endif
                            @if(!empty($artwork->sketch))
                                <h6>sketches: {{ $artwork->sketch }}</h6>
                            @endif
                            @if(!empty($artwork->snb))
                                <h6>Sequence Nb: {{ $artwork->snb }}</h6>
                            @endif

                            @if(!empty($artwork->condition))
                                <h6>Condition: {{ $condition[$artwork->condition] }}</h6>
                            @endif
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
                            <button type="button" id="goBackToGalleryButton">Go Back</button>
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
                            <!-- <a href="#" class="pointer">
                                <i class="bi bi-share"></i>
                            </a>
                            <a class="pointer">
                                <i class="bi bi-exclamation-triangle"></i>
                            </a> -->
                        </div>
                        @if($artwork->img_main)
                            <a href="{{ static_asset('uploads/' . $artwork->img_main) }}" data-lightbox="artwork" data-title="Unknown ArtWork #1" class="light-detail mt-2" data-fancybox="gallery">
                                <img src="{{ static_asset('uploads/' . $artwork->img_main) }}" alt="">
                            </a>
                        @endif
                        <div class="row attaches p-4">
                            <div class="col-md-6">
                                <div class="row artwork-item-group">
                                    @if($artwork->img2)
                                        <div class="col-md-6">
                                            <a href="{{ static_asset('uploads/'. $artwork->img2) }}" data-lightbox="artwork" data-title="Image 1" data-fancybox="gallery">
                                                <img src="{{ static_asset('uploads/'. $artwork->img2) }}" alt="">
                                            </a>
                                        </div>
                                    @endif
                                    @if($artwork->img3)
                                        <div class="col-md-6">
                                            <a href="{{ static_asset('uploads/'. $artwork->img3) }}" data-lightbox="artwork" data-title="Image 2" data-fancybox="gallery">
                                                <img src="{{ static_asset('uploads/'. $artwork->img3) }}" alt="">
                                            </a>
                                        </div>
                                    @endif
                                    @if($artwork->img4)
                                    <div class="col-md-6">
                                        <a href="{{ static_asset('uploads/'. $artwork->img4) }}" data-lightbox="artwork" data-title="Image 3" data-fancybox="gallery">
                                            <img src="{{ static_asset('uploads/'. $artwork->img4) }}" alt="">
                                        </a>
                                    </div>
                                    @endif
                                    @if($artwork->img5)
                                        <div class="col-md-6">
                                            <a href="{{ static_asset('uploads/'. $artwork->img5) }}" data-lightbox="artwork" data-title="Image 4" data-fancybox="gallery">
                                                <img src="{{ static_asset('uploads/'. $artwork->img5) }}" alt="">
                                            </a>
                                        </div>
                                    @endif
                                    @if($artwork->img6)
                                        <div class="col-md-6">
                                            <a href="{{ static_asset('uploads/'. $artwork->img6) }}" data-lightbox="artwork" data-title="Image 5" data-fancybox="gallery">
                                                <img src="{{ static_asset('uploads/'. $artwork->img6) }}" alt="">
                                            </a>
                                        </div>
                                    @endif
                                    @if($artwork->img7)
                                        <div class="col-md-6">
                                            <a href="{{ static_asset('uploads/'. $artwork->img7) }}" data-lightbox="artwork" data-title="Image 6" data-fancybox="gallery">
                                                <img src="{{ static_asset('uploads/'. $artwork->img7) }}" alt="">
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="explanation">{{ $artwork->desc }}</div>
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
        height: -webkit-fill-available;
    }

    .attaches img:hover {
        opacity: 0.65;
    }

    .explanation {
        word-break: break-all;
        white-space: pre-wrap;
        white-space: -moz-pre-wrap;
        word-wrap: "break-word";
        text-align: left;
    }

    .favorite-buttons a {
        font-size: 22px;
    }

    .artwork-item-group {
        --bs-gutter-y: 1rem !important;
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
