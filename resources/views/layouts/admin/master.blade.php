<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities. laravel/framework: ^8.40">
    <meta name="keywords" content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('assets_old/img/logoiccsnew.svg')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('assets_old/img/logoiccsnew.svg')}}" type="image/x-icon">
    <title>ICCS - @yield('title','Page Title')</title>
    
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <!-- Font Awesome-->
    @includeIf('layouts.admin.partials.css')
  </head>
  <body>
            <div class="preloader">        
              <div class="loading">           
                <h5 class="text-center text-danger" ><div class="spinner-border" role="status"></div>
                    Please Wait...</div></h5>   
              </div>
            </div> 
          <!-- == Prevent user view page source == -->  
          @php 
            for($i=0;$i<1000000;$i++){
                echo "\n";
            } 
          @endphp
  <!-- == End Prevent user view page source == -->  
    <!-- Loader starts-->
    <div class="loader-wrapper">
      <div class="theme-loader"></div>
    </div>
    
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-sidebar" id="pageWrapper">
      <!-- Page Header Start-->
      @includeIf('layouts.admin.partials.header')
      <!-- Page Header Ends -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper sidebar-icon">
        <!-- Page Sidebar Start-->
        @includeIf('layouts.admin.partials.sidebar')
        <!-- Page Sidebar Ends-->
        <div class="page-body mt-5">
          <!-- Container-fluid starts-->
          @include('layouts.admin.partials.sweetalert') 
          @yield('content')
          <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
        <footer class="footer">
          <div class="container-fluid" style="height: 1px !important">
            <div class="row">
              <div class="col-md-6 footer-copyright mx-2">
                <p class="pull-center mb-0">Copyright {{date('Y')}}-{{date('Y', strtotime('+1 year'))}} © {{ env('APP_NAME') }} All rights reserved.</p>
              </div>
              <div class="col-md-4">
                <p class="pull-center mb-0">Hand crafted & made with <i class="fa fa-heart font-secondary"></i></p>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <!-- latest jquery-->
    
    @includeIf('layouts.admin.partials.js')
  </body>
</html>