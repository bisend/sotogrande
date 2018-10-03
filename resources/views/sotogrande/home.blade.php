@extends('sotogrande.layout')

@section('mainsection')

<!-- Banner start -->
<div class="banner banner-bg" id="particles-banner-wrapper">
  <div id="particles-banner"></div>
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
          <div class="carousel-item item-bg active">
              <div class="carousel-caption banner-slider-inner d-flex h-100 text-left">
                  <div class="carousel-content container">
                      <div class="text-left max-w">
                          <h3 data-animation="animated fadeInDown delay-05s">We love make things <br/>amazing and simple</h3>
                          <p data-animation="animated fadeInUp delay-10s">
                              This is real estate website template based on Bootstrap 4 framework.
                          </p>
                          <a data-animation="animated fadeInUp delay-10s" href="#" class="btn btn-lg btn-round btn-theme">Get Started Now</a>
                          <a data-animation="animated fadeInUp delay-12s" href="#" class="btn btn-lg btn-round btn-white-lg-outline">Free Download</a>
                      </div>
                  </div>
              </div>
          </div>

          <div class="carousel-item item-bg">
              <div class="carousel-caption banner-slider-inner d-flex h-100 text-left">
                  <div class="carousel-content container">
                      <div class="text-left max-w">
                          <h3 data-animation="animated fadeInDown delay-05s">Find Your <br/> Dream Properties</h3>
                          <p data-animation="animated fadeInUp delay-10s">
                              This is real estate website template based on Bootstrap 4 framework.
                          </p>
                          <a data-animation="animated fadeInUp delay-10s" href="#" class="btn btn-lg btn-round btn-theme">Get Started Now</a>
                          <a data-animation="animated fadeInUp delay-12s" href="#" class="btn btn-lg btn-round btn-white-lg-outline">Free Download</a>
                      </div>
                  </div>
              </div>
          </div>

          <div class="carousel-item item-bg">
              <div class="carousel-caption banner-slider-inner d-flex h-100 text-left">
                  <div class="carousel-content container">
                      <div class="text-left max-w">
                          <h3 data-animation="animated fadeInDown delay-05s">Best Place For <br/> Sell Properties</h3>
                          <p data-animation="animated fadeInUp delay-10s">
                              This is real estate website template based on Bootstrap 4 framework.
                          </p>
                          <a data-animation="animated fadeInUp delay-10s" href="#" class="btn btn-lg btn-round btn-theme">Get Started Now</a>
                          <a data-animation="animated fadeInUp delay-12s" href="#" class="btn btn-lg btn-round btn-white-lg-outline">Free Download</a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="slider-mover-left" aria-hidden="true">
              <i class="fa fa-angle-left"></i>
          </span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="slider-mover-right" aria-hidden="true">
              <i class="fa fa-angle-right"></i>
          </span>
      </a>
  </div>

  <!-- Search area start -->
  <div id="search-area-3" class="search-area search-area-3 d-none d-xl-block d-lg-block">
      <h2>Find Your Properties</h2>
      <div class="search-area-inner">
          <div class="search-contents">
              <form method="GET">
                  <div class="row">
                      <div class="col-md-6 col-sm-6 col-xs-6">
                          <div class="form-group">
                              <select class="selectpicker search-fields" name="brand">
                                  <option>Area From</option>
                                  <option>1500</option>
                                  <option>1200</option>
                                  <option>900</option>
                                  <option>600</option>
                                  <option>300</option>
                                  <option>100</option>
                              </select>
                          </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-6">
                          <div class="form-group">
                              <select class="selectpicker search-fields" name="make">
                                  <option>Property Status</option>
                                  <option>For Sale</option>
                                  <option>For Rent</option>
                              </select>
                          </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-6">
                          <div class="form-group">
                              <select class="selectpicker search-fields" name="location">
                                  <option>Location</option>
                                  <option>United Kingdom</option>
                                  <option>American Samoa</option>
                                  <option>Belgium</option>
                                  <option>Canada</option>
                                  <option>Delaware</option>
                              </select>
                          </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-6">
                          <div class="form-group">
                              <select class="selectpicker search-fields" name="type">
                                  <option>Property Types</option>
                                  <option>Residential</option>
                                  <option>Commercial</option>
                                  <option>Land</option>
                              </select>
                          </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-6">
                          <div class="form-group">
                              <select class="selectpicker search-fields" name="body">
                                  <option>Bedrooms</option>
                                  <option>1</option>
                                  <option>2</option>
                                  <option>3</option>
                                  <option>4</option>
                                  <option>5</option>
                                  <option>6</option>
                                  <option>7</option>
                                  <option>8</option>
                                  <option>9</option>
                              </select>
                          </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-6">
                          <div class="form-group">
                              <select class="selectpicker search-fields" name="transiction">
                                  <option>Bathrooms</option>
                                  <option>1</option>
                                  <option>2</option>
                                  <option>3</option>
                                  <option>4</option>
                              </select>
                          </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-6">
                          <div class="form-group">
                              <div class="range-slider">
                                  <div data-min="0" data-max="150000" data-unit="USD" data-min-name="min_price" data-max-name="max_price" class="range-slider-ui ui-slider" aria-disabled="false"></div>
                                  <div class="clearfix"></div>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-6 ">
                          <div class="form-group">
                              <button class="search-button btn-md btn-color">Search</button>
                          </div>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </div>
  <!-- Search area start -->
