<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta http-equiv="refresh" content="3600">
  <title>ICCS - @yield('title','Page Title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">  
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <!-- Favicons -->
  <link href="/assets/img/logoiccsnew.svg" rel="icon">
  {{-- <link href="/assets/img/logoiccsnew.svg" rel="icon"> --}}
  <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->  
  <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.min.css" rel="stylesheet">
  <link href="/assets/vendor/remixicon/remixicon.min.css" rel="stylesheet">
  <link href="/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="/assets/vendor/simple-datatables/style.min.css" rel="stylesheet">
  <link href="/assets/css/jquery-editable.min.css" rel="stylesheet"/>

  <!-- Template Main CSS File -->
  <link href="/assets/css/style.min.css" rel="stylesheet"> 

    <!-- Template Jquery File -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="/assets/js/search.min.js"></script>   
    <script src="/assets/js/jqtable.min.js"></script>    
    <script>$.fn.poshytip={defaults:null}</script>   


  <!-- ==
  * Template Name: NiceAdmin - v2.1.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  == -->

</head>
<body>  
  <div class="preloader">        
    <div class="loading">           
      <h5 class="text-center text-pink" ><div class="spinner-border" role="status"></div>
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

<!-- == Header == -->
    @include('layouts.header')
    
<!-- == Sidebar == -->  
    @include('layouts.sidebar')  

<!-- == Content == --> 
  <main id="main" class="main">    
    @include('layouts.flash-message')  
        @yield('content')
    
  </main><!-- End #main -->

<!-- == Footer == -->
  @include('layouts.footer')  
</body>
</html>