


<!-- General JS Scripts -->
<script type="text/javascript" src="{{ static_asset('admin/js/jquery-3.3.1.min.js') }}"></script>
<script type="text/javascript" src="{{ static_asset('admin/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ static_asset('admin/js/bootstrap.min.js') }}"></script>

<script type="text/javascript" src="{{ static_asset('admin/js/jquery.nicescroll.min.js') }}"></script>
<script type="text/javascript" src="{{ static_asset('admin/js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ static_asset('admin/js/stisla.js') }}"></script>
<script type="text/javascript" src="{{ static_asset('admin/js/bootstrap-fileselect.js') }}"></script>
<script type="text/javascript" src="{{ static_asset('admin/js/bootstrap-colorpicker.min.js') }}"></script>
<script type="text/javascript" src="{{ static_asset('admin/js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ static_asset('admin/js/bootstrap-tagsinput.min.js') }}"></script>
<script type="text/javascript" src="{{ static_asset('admin/js/bootstrap-multiselect.js') }}"></script>
<script src="{{ static_asset('admin/js/sweetalert211.min.js') }}"></script>
<!-- Template JS File -->
<script src="{{ static_asset('admin/js/scripts.js') }}"></script>
@stack('page-specific')
<script type="text/javascript" src="{{ static_asset('admin/js/toastr.min.js') }}"></script>
{!! Toastr::message() !!}
<script src="{{ static_asset('admin/js/page/jquery.selectric.min.js') }}"></script>
<script src="{{ static_asset('admin/js/select2.min.js') }}"></script>
@stack('page-script')
<script src="{{ static_asset('admin/js/custom.js') }}?version=130"></script>
<script src="{{ static_asset('admin/js/media.js') }}?version=130"></script>

@stack('script')

