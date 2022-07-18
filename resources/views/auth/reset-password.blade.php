<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Change Password - ICCS</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets_old/img/logoiccsnew.svg" rel="icon">
  <link href="assets_old/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets_old/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets_old/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets_old/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets_old/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets_old/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets_old/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets_old/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets_old/css/style.css" rel="stylesheet">
  
</head>

<body>
<div class="container">
  @include('layouts.admin.partials.sweetalert') 
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">            

            <div class="card mb-3">

              <div class="card-body">
                
                <div class="pt-4 pb-2">
                  <div class="d-flex justify-content-center py-1">
                  <a href="/" class="logo d-flex align-items-center w-auto">
                    <img src="assets_old/img/logoiccsnew.svg" alt="">
                    <span class="d-none d-lg-block">ICCS</span>
                  </a>
                    </div><!-- End Logo -->
                  <h5 class="card-title text-center pb-0 fs-4">Change your password ? </h5>                  
                </div>

                <form class="row g-3" action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                  <div class="col-12">
                    <div class="input-group has-validation">
                        <input type="hidden" name="email" class="form-control" id="yourUsername" placeholder="Please enter your email"  required value="{{ old('email', $request) }}">  
                      <input type="email" name="email2" class="form-control" id="yourUsername" placeholder="Please enter your email"  required value="{{ old('email', $request) }}" disabled>
                      <div class="invalid-feedback">Please enter your email.</div>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="input-group has-validation">
                      <input type="password" name="password" class="form-control" id="password" placeholder="New Password" autofocus required minlength="8">
                      <div class="invalid-feedback">Please enter new password.</div>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="input-group has-validation">
                      <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm Password" required minlength="8">
                      <div class="invalid-feedback">Please enter confirm password.</div>
                    </div>
                  </div>
                                
                  <div class="col-12">
                    <button class="btn-login w-100" type="submit" name="changepassword">Change Password</button>
                  </div>
                  <nav>
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">*Password length min.8 character, contain at least mixed case (lower, upper case, number, and symbol)</li>                      
                    </ol>
                  </nav>              
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

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets_old/vendor/bootstrap/js/bootstrap.bundle.js"></script>
<script src="assets_old/vendor/php-email-form/validate.js"></script>
<script src="assets_old/vendor/quill/quill.min.js"></script>
<script src="assets_old/vendor/tinymce/tinymce.min.js"></script>
<script src="assets_old/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets_old/vendor/chart.js/chart.min.js"></script>
<script src="assets_old/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets_old/vendor/echarts/echarts.min.js"></script>

<!-- Template Main JS File -->
<script src="assets_old/js/main.js"></script>

</body>

</html>