</div>
<!-- banner end -->

<!-- Search area start -->
<div class="search-area" id="search-area-1">
  <div class="container">
      <div class="search-area-inner">
          <div class="search-contents ">
              <form action="index.html" method="GET">
                  <div class="row">
                      <div class="col-6 col-lg-3 col-md-3">
                          <div class="form-group">
                              <select class="selectpicker search-fields" name="brand">
                                  <option>Area From</option>
                                  <option>1500</option>
                                  <option>1200</option>
                                  <option>900</option>
                                  <option>600</option>
                                  <option>300</option>
                                  <option>100</option>
                              </select>
                          </div>
                      </div>
                      <div class="col-6 col-lg-3 col-md-3">
                          <div class="form-group">
                              <select class="selectpicker search-fields" name="property-status">
                                  <option>Property Status</option>
                                  <option>For Sale</option>
                                  <option>For Rent</option>
                              </select>
                          </div>
                      </div>
                      <div class="col-6 col-lg-3 col-md-3">
                          <div class="form-group">
                              <select class="selectpicker search-fields" name="location">
                                  <option>Location</option>
                                  <option>United Kingdom</option>
                                  <option>American Samoa</option>
                                  <option>Belgium</option>
                                  <option>Canada</option>
                                  <option>Delaware</option>
                              </select>
                          </div>
                      </div>
                      <div class="col-6 col-lg-3 col-md-3">
                          <div class="form-group">
                              <select class="selectpicker search-fields" name="category">
                                  <option>Property Types</option>
                                  <option>Residential</option>
                                  <option>Commercial</option>
                                  <option>Land</option>
                              </select>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-6 col-lg-3 col-md-3">
                          <div class="form-group">
                              <select class="selectpicker search-fields" name="body">
                                  <option>Bedrooms</option>
                                  <option>1</option>
                                  <option>2</option>
                                  <option>3</option>
                                  <option>4</option>
                                  <option>5</option>
                                  <option>6</option>
                                  <option>7</option>
                                  <option>8</option>
                                  <option>9</option>
                              </select>
                          </div>
                      </div>
                      <div class="col-6 col-lg-3 col-md-3">
                          <div class="form-group">
                              <select class="selectpicker search-fields" name="transmission">
                                  <option>Bathrooms</option>
                                  <option>1</option>
                                  <option>2</option>
                                  <option>3</option>
                                  <option>4</option>
                              </select>
                          </div>
                      </div>
                      <div class="col-6 col-lg-3 col-md-3">
                          <div class="form-group">
                              <div class="range-slider">
                                  <div data-min="0" data-max="150000" data-unit="USD" data-min-name="min_price" data-max-name="max_price" class="range-slider-ui ui-slider" aria-disabled="false"></div>
                                  <div class="clearfix"></div>
                              </div>
                          </div>
                      </div>
                      <div class="col-6 col-lg-3 col-md-3">
                          <div class="form-group">
                              <button class="search-button btn-md btn-color" type="submit">Search</button>
                          </div>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>
<!-- Search area start -->

