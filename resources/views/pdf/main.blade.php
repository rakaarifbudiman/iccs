<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>ICCS - @yield('title','Page Title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">  
  <!-- Favicons -->
  <link href="/assets/img/logoiccstext.png" rel="icon">
  <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- CSS Files -->
  <link href="/assets_alt/css/bootstrap.min.css" rel="stylesheet">
  <style>
		*{
			font-size: 12px;
		}
		@page { 
			margin-top: 0cm;
			margin-bottom: 0cm;
		}
		.footer {
			position: absolute;
			bottom: 0;
			width: 100%;			
		}
		.flex-container {
		display: flex;
		width: 100%;
		justify-content: space-between;
		background-color: DodgerBlue;
		}

		.flex-container > div {
		background-color: #f1f1f1;		
		text-align: center;		
		font-size: 12px;
		}
	</style>


</head>

<body>
  <main id="main" class="main">    
        @yield('content')    
  </main><!-- End #main -->

  <footer id="footer" class="footer">
    
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="/assets_alt/js/bootstrap.bundle.js"></script>



</body>

</html>