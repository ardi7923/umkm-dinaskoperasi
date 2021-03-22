
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="token" content="{{ csrf_token() }}">
  <title>@yield('title_page')</title>

  @include('layouts.admin.styles')
  @yield('styles_page')
  @yield('css')
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
    @if(Auth::user()->role == 'ADMIN')
      @include('layouts.admin.sidebar-admin')
    @else
      @include('layouts.admin.sidebar-umkm')
    @endif

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        @include('layouts.admin.header')

        <!-- Begin Page Content -->
        <div class="container-fluid">


          @yield('content')
          <!-- Content Row -->

      <!-- End of Main Content -->
      @include('layouts.admin.footer')

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>


  @include('layouts.admin.scripts')

  @yield('scripts_page')
  @yield('js')
  
</body>

</html>
