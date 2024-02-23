<!-- Developer by CMSNT.CO | quocbao@cmsnt.co -->
<!-- Dev By CMSNT.CO | FB.COM/CMSNT.CO | ZALO.ME/0947838128 | MMO Solution -->

<!DOCTYPE html>
<html lang="en">

@include('admin.layouts.partials.head-css')

<body>
  <!-- tap on top starts-->
  <div class="tap-top"><i data-feather="chevrons-up"></i></div>
  <!-- tap on tap ends-->
  <!-- Loader starts-->
  <div class="loader-wrapper">
    <div class="dot"></div>
    <div class="dot"></div>
    <div class="dot"></div>
    <div class="dot"> </div>
    <div class="dot"></div>
  </div>
  <!-- Loader ends-->
  <!-- page-wrapper Start-->
  <div class="page-wrapper compact-wrapper" id="pageWrapper">
    <!-- Page Header Start-->
    @include('admin.layouts.partials.header')
    <!-- Page Header Ends-->
    <!-- Page Body Start-->
    <div class="page-body-wrapper horizontal-menu">
      <!-- Page Sidebar Start-->
      @include('admin.layouts.partials.sidebar')
      <!-- Page Sidebar Ends-->
      <div class="page-body">
        <!-- Container-fluid starts-->
        <div class="container-fluid">
          @include('components.x-alert')

          @yield('content')
        </div>
        <!-- Container-fluid Ends-->
      </div>
      <!-- footer start-->
      @include('admin.layouts.partials.footer')
      <!-- footer end-->
    </div>
  </div>

  @include('admin.layouts.partials.footer-js')
</body>

</html>
