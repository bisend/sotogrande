@extends('sotogrande.layout')

@section('mainsection')

<!-- Banner start -->
@if ( ! empty($slider))
    <div class="banner banner-bg" id="particles-banner-wrapper">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">  
        <div class="carousel-inner">
            @php($sliderCounter = 0)
            @foreach ($slider as $slide)
            <div class="carousel-item item-bg {{ $sliderCounter == 0 ? 'active' : ''}}">
                    <div class="slider-image-bg" style="background-image: url({{ $slide->imageByStatus }})"></div>
                    <div id="particles-banner-{{$sliderCounter}}" data-particles></div>
                    <div class="search-area search-area-3 d-xl-block d-lg-block">
                        <div class="slider-property-price">
                            <div>
                                @if($slide->sales == 1 && $slide->rentals == 1)
                                    @if($slide->prices['price'])
                                        <span>{{ $slide->currency->symbol}} {{ $slide->prices['price'] }} Price</span>
                                    @endif
                                    @if($slide->prices['week'])
                                        <span>{{ $slide->currency->symbol}} {{ $slide->prices['week'] }} Per Week</span>
                                    @endif
                                    @if($slide->prices['month'])
                                        <span>{{ $slide->currency->symbol}} {{ $slide->prices['month'] }} Per Month</span>
                                    @endif
                                @elseif($slide->rentals == 1)
                                    @if($slide->prices['week'])
                                        <span>{{ $slide->currency->symbol}} {{ $slide->prices['week'] }} Per Week</span>
                                    @endif
                                    @if($slide->prices['month'])
                                        <span>{{ $slide->currency->symbol}} {{ $slide->prices['month'] }} Per Month</span>
                                    @endif
                                @elseif($slide->sales == 1)
                                    @if($slide->prices['price'])
                                        <span>{{ $slide->currency->symbol}} {{ $slide->prices['price'] }} Price</span>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <h2>{{ $slide->contentload->name }}</h2>
                                {!! str_limit($slide->contentload->description, 200, ' ...') !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                @if($slide->property_info['bedrooms'])
                                    <div class="slider-icon-block"><i class="fa fa-bed"></i>{{ $slide->property_info['bedrooms'] }}</div>
                                @endif
                                @if($slide->property_info['internal_area'])
                                    <div class="slider-icon-block"><i class="fa fa-expand"></i>{{ $slide->property_info['internal_area'] }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="row mt-4 mb-2">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <a href="{{ route('property.show', ['language' => $language, 'alias' => $slide->alias]) }}" 
                                        class="search-button btn-md btn-color"
                                    >
                                        View details
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                @if($slide->sales == 1 && $slide->rentals == 1)
                                    <span class="slider-label">Sale</span>
                                    <span class="slider-label">Rental</span>
                                @elseif($slide->rentals == 1)
                                    <span class="slider-label">Rental</span>
                                @elseif($slide->sales == 1)
                                    <span class="slider-label">Sale</span>
                                @endif
                                @if($slide->property_status)
                                    <span class="slider-label">{{ $slide->property_status->name }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{-- <img class="d-block img-fluid" src="{{ $slide->imageByStatus }}" alt="slide"> --}}
                    {{-- <div class="carousel-caption banner-slider-inner d-flex h-100 text-left"> --}}
                        {{-- <div class="carousel-content container"> --}}
                            {{-- <div class="text-left max-w">
                                <h3 data-animation="animated fadeInDown delay-05s">We love make things <br/>amazing and simple</h3>
                                <p data-animation="animated fadeInUp delay-10s">
                                    This is real estate website template based on Bootstrap 4 framework.
                                </p>
                                <a data-animation="animated fadeInUp delay-10s" href="#" class="btn btn-lg btn-round btn-theme">Get Started Now</a>
                                <a data-animation="animated fadeInUp delay-12s" href="#" class="btn btn-lg btn-round btn-white-lg-outline">Free Download</a>
                            </div> --}}
                        {{-- </div> --}}
                    {{-- </div> --}}
                </div>
                @php($sliderCounter++)
            @endforeach
            {{-- <div class="carousel-item item-bg active">
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
            </div> --}}
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
    {{-- <div id="search-area-3" class="search-area search-area-3 d-none d-xl-block d-lg-block">
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
    </div> --}}
    <!-- Search area start -->
    </div>
@endif
<!-- banner end -->

<!-- Search area start -->
<div class="search-area" id="search-area-1">
  <div class="container">
      <div class="search-area-inner">
          <div class="search-contents ">
              <form action="index.html" method="GET">
                  <div class="row">
                      {{-- <div class="col-6 col-lg-3 col-md-3">
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
                      </div> --}}
                      <div class="col-6 col-lg-3 col-md-3">
                          <div class="form-group">
                              <label>Property Status</label>
                              <select class="selectpicker search-fields" name="property-status">
                                  <option value="all">All</option>
                                  <option value="sale">For Sale</option>
                                  <option value="rent">For Rent</option>
                              </select>
                          </div>
                      </div>
                      <div class="col-6 col-lg-3 col-md-3">
                        <div class="form-group">
                            <label>Property Type</label>
                            <select class="selectpicker search-fields" name="category">
                                <option value="all">All</option>
                                @foreach ($categories as $category)
                                    <option>{{ $category->contentload->name }}</option>
                                @endforeach
                              </select>
                        </div>
                      </div>
                      <div class="col-6 col-lg-3 col-md-3">
                          <div class="form-group">
                              <label>Location</label>
                              <select class="selectpicker search-fields" name="location">
                                    <option value="all">All</option>
                                    @foreach ($locations as $location)
                                        <option>{{ $location->contentload->location }}</option>
                                    @endforeach
                              </select>
                          </div>
                      </div>
                      <div class="col-6 col-lg-3 col-md-3 rooms-filter">
                        <div class="form-group">
                            <label class="beds-label">Beds</label>
                            <div class="beds-radio">
                                @for ($i = 1; $i <= 5; $i++)
                                    <div class="bed-input-block">
                                        <input value="{{$i}}" type="radio" id="{{$i}}-plus-bed" name="radio-bed">
                                        <label for="{{$i}}-plus-bed" data-bed="{{$i}}">
                                            <span class="bed-text">{{$i}}+</span>
                                        </label>
                                    </div>
                                @endfor
                            </div>
                        </div>
                      </div>
                  </div>
                  <div class="row">
                      {{-- <div class="col-6 col-lg-3 col-md-3">
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
                      </div> --}}
                      <div class="col-6 col-lg-3 col-md-3">
                        <div class="form-group">
                            <div class="range-slider">
                                <div 
                                    data-min="{{ $minPrice }}" 
                                    data-max="{{ $maxPrice }}" 
                                    data-unit="€" 
                                    data-min-name="min_price" 
                                    data-max-name="max_price" 
                                    class="range-slider-ui ui-slider" 
                                    aria-disabled="false"
                                ></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                      </div>
                      <div class="col-6 col-lg-3 col-md-3">
                        <div class="form-group">
                            <input class="form-control" 
                                placeholder="Search by reference" 
                                type="search" 
                                name="reference"
                            >
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
          <div class="col-sm-12 col-md-6 col-lg-6 wow fadeInLeft delay-04s">
              <div class="module-header">
                  <h2>Sales</h2>
              </div>
              <div class="row">
                  @if ( ! empty($sale_properties))
                    @foreach ($sale_properties as $sale_property)
                        <div class="col-lg-12 col-md-12">
                            <div class="top-lables">
                                <div class="lft">
                                    <span class="slider-label">Sale</span>
                                    {{-- @if($sale_property->sales == 1 && $sale_property->rentals == 1)
                                        <span class="slider-label">Rental</span>
                                    @elseif($sale_property->rentals == 1)
                                        <span class="slider-label">Rental</span>
                                    @elseif($sale_property->sales == 1)
                                        <span class="slider-label">Sale</span>
                                    @endif --}}
                                </div>
                                <div class="rght">
                                    @if($sale_property->property_status)
                                        <span class="slider-label">{{ $sale_property->property_status->name }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="card property-box-2">
                                <!-- property img -->
                                <div class="property-thumbnail">
                                    <a href="{{ route('property.show', ['language' => $language, 'alias' => $sale_property->alias]) }}" class="property-img">
                                        <img src="{{ $sale_property->imageByStatus }}" alt="property-3" class="img-fluid">
                                    </a>
                                    <div class="property-overlay">
                                        <a 
                                            href="{{ route('property.show', ['language' => $language, 'alias' => $sale_property->alias]) }}" 
                                            class="overlay-link"
                                        >
                                            <i class="fa fa-link"></i>
                                        </a>
                                        <div class="property-magnify-gallery">
                                            @php($imgCounter = 0)
                                            @foreach($sale_property->images as $image)
                                                @if ($imgCounter == 0)
                                                    <a href="{{ asset('images/data/' . $image->image) }}" class="overlay-link">
                                                        <i class="fa fa-expand"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ asset('images/data/' . $image->image) }}" class="hidden"></a>
                                                @endif
                                                @php($imgCounter++)
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <!-- detail -->
                                <div class="detail">
                                    <h5 class="title">
                                        <a href="{{ route('property.show', ['language' => $language, 'alias' => $sale_property->alias]) }}">
                                            {{ $sale_property->contentload->name }}
                                        </a>
                                    </h5>
                                    <h4 class="price">
                                        @if($sale_property->sales == 1 && $sale_property->rentals == 1)
                                            @if($sale_property->prices['price'])
                                                <span>{{ $sale_property->currency->symbol}} {{ $sale_property->prices['price'] }} Price</span>
                                            @endif
                                            @if($sale_property->prices['week'])
                                                <span>{{ $sale_property->currency->symbol}} {{ $sale_property->prices['week'] }} Per Week</span>
                                            @endif
                                            @if($sale_property->prices['month'])
                                                <span>{{ $sale_property->currency->symbol}} {{ $sale_property->prices['month'] }} Per Month</span>
                                            @endif
                                        @elseif($sale_property->rentals == 1)
                                            @if($sale_property->prices['week'])
                                                <span>{{ $sale_property->currency->symbol}} {{ $sale_property->prices['week'] }} Per Week</span>
                                            @endif
                                            @if($sale_property->prices['month'])
                                                <span>{{ $sale_property->currency->symbol}} {{ $sale_property->prices['month'] }} Per Month</span>
                                            @endif
                                        @elseif($sale_property->sales == 1)
                                            @if($sale_property->prices['price'])
                                                <span>{{ $sale_property->currency->symbol}} {{ $sale_property->prices['price'] }} Price</span>
                                            @endif
                                        @endif
                                    </h4>
                                    <p>
                                        {!! str_limit($sale_property->contentload->description, 100, ' ...') !!}
                                    </p>
                                    <div class="sale-rent-icon-block">
                                        <div class="icon-block">
                                            <i class="fa fa-home" aria-hidden="true"></i></i>{{ $sale_property->category->contentDefault->name }}
                                        </div>
                                        @if($sale_property->property_info['bedrooms'])
                                            <div class="icon-block">
                                                <i class="fa fa-bed"></i>{{ $sale_property->property_info['bedrooms'] }}
                                            </div>
                                        @endif
                                        @if($sale_property->property_info['internal_area'])
                                            <div class="icon-block">
                                                <i class="fa fa-expand"></i>{{ $sale_property->property_info['internal_area'] }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                  @endif
              </div>
          </div>
          <div class="col-sm-12 col-md-6 col-lg-6 wow fadeInRight delay-04s">
                <div class="module-header">
                    <h2>Rentals</h2>
                </div>
                <div class="row">
                    @if ( ! empty($rent_properties))
                        @foreach ($rent_properties as $rent_property)
                        <div class="col-lg-12 col-md-12">
                            <div class="top-lables">
                                <div class="lft">
                                    <span class="slider-label">Rental</span>
                                    {{-- @if($rent_property->sales == 1 && $rent_property->rentals == 1)
                                        <span class="slider-label">Sale</span>
                                    @elseif($rent_property->rentals == 1)
                                        <span class="slider-label">Rental</span>
                                    @elseif($rent_property->sales == 1)
                                        <span class="slider-label">Sale</span>
                                    @endif --}}
                                </div>
                                <div class="rght">
                                    @if($rent_property->property_status)
                                        <span class="slider-label">{{ $rent_property->property_status->name }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="card property-box-2">
                                <!-- property img -->
                                <div class="property-thumbnail">
                                    <a href="{{ route('property.show', ['language' => $language, 'alias' => $rent_property->alias]) }}" class="property-img">
                                        <img src="{{ $rent_property->imageByStatus }}" alt="property-3" class="img-fluid">
                                    </a>
                                    <div class="property-overlay">
                                        <a 
                                            href="{{ route('property.show', ['language' => $language, 'alias' => $rent_property->alias]) }}" 
                                            class="overlay-link"
                                        >
                                            <i class="fa fa-link"></i>
                                        </a>
                                        <div class="property-magnify-gallery">
                                            @php($imgCounter = 0)
                                            @foreach($rent_property->images as $image)
                                                @if ($imgCounter == 0)
                                                    <a href="{{ asset('images/data/' . $image->image) }}" class="overlay-link">
                                                        <i class="fa fa-expand"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ asset('images/data/' . $image->image) }}" class="hidden"></a>
                                                @endif
                                                @php($imgCounter++)
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <!-- detail -->
                                <div class="detail">
                                    <h5 class="title">
                                        <a href="{{ route('property.show', ['language' => $language, 'alias' => $rent_property->alias]) }}">
                                            {{ $rent_property->contentload->name }}
                                        </a>
                                    </h5>
                                    <h4 class="price">
                                        @if($rent_property->sales == 1 && $rent_property->rentals == 1)
                                            @if($rent_property->prices['price'])
                                                <span>{{ $rent_property->currency->symbol}} {{ $rent_property->prices['price'] }} Price</span>
                                            @endif
                                            @if($rent_property->prices['week'])
                                                <span>{{ $rent_property->currency->symbol}} {{ $rent_property->prices['week'] }} Per Week</span>
                                            @endif
                                            @if($rent_property->prices['month'])
                                                <span>{{ $rent_property->currency->symbol}} {{ $rent_property->prices['month'] }} Per Month</span>
                                            @endif
                                        @elseif($rent_property->rentals == 1)
                                            @if($rent_property->prices['week'])
                                                <span>{{ $rent_property->currency->symbol}} {{ $rent_property->prices['week'] }} Per Week</span>
                                            @endif
                                            @if($rent_property->prices['month'])
                                                <span>{{ $rent_property->currency->symbol}} {{ $rent_property->prices['month'] }} Per Month</span>
                                            @endif
                                        @elseif($rent_property->sales == 1)
                                            @if($rent_property->prices['price'])
                                                <span>{{ $rent_property->currency->symbol}} {{ $rent_property->prices['price'] }} Price</span>
                                            @endif
                                        @endif
                                    </h4>
                                    <p>
                                        {!! str_limit($rent_property->contentload->description, 100, ' ...') !!}
                                    </p>
                                    <div class="sale-rent-icon-block">
                                        <div class="icon-block">
                                                <i class="fa fa-home" aria-hidden="true"></i></i>{{ $rent_property->category->contentDefault->name }}
                                        </div>
                                        @if($rent_property->property_info['bedrooms'])
                                            <div class="icon-block">
                                                <i class="fa fa-bed"></i>{{ $rent_property->property_info['bedrooms'] }}
                                            </div>
                                        @endif
                                        @if($rent_property->property_info['internal_area'])
                                            <div class="icon-block">
                                                <i class="fa fa-expand"></i>{{ $rent_property->property_info['internal_area'] }}
                                            </div>
                                        @endif
                                        </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
          {{-- <div class="col-lg-3 col-md-6 col-sm-6 wow fadeInLeft delay-04s">
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
          </div> --}}
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
@if ( ! empty($posts))
    <div class="blog content-area-2">
    <div class="container">
        <div class="main-title">
            <h2>Blog</h2>
        </div>
        <div class="row">
            @php($postCounter = 0)
            @foreach ($posts as $last_post)
                @if($postCounter == 0)
                    <div class="col-lg-4 col-md-6 wow fadeInLeft delay-04s">
                @elseif($postCounter == 1)
                    <div class="col-lg-4 col-md-6 wow fadeInUp delay-04s d-none d-xl-block d-lg-block">
                @else
                    <div class="col-lg-4 col-md-6 wow fadeInRight delay-04s">
                @endif
                    <div class="blog-grid-box">
                        <img class="blog-theme img-fluid" src="{{ isset($last_post->image) ? url('/').$last_post->image : URL::asset('images/no_image.jpg')}}" alt="property-10">
                        <div class="detail">
                            <div class="date-box">
                                <h5>{{ \Carbon\Carbon::parse($last_post['created_at'])->format('d') }}</h5>
                                <h5>{{ \Carbon\Carbon::parse($last_post['created_at'])->format('M') }}</h5>
                            </div>
                            <h3>
                                <a href="{{ route('blog.show', ['language' => $language, 'alias' => $last_post->alias]) }}">{{ $last_post->contentload->title }}</a>
                            </h3>
                            {{-- <div class="post-meta"> --}}
                                {{-- <span><a href="#"><i class="fa fa-user"></i>John Antony</a></span> --}}
                                {{-- <span><a href="#"><i class="fa fa-commenting-o"></i>24 Comment</a></span> --}}
                            {{-- </div> --}}
                            <p>
                                {!! str_limit($last_post->contentload->content, 100, ' ...') !!}
                            </p>
                            <a href="{{ route('blog.show', ['language' => $language, 'alias' => $last_post->alias]) }}" class="btn-read-more">Read more</a>
                        </div>
                    </div>
                </div>
                @php($postCounter++)
            @endforeach
            {{-- <div class="col-lg-4 col-md-6 wow fadeInUp delay-04s d-none d-xl-block d-lg-block">
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
            </div> --}}
        </div>
    </div>
    </div>
@endif
<!-- Blog end -->

@endsection