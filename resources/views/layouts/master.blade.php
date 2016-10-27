<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>| Login | </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet prefetch" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet prefetch" href="../public/css-gentella/custom.css"> </link>

  </head>

    <div class="container">
      @yield('content')
    </div>
  
  <script type="text/javascript" src="../public/js/jquery-1.11.0.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <script src="../public/js-gentella/custom.js"></script>
  
</html>