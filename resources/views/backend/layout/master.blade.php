
<!DOCTYPE html>
<html lang="en">


{{-- head  --}}
@include('backend.layout.includes.head')
{{-- head  --}}

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
   {{-- nav --}}
   @include('backend.layout.includes.nav')
   {{-- ./nav --}}
    <!-- partial -->
    <div class="container-fluid page-body-wrapper ">
      <!-- partial:partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
{{--        <div id="settings-trigger"><i class="fas fa-fill-drip"></i></div>--}}
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close fa fa-times"></i>
{{--          <p class="settings-heading">SIDEBAR SKINS</p>--}}
          <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles primary"></div>
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div>

      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
 @include('backend.layout.includes.sidebar')
      <!-- partial -->
      <div class="main-panel">
          <div class="content-wrapper">

            {{-- mainContent --}}
            @yield('mainContent')


{{--              @include('backend.layout.includes.chat',['userType' => 'admin'] )--}}
          {{-- ./mainContent --}}
          </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer align-baseline">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">{{$systemInfo->copy_right ?? 'N/A'}}</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">V 1.0.0 </span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
{{--script --}}
  @include('backend.layout.includes.script')
{{--./script --}}
</body>


</html>


