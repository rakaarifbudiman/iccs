<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Reset Password - ICCS</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/logoiccsnew.svg" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  
</head>

<body>

{{-- <main> --}}
<x-guest-layout>
    
</x-guest-layout>

<div class="container">
<!-- Session Status -->
<x-auth-session-status class="mb-4" :status="session('status')" />
@include('layouts.flash-message')
<!-- Validation Errors -->
<x-auth-validation-errors class="alert alert-danger alert-dismissible fade show" :errors="$errors" role="alert"/>  

    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

            

            <div class="card mb-3">

              <div class="card-body">
                
                <div class="pt-4 pb-2">
                  <div class="d-flex justify-content-center py-1">
                  <a href="/" class="logo d-flex align-items-center w-auto">
                    <img src="assets/img/logoiccsnew.svg" alt="">
                    <span class="d-none d-lg-block">ICCS</span>
                  </a>
                </div><!-- End Logo -->
                  <h5 class="card-title text-center pb-0 fs-4">Forgot your password ? </h5>
                  <p class="text-center small">No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
                </div>

                <form class="row g-3" action="{{ route('password.email') }}" method="POST">
                    @csrf
                  <div class="col-12">
                    <div class="input-group has-validation">
                      <input type="email" name="email" class="form-control" id="yourUsername" placeholder="Please enter your email" autofocus required value={{ old('email') }} >
                      <div class="invalid-feedback">Please enter your email.</div>
                    </div>
                  </div>
                                
                  <div class="col-12">
                    <button class="btn-login w-100" type="submit" name="Login">Email Password Reset Link</button>
                  </div>
                    <div class="col-12">
                    <p class="small mb-0">Back to <a href="/">Login</a></p>                                       
                    </div>             

                </form>

              </div>
            </div>

            <div class="credits">
              Designed by <a href="">ICCS</a>
            </div>

          </div>
        </div>
      </div>

    </section>
    
  </div>
{{-- </main><!-- End #main --> --}}
<!--  -->
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/quill/quill.min.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/chart.js/chart.min.js"></script>
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

</body>

</html>
