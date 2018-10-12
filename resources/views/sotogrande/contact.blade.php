@extends('sotogrande.layout')

@section('mainsection')
    <!-- Sub banner start -->
<div class="sub-banner overview-bgi">
  <div class="container">
      <div class="breadcrumb-area">
          <h1>Contact Us</h1>
          <ul class="breadcrumbs">
              <li><a href="{{ url_home($language) }}">Home</a></li>
              <li class="active">Contact Us</li>
          </ul>
      </div>
  </div>
</div>
<!-- Sub banner end -->

<!-- Contact 2 start -->
<div class="contact-2 content-area-7">
  <div class="container">
      <div class="main-title">
          <h2>Contact Us</h2>
      </div>

      <div class="contact-info">
          <div class="row">
              {{-- <div class="col-md-3 col-sm-6 contact-info">
                  <i class="fa fa-map-marker"></i>
                  <p>Office Address</p>
                  <strong>20/F Green Road, Dhaka</strong>
              </div> --}}
              <div class="col-md-6 col-sm-6 contact-info">
                  <i class="fa fa-phone"></i>
                  <p>Phone Number</p>
                @if($static_data['site_settings']['contact_tel1'])
                    <p>
                        <strong>
                            {{ $static_data['site_settings']['contact_tel1'] }}
                        </strong>
                    </p>
                @endif
                @if($static_data['site_settings']['contact_tel2'])
                    <p>
                        <strong>
                            {{ $static_data['site_settings']['contact_tel2'] }}
                        </strong>
                    </p>
                @endif
                @if($static_data['site_settings']['contact_tel3'])
                    <p>
                        <strong>
                            {{ $static_data['site_settings']['contact_tel3'] }}
                        </strong>
                    </p>
                @endif
                @if($static_data['site_settings']['contact_tel4'])
                    <p>
                        <strong>
                            {{ $static_data['site_settings']['contact_tel4'] }}
                        </strong>
                    </p>
                @endif
                @if($static_data['site_settings']['contact_tel5'])
                    <p>
                        <strong>
                            {{ $static_data['site_settings']['contact_tel5'] }}
                        </strong>
                    </p>
                @endif
              </div>
              <div class="col-md-6 col-sm-6 contact-info">
                  <i class="fa fa-envelope"></i>
                  <p>Email Address</p>
                  <strong>{{get_setting('contact_email', 'site')}}</strong>
              </div>
              {{-- <div class="col-md-3 col-sm-6 contact-info">
                  <i class="fa fa-fax"></i>
                  <p>Fax</p>
                  <strong>+55 417 634 7X71</strong>
              </div> --}}
          </div>
      </div>

      <form method="POST">
          {{ csrf_field() }}
          <div class="row">
              <div class="col-lg-6 col-md-6">
                  <div class="form-group name">
                    <input 
                        type="text" 
                        name="name" 
                        class="form-control" 
                        placeholder="Name*"
                        data-contact-page-name
                    >
                  </div>

                  <div class="form-group email">
                    <input 
                        type="email" 
                        name="email" 
                        class="form-control" 
                        placeholder="Email*"
                        data-contact-page-email
                    >
                  </div>
                  
                  <div class="form-group number">
                    <input 
                        type="text" 
                        name="phone" 
                        class="form-control" 
                        placeholder="Phone*"
                        data-contact-page-phone
                    >
                  </div>

                  {{-- <div class="form-group subject">
                    <input 
                        type="text" 
                        name="subject" 
                        class="form-control" 
                        placeholder="Subject"
                    >
                  </div> --}}

              </div>
              <div class="col-lg-6 col-md-6">
                  <div class="form-group message">
                    <textarea 
                        class="form-control" 
                        name="message" 
                        placeholder="Write message*"
                        data-contact-page-message
                    ></textarea>
                  </div>
              </div>
              <div class="col-lg-12">
                  <br>
                  <div class="send-btn text-center">
                    <button 
                        type="submit" 
                        class="btn btn-color btn-md"
                        data-contact-page-submit
                    >Send Message</button>
                  </div>
              </div>
          </div>
      </form>
  </div>
</div>
<!-- Contact 2 end -->

<!-- Google map start -->
<div class="section">
  <div class="map">
      <div id="contact-page-map" class="contact-map"></div>
  </div>
</div>
<!-- Google map end -->

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{get_setting('google_map_key', 'site')}}&sensor=false"></script>
<script src="/sg_assets/js/map-contact-page.js"></script> <!-- google maps -->
<script>
  var mapOptions = {
    zoom: 15,
    scrollwheel: false,
		center: new google.maps.LatLng({{ get_setting('contact_map_lat', 'site') }}, {{ get_setting('contact_map_lon', 'site') }}),
		disableDefaultUI: false,
		draggable: true		
	};
</script>

@endsection