<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, height=device-height, initial-scale=1.0" name="viewport">

  <title>Pages | @yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="/assets_old/img/logoiccsnew.svg" rel="icon">
  <link href="/assets_old/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/assets_old/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets_old/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/assets_old/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="/assets_old/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/assets_old/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="/assets_old/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="/assets_old/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/assets_old/css/style.css" rel="stylesheet">

  
</head>

<body>

  <main>
    <div class="container">

      <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
        <h1>@yield('code')</h1>
        <h2>@yield('message')</h2>
        @yield('content')
        

        
        <div class="credits">
          
          Designed by <a href="/">ICCS</a>
        </div>
      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="/assets_old/vendor/bootstrap/js/bootstrap.bundle.js"></script>
  <script src="/assets_old/vendor/php-email-form/validate.js"></script>
  <script src="/assets_old/vendor/quill/quill.min.js"></script>
  <script src="/assets_old/vendor/tinymce/tinymce.min.js"></script>
  <script src="/assets_old/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="/assets_old/vendor/chart.js/chart.min.js"></script>
  <script src="/assets_old/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="/assets_old/vendor/echarts/echarts.min.js"></script>

  <!-- Template Main JS File -->
  <script src="/assets_old/js/main.js"></script>

</body>

</html>