<!-- Featured properties start -->
<div class="featured-properties content-area-2">
  <div class="container">
      <div class="main-title">
          <h1>Featured Properties</h1>
      </div>
      <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-6 wow fadeInLeft delay-04s">
              <div class="card property-box-2">
                  <!-- property img -->
                  <div class="property-thumbnail">
                      <a href="properties-details.html" class="property-img">
                          <img src="http://placehold.it/255x170" alt="property-3" class="img-fluid">
                      </a>
                      <div class="property-overlay">
                          <a href="properties-details.html" class="overlay-link">
                              <i class="fa fa-link"></i>
                          </a>
                          <a class="overlay-link property-video" title="Test Title">
                              <i class="fa fa-video-camera"></i>
                          </a>
                          <div class="property-magnify-gallery">
                              <a href="http://placehold.it/750x540" class="overlay-link">
                                  <i class="fa fa-expand"></i>
                              </a>
                              <a href="http://placehold.it/750x540" class="hidden"></a>
                              <a href="http://placehold.it/750x540" class="hidden"></a>
                          </div>
                      </div>
                  </div>
                  <!-- detail -->
                  <div class="detail">
                      <h5 class="title"><a href="properties-details.html">Modern Family Home</a></h5>
                      <h4 class="price">
                          $567.99/Night
                      </h4>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                  </div>
              </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 wow fadeInUp delay-04s">
              <div class="card property-box-2">
                  <!-- property img -->
                  <div class="property-thumbnail">
                      <a href="properties-details.html" class="property-img">
                          <img src="http://placehold.it/255x170" alt="property-7" class="img-fluid">
                      </a>
                      <div class="property-overlay">
                          <a href="properties-details.html" class="overlay-link">
                              <i class="fa fa-link"></i>
                          </a>
                          <a class="overlay-link property-video" title="Test Title">
                              <i class="fa fa-video-camera"></i>
                          </a>
                          <div class="property-magnify-gallery">
                              <a href="http://placehold.it/750x540" class="overlay-link">
                                  <i class="fa fa-expand"></i>
                              </a>
                              <a href="http://placehold.it/750x540" class="hidden"></a>
                              <a href="http://placehold.it/750x540" class="hidden"></a>
                          </div>
                      </div>
                  </div>
                  <!-- detail -->
                  <div class="detail">
                      <h5 class="title"><a href="properties-details.html">Relaxing Apartment</a></h5>
                      <h4 class="price">
                          $567.99/Night
                      </h4>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                  </div>
              </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 wow fadeInUp delay-04s">
              <div class="card property-box-2">
                  <!-- property img -->
                  <div class="property-thumbnail">
                      <a href="properties-details.html" class="property-img">
                          <img src="http://placehold.it/255x170" alt="property-5" class="img-fluid">
                      </a>
                      <div class="property-overlay">
                          <a href="properties-details.html" class="overlay-link">
                              <i class="fa fa-link"></i>
                          </a>
                          <a class="overlay-link property-video" title="Test Title">
                              <i class="fa fa-video-camera"></i>
                          </a>
                          <div class="property-magnify-gallery">
                              <a href="http://placehold.it/750x540" class="overlay-link">
                                  <i class="fa fa-expand"></i>
                              </a>
                              <a href="http://placehold.it/750x540" class="hidden"></a>
                              <a href="http://placehold.it/750x540" class="hidden"></a>
                          </div>
                      </div>
                  </div>
                  <!-- detail -->
                  <div class="detail">
                      <h5 class="title"><a href="properties-details.html">Masons Villas</a></h5>
                      <h4 class="price">
                          $567.99/Night
                      </h4>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                  </div>
              </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 wow fadeInRight delay-04s">
              <div class="card property-box-2">
                  <!-- property img -->
                  <div class="property-thumbnail">
                      <a href="properties-details.html" class="property-img">
                          <img src="http://placehold.it/255x170" alt="property-1" class="img-fluid">
                      </a>
                      <div class="property-overlay">
                          <a href="properties-details.html" class="overlay-link">
                              <i class="fa fa-link"></i>
                          </a>
                          <a class="overlay-link property-video" title="Test Title">
                              <i class="fa fa-video-camera"></i>
                          </a>
                          <div class="property-magnify-gallery">
                              <a href="http://placehold.it/750x540" class="overlay-link">
                                  <i class="fa fa-expand"></i>
                              </a>
                              <a href="http://placehold.it/750x540" class="hidden"></a>
                              <a href="http://placehold.it/750x540" class="hidden"></a>
                          </div>
                      </div>
                  </div>
                  <!-- detail -->
                  <div class="detail">
                      <h5 class="title"><a href="properties-details.html">Sweet Family Home</a></h5>
                      <h4 class="price">
                          $567.99/Night
                      </h4>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
<!-- Featured properties end -->

