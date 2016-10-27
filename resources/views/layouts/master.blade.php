<!DOCTYPE html>
<html lang="en" style="height:100%;">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>| Login | </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap -->
    <link rel="stylesheet prefetch" href="../bootstrap/css/bootstrap.min.css">
     <!-- Custom Theme Style -->
    <link rel="stylesheet prefetch" href="../public/css-gentella/custom.css"> </link>
    <!-- Font Awesome -->
    <link rel="stylesheet prefetch" href="../public/font-awesome/css/font-awesome.min.css"> </link>
     <!-- NProgress -->
    <link rel="stylesheet prefetch" href="../public/vendors/nprogress/nprogress.css"> </link>
    <!-- Animate.css -->
    <link rel="stylesheet prefetch" href="../public/vendors/animate.css/animate.min.css"> </link>
  </head>
    <style>
  .home
  {
    min-height: 720px;
    position: relative;
    height: 100%;
    background: url(img/clouds-earth-26689.jpg) center center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    background-size: cover;
    color: #fff;

  }
  </style>
    <div class="container-fluid home" >
    
      @yield('content')
    </div>
  
  <script type="text/javascript" src="../public/js/jquery-1.11.0.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <script src="../public/js-gentella/custom.js"></script>
  
  
</html>