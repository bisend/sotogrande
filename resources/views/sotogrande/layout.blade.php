<!DOCTYPE html>
<html lang="{{ ! empty($language) ? $language : 'en' }}">
<head>
    <title>{{ ! empty($title) ? $title : 'Ayling' }}</title>
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
    {{-- <link rel="shortcut icon" href="/sg_assets/img/favicon.ico" type="image/x-icon" > --}}
    <link rel="shortcut icon" href="/sg_assets/img/fav.png" type="image/x-icon" >

    <!-- Google fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800%7CPoppins:400,500,700,800,900%7CRoboto:100,300,400,400i,500,700">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="/sg_assets/css/style.css">
    <link rel="stylesheet" type="text/css" id="style_sheet" href="/sg_assets/css/skins/default.css">
    {{-- <script src='https://www.google.com/recaptcha/api.js'></script> --}}
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
    {{-- <script src='https://www.google.com/recaptcha/api.js?hl=en' async defer></script> --}}
</head>
<body id="top">

{{-- <div class="page_loader"></div> --}}

<input 
    type="hidden" 
    name="recaptcha-site-key" 
    value="{{ get_setting('reCaptcha_api', 'site') ? get_setting('reCaptcha_api', 'site') : 'undefined' }}"
    data-recaptcha-site-key 
>

@if ($page && $page != 'property')
    @if ($page != 'contact')
        <div class="option-panel" data-callback-form>
            <h2>Call Back</h2>
            <div>
                <form method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="callback-name">Name:</label>
                        <input type="text" id="callback-name" class="form-control" placeholder="Name" data-callback-name>
                    </div>
                    <div class="form-group">
                        <label for="callback-phone">Phone Number:</label>
                        <input type="phone" id="callback-phone" class="form-control" placeholder="Phone" data-callback-phone>
                    </div>
                    <div class="recaptcha-div">
                        <span id="recaptcha-error-callback">Please complete the verification!</span>
                        <div class="recaptcha-style" id="call-back-captcha"></div>
                    </div>
                    <button type="submit" class="submit-callback btn btn-color" data-callback-submit>Send</button>
                </form>
            </div>
            <div class="setting-button">
                <i class="fa fa-volume-control-phone"></i>
            </div>
        </div>
    @endif
@else
<div class="option-panel-double-form" data-option-panel-double-form>
    <a class="close-option-panel-double-form" data-option-panel-double-form-close>
        <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
    </a>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" id="callbackInterestTab" role="tablist">
        <li class="nav-item" data-option-panel-nav-item>
            <a 
                class="nav-link nav-link-gray active" 
                id="callback-tab" 
                data-toggle="tab" 
                href="#tabCallback" 
                role="tab" 
                aria-controls="tabCallback" 
                aria-selected="true"
            >
                <i class="fa fa-volume-control-phone"></i>
            </a>
        </li>
        <li class="nav-item" data-option-panel-nav-item>
            <a 
                class="nav-link nav-link-gray" 
                id="interest-tab" 
                data-toggle="tab" 
                href="#tabInterest" 
                role="tab" 
                aria-controls="tabInterest" 
                aria-selected="false"
            >
                <i class="fa fa-envelope"></i>
            </a>
        </li>
    </ul>
      
      <!-- Tab panes -->
      <div class="tab-content">
        <div class="tab-pane active" id="tabCallback" role="tabpanel" aria-labelledby="callback-tab">
            <h2>Callback</h2>
            <div>
                <form method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="callback-name">Name:</label>
                        <input type="text" id="callback-name" class="form-control" placeholder="Name" data-callback-name>
                    </div>
                    <div class="form-group">
                        <label for="callback-phone">Phone Number:</label>
                        <input type="phone" id="callback-phone" class="form-control" placeholder="Phone" data-callback-phone>
                    </div>
                    <div class="recaptcha-div">
                        <span id="recaptcha-error-callback">Please complete the verification!</span>
                        <div class="recaptcha-style" id="call-back-captcha"></div>
                    </div>
                    <button type="submit" class="submit-callback btn btn-color" data-callback-submit>Send</button>
                </form>
            </div>
        </div>
        <div class="tab-pane" id="tabInterest" role="tabpanel" aria-labelledby="interest-tab">
            <h2>Register Interest</h2>
            <div>
                <form method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="interest-name">Name:</label>
                        <input type="text" id="interest-name" class="form-control" placeholder="Name" data-interest-name>
                    </div>
                    <div class="form-group">
                        <label for="interest-email">Email:</label>
                        <input type="text" id="interest-email" class="form-control" placeholder="Email" data-interest-email>
                    </div>
                    <div class="form-group">
                        <label for="interest-phone">Phone Number:</label>
                        <input type="phone" id="interest-phone" class="form-control" placeholder="Phone" data-interest-phone>
                    </div>
                    <div class="recaptcha-div">
                        <span id="recaptcha-error-reg">Please complete the verification!</span>
                        <div class="recaptcha-style" id="interest-captcha"></div>
                    </div>
                    <button type="submit" class="submit-callback btn btn-color" data-interest-submit>Send</button>
                </form>
            </div>
        </div>
      </div>
</div>
@endif

<!-- Modal -->
<div class="modal fade successModal" id="successModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <p><i class="fa fa-check-circle-o" aria-hidden="true"></i>You request was successfully sent!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-color"  data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


@include('sotogrande.top-header')

@include('sotogrande.main-header')

@yield('mainsection')

@include('sotogrande.footer')


<!-- External JS libraries -->
<script src="/sg_assets/js/jquery-2.2.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.11/lodash.min.js"></script>
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
{{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0N5pbJN10Y1oYFRd0MJ_v2g8W2QT74JE"></script> --}}
<script src="/sg_assets/js/ie-emulation-modes-warning.js"></script>
<script src="/sg_assets/js/jquery.matchHeight.js"></script>
<!-- Custom JS Script -->
<script src="/sg_assets/js/app.js"></script>

</body>
</html>