<!-- Recent properties start -->
{{-- <div class="recent-properties content-area-17">
  <div class="container">
      <div class="main-title">
          <h1>Featured Properties</h1>
      </div>
      <div class="row">
          <div class="col-lg-6 col-md-6 wow fadeInLeft delay-04s">
              <div class="media property-box-3">
                  <a class="pr-3" href="properties-details.html">
                      <img src="http://placehold.it/130x130" alt="recent-property">
                  </a>
                  <div class="media-body align-self-center">
                      <h3 class="mt-0"><a href="properties-details.html">Modern Family Home</a></h3>
                      <h5>$567.99</h5>
                      <p>Lorem ipsum dolor sit amet, conse adipiscing elit. Maecenas mauris orci, pellentesque at,</p>
                  </div>
              </div>
          </div>
          <div class="col-lg-6 col-md-6 wow fadeInRight delay-04s">
              <div class="media property-box-3">
                  <a class="pr-3" href="properties-details.html">
                      <img src="http://placehold.it/130x130" alt="recent-property-2">
                  </a>
                  <div class="media-body align-self-center">
                      <h3 class="mt-0"><a href="properties-details.html">Relaxing Apartment</a></h3>
                      <h5>$567.99</h5>
                      <p>Lorem ipsum dolor sit amet, conse adipiscing elit. Maecenas mauris orci, pellentesque at,</p>
                  </div>
              </div>
          </div>
          <div class="col-lg-6 col-md-6 wow fadeInLeft delay-04s">
              <div class="media property-box-3">
                  <a class="pr-3" href="properties-details.html">
                      <img src="http://placehold.it/130x130" alt="recent-property-3">
                  </a>
                  <div class="media-body align-self-center">
                      <h3 class="mt-0"><a href="properties-details.html">Beautiful Single Home</a></h3>
                      <h5>$567.99</h5>
                      <p>Lorem ipsum dolor sit amet, conse adipiscing elit. Maecenas mauris orci, pellentesque at,</p>
                  </div>
              </div>
          </div>
          <div class="col-lg-6 col-md-6 wow fadeInRight delay-04s">
              <div class="media property-box-3">
                  <a class="pr-3" href="properties-details.html">
                      <img src="http://placehold.it/130x130" alt="recent-property-4">
                  </a>
                  <div class="media-body align-self-center">
                      <h3 class="mt-0"><a href="properties-details.html">Masons Villas</a></h3>
                      <h5>$567.99</h5>
                      <p>Lorem ipsum dolor sit amet, conse adipiscing elit. Maecenas mauris orci, pellentesque at,</p>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div> --}}
<!-- Recent properties end -->

<!-- Blog start -->
<div class="blog content-area-2">
  <div class="container">
      <div class="main-title">
          <h1>Blog</h1>
      </div>
      <div class="row">
          <div class="col-lg-4 col-md-6 wow fadeInLeft delay-04s">
              <div class="blog-grid-box">
                  <img class="blog-theme img-fluid" src="http://placehold.it/350x233" alt="property-10">
                  <div class="detail">
                      <div class="date-box">
                          <h5>03</h5>
                          <h5>May</h5>
                      </div>
                      <h3>
                          <a href="blog-single-sidebar-right.html">Buying a Home</a>
                      </h3>
                      <div class="post-meta">
                          <span><a href="#"><i class="fa fa-user"></i>John Antony</a></span>
                          <span><a href="#"><i class="fa fa-commenting-o"></i>24 Comment</a></span>
                      </div>
                      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the</p>
                      <a href="blog-single-sidebar-right.html" class="btn-read-more">Read more</a>
                  </div>
              </div>
          </div>
          <div class="col-lg-4 col-md-6 wow fadeInUp delay-04s d-none d-xl-block d-lg-block">
              <div class="blog-grid-box">
                  <img class="blog-theme img-fluid" src="http://placehold.it/350x233" alt="property-11">
                  <div class="detail">
                      <div class="date-box">
                          <h5>03</h5>
                          <h5>May</h5>
                      </div>
                      <h3>
                          <a href="blog-single-sidebar-right.html">Why Live in New York</a>
                      </h3>
                      <div class="post-meta">
                          <span><a href="#"><i class="fa fa-user"></i>John Antony</a></span>
                          <span><a href="#"><i class="fa fa-commenting-o"></i>24 Comment</a></span>
                      </div>
                      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the</p>
                      <a href="blog-single-sidebar-right.html" class="btn-read-more">Read more</a>
                  </div>
              </div>
          </div>
          <div class="col-lg-4 col-md-6 wow fadeInRight delay-04s">
              <div class="blog-grid-box">
                  <img class="blog-theme img-fluid" src="http://placehold.it/350x233" alt="property-12">
                  <div class="detail">
                      <div class="date-box">
                          <h5>03</h5>
                          <h5>May</h5>
                      </div>
                      <h3>
                          <a href="blog-single-sidebar-right.html">Selling Your Home</a>
                      </h3>
                      <div class="post-meta">
                          <span><a href="#"><i class="fa fa-user"></i>John Antony</a></span>
                          <span><a href="#"><i class="fa fa-commenting-o"></i>24 Comment</a></span>
                      </div>
                      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the</p>
                      <a href="blog-single-sidebar-right.html" class="btn-read-more">Read more</a>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
<!-- Blog end -->

@endsection