<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sotogrande</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="/sg_assets/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="/sg_assets/css/magnific-popup.css">
    <link type="text/css" rel="stylesheet" href="/sg_assets/css/jquery.selectBox.css">
    <link type="text/css" rel="stylesheet" href="/sg_assets/css/dropzone.css">
    <link type="text/css" rel="stylesheet" href="/sg_assets/css/rangeslider.css">
    <link type="text/css" rel="stylesheet" href="/sg_assets/css/animate.min.css">
    <link type="text/css" rel="stylesheet" href="/sg_assets/css/leaflet.css">
    <link type="text/css" rel="stylesheet" href="/sg_assets/css/map.css">
    <link type="text/css" rel="stylesheet" href="/sg_assets/css/jquery.mCustomScrollbar.css">
    <link type="text/css" rel="stylesheet" href="/sg_assets/fonts/font-awesome/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="/sg_assets/fonts/flaticon/font/flaticon.css">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="/sg_assets/img/favicon.ico" type="image/x-icon" >

    <!-- Google fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800%7CPoppins:400,500,700,800,900%7CRoboto:100,300,400,400i,500,700">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="/sg_assets/css/style.css">
    <link rel="stylesheet" type="text/css" id="style_sheet" href="/sg_assets/css/skins/default.css">

</head>
<body id="top">

{{-- <div class="page_loader"></div> --}}

@include('sotogrande.top-header')

@include('sotogrande.main-header')

@yield('mainsection')

@include('sotogrande.footer')


<!-- External JS libraries -->
<script src="/sg_assets/js/jquery-2.2.0.min.js"></script>
<script src="/sg_assets/js/popper.min.js"></script>
<script src="/sg_assets/js/bootstrap.min.js"></script>
<script src="/sg_assets/js/jquery.selectBox.js"></script>
<script src="/sg_assets/js/rangeslider.js"></script>
<script src="/sg_assets/js/jquery.magnific-popup.min.js"></script>
<script src="/sg_assets/js/jquery.filterizr.js"></script>
<script src="/sg_assets/js/wow.min.js"></script>
<script src="/sg_assets/js/backstretch.js"></script>
<script src="/sg_assets/js/jquery.countdown.js"></script>
<script src="/sg_assets/js/jquery.scrollUp.js"></script>
<script src="/sg_assets/js/particles.min.js"></script>
<script src="/sg_assets/js/typed.min.js"></script>
<script src="/sg_assets/js/dropzone.js"></script>
<script src="/sg_assets/js/jquery.mb.YTPlayer.js"></script>
<script src="/sg_assets/js/leaflet.js"></script>
<script src="/sg_assets/js/leaflet-providers.js"></script>
<script src="/sg_assets/js/leaflet.markercluster.js"></script>
<script src="/sg_assets/js/maps.js"></script>
<script src="/sg_assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0N5pbJN10Y1oYFRd0MJ_v2g8W2QT74JE"></script>
<script src="/sg_assets/js/ie-emulation-modes-warning.js"></script>
<!-- Custom JS Script -->
<script src="/sg_assets/js/app.js"></script>

</body>
</html>