<!DOCTYPE html>
<html lang="en">

{{-- Head --}}
@include('backendCustomer.layout.includes.head')

@php
    $isExamPage = in_array(Route::currentRouteName(), ['exam.start']);
@endphp

<body class="{{ $isExamPage ? '' : 'ttr-opened-sidebar ttr-pinned-sidebar' }}">

<!-- Header Start -->
@include('backendCustomer.layout.includes.header')
<!-- Header End -->

@if (empty($hideSidebar))
    <!-- Left Sidebar Menu Start -->
    @include('backendCustomer.layout.includes.sideBar')
    <!-- Left Sidebar Menu End -->
@endif

<!-- Main Container Start -->
<main class="ttr-wrapper py-5 mt-5">
    <div class="container-fluid">
        @yield('mainContent')

        {{-- Chatbox --}}
        @include('backendCustomer.communication.chat', ['userType' => 'customer'])
    </div>
</main>

<div class="ttr-overlay"></div>

<!-- ======================= Global JS Scripts ======================= -->
<!-- jQuery (must be loaded first) -->
<script src="{{ asset('customer/js/jquery.min.js') }}"></script>

<!-- Bootstrap and Plugins -->
<script src="{{ asset('customer/vendors/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('customer/vendors/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('customer/vendors/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('customer/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js') }}"></script>

<!-- Other Plugins -->
<script src="{{ asset('customer/vendors/magnific-popup/magnific-popup.js') }}"></script>
<script src="{{ asset('customer/vendors/counter/waypoints-min.js') }}"></script>
<script src="{{ asset('customer/vendors/counter/counterup.min.js') }}"></script>
<script src="{{ asset('customer/vendors/imagesloaded/imagesloaded.js') }}"></script>
<script src="{{ asset('customer/vendors/masonry/masonry.js') }}"></script>
<script src="{{ asset('customer/vendors/masonry/filter.js') }}"></script>
<script src="{{ asset('customer/vendors/owl-carousel/owl.carousel.js') }}"></script>
<script src="{{ asset('customer/vendors/scroll/scrollbar.min.js') }}"></script>
<script src="{{ asset('customer/vendors/chart/chart.min.js') }}"></script>

<!-- Custom Admin Scripts -->
<script src="{{ asset('customer/js/functions.js') }}"></script>
<script src="{{ asset('customer/js/admin.js') }}"></script>

<!-- ======================= Page-Specific Scripts ======================= -->
@stack('scripts')

</body>
</html>
