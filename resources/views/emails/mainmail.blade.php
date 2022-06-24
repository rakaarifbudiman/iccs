<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ICCS Mail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">    
    <style>
      #details {        
        border-collapse: collapse;
        width: 100%;        
      }

      #details td, #details th {
        border: 1px solid #5678f4;
        padding: 8px;
        font-size: 12px;
      }

      #details tr:nth-child(even){background-color: #f2f2f2;}

      #details tr:hover {background-color: #ddd;}

      #details th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color:#233ea1;
        color: white;        
      }

      h4{
        color: #233ea1; 
        font-weight: bold;
      }
      p .footer{
        font-size: 8px;
        margin: 1px 1px 1px 1px;
      }

    </style>
  </head>
  <body>
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>