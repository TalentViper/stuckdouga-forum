<!DOCTYPE html>
<html lang="en">
    @include('admin.partials.header-assets')
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
    background: #228c16;
}

#preloader:before {
    content: "";
    position: fixed;
    top: calc(50% - 30px);
    left: calc(50% - 30px);
    border: 6px solid #228c16;
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


</style>
    <body class="{{ request()->route()->getName() == 'admin.pos.system' ||  request()->route()->getName() == 'seller.pos.system' ? 'sidebar-mini' : '' }}">
        <div id="preloader"></div>
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
        <div id="app">
            <div class="main-wrapper">
                @include('admin.partials.header')
                @include('admin.partials.sidebar')
                <div class="main-content">
                <!-- Main Content -->
                @yield('main-content')
                <!-- Main Content End -->
                </div>
                @include('admin.partials.footer')
            </div>
        </div>
        @include('admin.partials.footer-assets')
        @include('admin.partials.message')
        <input type="hidden" value="{{route('home')}}" id="url">
        <input type="hidden" value="" id="assets">
        <input name="get-me" type="hidden" id="get_user_type" value="admin" />
        @yield('modal')
        <script>
            let preloader = $('#preloader');
            if (preloader) {
            window.addEventListener('load', () => {
                preloader.remove()
            });
            }
            $(document).ready(function () {
                let myVar = setInterval(myTimer, 1000);
                function myTimer() {
                    const d = new Date();
                    document.getElementById("current_date").innerHTML = d.toDateString();
                    document.getElementById("current_time").innerHTML = d.toLocaleTimeString();
                }

                $('.date').datepicker({
                    "autoclose": true,
                    "format": "dd-mm-yyyy"
                });

                

            });
        </script>
    </body>
</html>
