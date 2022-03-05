<!DOCTYPE html>
    <html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    @include('dashboard_layout.header')
    @stack('style')

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
<div id="app">
<!-- BEGIN: Header - horizontal-header -->
@include('dashboard_layout.horizontal-menu')
<!-- END: Header  - horizontal-header -->


<!-- BEGIN: Main Menu- sidebar-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    @include('dashboard_layout.sidebar')
</div>
<!-- END: Main Menu-->

<!-- BEGIN: Content-->
<div >
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">

                @yield('content')


        </div>
    </div>
</div>
<!-- END: Content-->

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light">
    @include('dashboard_layout.footer')
</footer>
<!-- END: Footer-->
</div>
</div>
<!-- BEGIN: Vendor JS-->
<script  src="{{asset('admin-layout/app-assets/vendors/js/vendors.min.js')}}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('admin-layout/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
{{--<script src="{{asset('admin-layout/app-assets/vendors/js/extensions/tether.min.js')}}"></script>--}}
{{--<script src="{{asset('admin-layout/app-assets/vendors/js/extensions/shepherd.min.js')}}"></script>--}}
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{asset('admin-layout/app-assets/js/core/app-menu.js')}}"></script>
<script src="{{asset('admin-layout/app-assets/js/core/app.js')}}"></script>
<script src="{{asset('admin-layout/app-assets/js/scripts/components.js')}}"></script>
<script src="{{asset('admin-layout/app-assets/js/scripts/pages/app-ecommerce-shop.js')}}"></script>
<!-- END: Theme JS-->
{{--<script>--}}
    {{--$('.dropdown ').click(function () {--}}
        {{--if ($('.dropdown-menu').is(':visible')) {--}}
            {{--$('.dropdown-menu').hide();--}}
        {{--} else {--}}
            {{--$('.dropdown-menu').css('display','block');--}}
        {{--}--}}
    {{--})--}}
{{--</script>--}}
<!-- BEGIN: Page JS-->
{{--<script src="{{asset('admin-layout/app-assets/js/scripts/pages/dashboard-analytics.js')}}"></script>--}}
<!-- END: Page JS-->
<script>
   let BASE_URL=window.location.origin;
   window.laravel={!! json_encode([
   'csrfToken' =>csrf_token()
   ])
    !!}

</script>
@stack('script')
</body>
<!-- END: Body-->

</html>