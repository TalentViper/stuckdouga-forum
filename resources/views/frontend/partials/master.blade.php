<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  @yield('meta-tags')

  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="{{ static_asset('frontend/css/styles.css?v=1.0.2') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ static_asset('admin/css/toastr.min.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/default.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/sceditor@3/minified/sceditor.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sceditor@3/minified/formats/bbcode.min.js"></script>
  <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=AW-11261494157"></script> -->
  <link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"/>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-11261494157');
</script>
<style>
/*--------------------------------------------------------------
  # Preloader
  --------------------------------------------------------------*/
  #preloader {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 9999;
    overflow: hidden;
    background: WHITE;
}

#preloader:before {
    content: "";
    position: fixed;
    top: calc(50% - 30px);
    left: calc(50% - 30px);
    border: 6px solid grey;
    border-top-color: #fff;
    border-bottom-color: #fff;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    animation: animate-preloader 1s linear infinite;
}

@keyframes animate-preloader {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}

@font-face {
    font-family: 'DrukTextWideBold';
    src: url('{{ static_asset('fonts/DrukTextWide-Bold.otf') }}') format('opentype');
    font-weight: bold;
    font-style: normal;
}

/* Fade-in effect */
.fade-in {
  opacity: 0;
  transition: opacity 0.5s ease-in-out;
}

.fade-in.show {
  opacity: 1;
}

</style>

</head>

<body>
    <!-- <div id="preloader"></div> -->
    @if (!str_contains(Route::currentRouteName(), 'member'))
        @include('frontend.partials.header')
    @endif
    <div class="main-content fade-in">
      @yield('main-content')
    </div>
    @include('frontend.partials.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>
    <script type="text/javascript" src="{{ static_asset('admin/js/toastr.min.js') }}"></script>
    <script type="text/javascript" src="{{ static_asset('frontend/js/toastr-config.js') }}"></script>
    <!-- <script type="text/javascript" src="{{ static_asset('frontend/js/autocomplete.multiselect.js') }}"></script> -->
    <script type="text/javascript" src="{{ static_asset('frontend/js/custom.js') }}"></script>
    {!! Toastr::message() !!}

    <!-- Google tag (gtag.js) -->
    <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-0XEE1YGZ7J"></script> -->
    <script>
        window.dataLayer = window.dataLayer || [];
        // function gtag(){dataLayer.push(arguments);}
        // gtag('js', new Date());

        // gtag('config', 'G-0XEE1YGZ7J');

        window.addEventListener('load', function() {
          // preloader.remove();

          setTimeout(function() {
            document.querySelector('.fade-in').classList.add('show');
            document.querySelector('#footer').classList.add('show');
          }, 250);
          // Add fade-in effect to main content
          setTimeout(function() {
            document.querySelector('.main-content').classList.add('show');
          }, 500);
        });
    </script>
    <!-- Include your custom Toastr configuration -->
    @yield('script')
</body>

</html>
