@extends('sotogrande.layout')

@section('mainsection')

<!-- Sub banner start -->
<div class="sub-banner overview-bgi">
  <div class="container">
      <div class="breadcrumb-area">
          <h1>Properties Listing</h1>
          <ul class="breadcrumbs">
              <li><a href="{{ url_home($language) }}">Home</a></li>
              <li class="active">{{ 'Search' }}</li>
          </ul>
      </div>
  </div>
</div>
<!-- Sub banner end -->

<!-- properties list rightside start -->
<div class="properties-list-rightside content-area-2">
  <div class="container">
      <div class="row">
          <div class="col-lg-8 col-md-12">
              <div class="option-bar d-none d-xl-block d-lg-block d-md-block d-sm-block">
                  <div class="row clearfix">
                      <div class="col-xl-4 col-lg-5 col-md-5 col-sm-5">
                          <h4>
                              <span class="heading-icon">
                                  <i class="fa fa-caret-right icon-design"></i>
                                  <i class="fa fa-th-list"></i>
                              </span>
                              <span class="heading">Properties List</span>
                          </h4>
                      </div>
                      {{-- <div class="col-xl-8 col-lg-7 col-md-7 col-sm-7"> --}}
                          {{-- <div class="sorting-options clearfix">
                              <a href="properties-list-rightside.html" class="change-view-btn active-view-btn"><i class="fa fa-th-list"></i></a>
                              <a href="properties-grid-rightside.html" class="change-view-btn"><i class="fa fa-th-large"></i></a>
                          </div> --}}
                          {{-- <div class="search-area">
                              <select class="selectpicker search-fields" name="location">
                                  <option>High to Low</option>
                                  <option>Low to High</option>
                              </select>
                          </div> --}}
                      {{-- </div> --}}
                  </div>
              </div>
              <div class="subtitle">
                  {{ $propertiesCount }} Result Found
              </div>

              @if ($propertiesCount > 0)
              @foreach ($properties as $property)
                  
                <div class="property-box-5 search-property-box">
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-pad">
                                <div class="top-lables">
                                    <div class="lft">
                                        @if($property->sales == 1 && $property->rentals == 1)
                                            <span class="slider-label">Sale</span>
                                            <span class="slider-label">Rental</span>
                                        @elseif($property->rentals == 1)
                                            <span class="slider-label">Rental</span>
                                        @elseif($property->sales == 1)
                                            <span class="slider-label">Sale</span>
                                        @endif
                                    </div>
                                    <div class="rght">
                                        @if($property->property_status)
                                            <span class="slider-label">{{ $property->property_status->name }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="property-thumbnail">
                                    <a href="{{ url_property($property->alias, $language) }}" class="property-img">
                                        {{-- <div class="tag button alt featured">Featured</div> --}}
                                        {{-- <div class="price-ratings-box"> --}}
                                            {{-- <p class="price">
                                                
                                            </p> --}}
                                            {{-- <div class="ratings">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div> --}}
                                        {{-- </div> --}}
                                        <img src="{{ $property->imageByStatus }}" alt="property-1" class="img-fluid">
                                    </a>
                                    <div class="property-overlay">
                                        <a href="{{ url_property($property->alias, $language) }}" class="overlay-link">
                                            <i class="fa fa-link"></i>
                                        </a>
                                        <div class="property-magnify-gallery">
                                            @php($imgCounter = 0)
                                            @foreach($property->images as $image)
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
                            </div>
                            <div class="col-lg-7 col-md-7 align-self-center col-pad">
                                <div class="detail">
                                    <!-- title -->
                                    <h1 class="title">
                                        <a href="{{ url_property($property->alias, $language) }}">
                                            {{ $property->contentload->name }}
                                        </a>
                                    </h1>
                                    <!-- Location -->
                                    <div class="location">
                                        <a href="{{ url_property($property->alias, $language) }}">
                                            <i class="fa fa-map-marker"></i>{{ $property->prop_location->contentload->location }}
                                        </a>
                                    </div>
                                    <div>
                                        @if($property->sales == 1 && $property->rentals == 1)
                                            @if($property->prices['price'])
                                                <strong>{{ $property->currency->symbol}} {{ $property->prices['price'] }} Price</strong>
                                            @endif
                                            @if($property->prices['week'])
                                                <strong>{{ $property->currency->symbol}} {{ $property->prices['week'] }} Per Week</strong>
                                            @endif
                                            @if($property->prices['month'])
                                                <strong>{{ $property->currency->symbol}} {{ $property->prices['month'] }} Per Month</strong>
                                            @endif
                                        @elseif($property->rentals == 1)
                                            @if($property->prices['week'])
                                                <strong>{{ $property->currency->symbol}} {{ $property->prices['week'] }} Per Week</strong>
                                            @endif
                                            @if($property->prices['month'])
                                                <strong>{{ $property->currency->symbol}} {{ $property->prices['month'] }} Per Month</strong>
                                            @endif
                                        @elseif($property->sales == 1)
                                            @if($property->prices['price'])
                                                <strong>{{ $property->currency->symbol}} {{ $property->prices['price'] }} Price</strong>
                                            @endif
                                        @endif
                                    </div>
                                    <!-- Paragraph -->
                                    <p>
                                        {!! str_limit($property->contentload->description, 100, ' ...') !!}
                                    </p>
                                    <!--  Facilities list -->
                                    <ul class="facilities-list clearfix">
                                        @if ( ! empty($property['property_info']['bedrooms']))
                                            <li>
                                                <i class="flaticon-bed"></i> {{$property['property_info']['bedrooms']}} Beds
                                            </li>
                                        @endif

                                        @if ( ! empty($property['property_info']['bathrooms']))
                                            <li>
                                                <i class="flaticon-bath"></i> {{$property['property_info']['bathrooms']}} Baths
                                            </li>
                                        @endif

                                        @if ( ! empty($property['property_info']['internal_area']))
                                            <li>
                                                <i class="flaticon-square-layouting-with-black-square-in-east-area"></i> 
                                                {{ $property['property_info']['internal_area'] }} Sq mt
                                            </li>
                                        @endif
                                        {{-- <li>
                                            <i class="flaticon-car-repair"></i> 1 Garage
                                        </li> --}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
              @endforeach
              @endif
              {{-- <div class="property-box-5">
                  <div class="row">
                      <div class="col-lg-5 col-md-5 col-pad">
                          <div class="property-thumbnail">
                              <a href="properties-details.html" class="property-img">
                                  <div class="tag button alt featured">Featured</div>
                                  <div class="price-ratings-box">
                                      <p class="price">
                                          $178,000
                                      </p>
                                      <div class="ratings">
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star-o"></i>
                                      </div>
                                  </div>
                                  <img src="http://placehold.it/316x211" alt="property-1" class="img-fluid">
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
                      </div>
                      <div class="col-lg-7 col-md-7 align-self-center col-pad">
                          <div class="detail">
                              <!-- title -->
                              <h1 class="title">
                                  <a href="properties-details.html">Modern Family Home</a>
                              </h1>
                              <!-- Location -->
                              <div class="location">
                                  <a href="properties-details.html">
                                      <i class="fa fa-map-marker"></i>123 Kathal St. Tampa City,
                                  </a>
                              </div>
                              <!-- Paragraph -->
                              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt…</p>
                              <!--  Facilities list -->
                              <ul class="facilities-list clearfix">
                                  <li>
                                      <i class="flaticon-bed"></i> 3 Beds
                                  </li>
                                  <li>
                                      <i class="flaticon-bath"></i> 2 Baths
                                  </li>
                                  <li>
                                      <i class="flaticon-square-layouting-with-black-square-in-east-area"></i> Sq Ft:3400
                                  </li>
                                  <li>
                                      <i class="flaticon-car-repair"></i> 1 Garage
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="property-box-5">
                  <div class="row">
                      <div class="col-lg-5 col-md-5 col-pad">
                          <div class="property-thumbnail">
                              <a href="properties-details.html" class="property-img">
                                  <div class="tag button alt featured">Featured</div>
                                  <div class="price-ratings-box">
                                      <p class="price">
                                          $178,000
                                      </p>
                                      <div class="ratings">
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star-o"></i>
                                      </div>
                                  </div>
                                  <img src="http://placehold.it/316x211" alt="property-2" class="img-fluid">
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
                      </div>
                      <div class="col-lg-7 col-md-7 align-self-center col-pad">
                          <div class="detail">
                              <!-- title -->
                              <h1 class="title">
                                  <a href="properties-details.html">Relaxing Apartment</a>
                              </h1>
                              <!-- Location -->
                              <div class="location">
                                  <a href="properties-details.html">
                                      <i class="fa fa-map-marker"></i>123 Kathal St. Tampa City,
                                  </a>
                              </div>
                              <!-- Paragraph -->
                              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt…</p>
                              <!--  Facilities list -->
                              <ul class="facilities-list clearfix">
                                  <li>
                                      <i class="flaticon-bed"></i> 3 Beds
                                  </li>
                                  <li>
                                      <i class="flaticon-bath"></i> 2 Baths
                                  </li>
                                  <li>
                                      <i class="flaticon-square-layouting-with-black-square-in-east-area"></i> Sq Ft:3400
                                  </li>
                                  <li>
                                      <i class="flaticon-car-repair"></i> 1 Garage
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="property-box-5">
                  <div class="row">
                      <div class="col-lg-5 col-md-5 col-pad">
                          <div class="property-thumbnail">
                              <a href="properties-details.html" class="property-img">
                                  <div class="tag button alt featured">Featured</div>
                                  <div class="price-ratings-box">
                                      <p class="price">
                                          $178,000
                                      </p>
                                      <div class="ratings">
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star-o"></i>
                                      </div>
                                  </div>
                                  <img src="http://placehold.it/316x211" alt="property-3" class="img-fluid">
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
                      </div>
                      <div class="col-lg-7 col-md-7 align-self-center col-pad">
                          <div class="detail">
                              <!-- title -->
                              <h1 class="title">
                                  <a href="properties-details.html">Beautiful Single Home</a>
                              </h1>
                              <!-- Location -->
                              <div class="location">
                                  <a href="properties-details.html">
                                      <i class="fa fa-map-marker"></i>123 Kathal St. Tampa City,
                                  </a>
                              </div>
                              <!-- Paragraph -->
                              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt…</p>
                              <!--  Facilities list -->
                              <ul class="facilities-list clearfix">
                                  <li>
                                      <i class="flaticon-bed"></i> 3 Beds
                                  </li>
                                  <li>
                                      <i class="flaticon-bath"></i> 2 Baths
                                  </li>
                                  <li>
                                      <i class="flaticon-square-layouting-with-black-square-in-east-area"></i> Sq Ft:3400
                                  </li>
                                  <li>
                                      <i class="flaticon-car-repair"></i> 1 Garage
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="property-box-5">
                  <div class="row">
                      <div class="col-lg-5 col-md-5 col-pad">
                          <div class="property-thumbnail">
                              <a href="properties-details.html" class="property-img">
                                  <div class="tag button alt featured">Featured</div>
                                  <div class="price-ratings-box">
                                      <p class="price">
                                          $178,000
                                      </p>
                                      <div class="ratings">
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star-o"></i>
                                      </div>
                                  </div>
                                  <img src="http://placehold.it/316x211" alt="property-4" class="img-fluid">
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
                      </div>
                      <div class="col-lg-7 col-md-7 align-self-center col-pad">
                          <div class="detail">
                              <!-- title -->
                              <h1 class="title">
                                  <a href="properties-details.html">Real Luxury Villa</a>
                              </h1>
                              <!-- Location -->
                              <div class="location">
                                  <a href="properties-details.html">
                                      <i class="fa fa-map-marker"></i>123 Kathal St. Tampa City,
                                  </a>
                              </div>
                              <!-- Paragraph -->
                              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt…</p>
                              <!--  Facilities list -->
                              <ul class="facilities-list clearfix">
                                  <li>
                                      <i class="flaticon-bed"></i> 3 Beds
                                  </li>
                                  <li>
                                      <i class="flaticon-bath"></i> 2 Baths
                                  </li>
                                  <li>
                                      <i class="flaticon-square-layouting-with-black-square-in-east-area"></i> Sq Ft:3400
                                  </li>
                                  <li>
                                      <i class="flaticon-car-repair"></i> 1 Garage
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="property-box-5">
                  <div class="row">
                      <div class="col-lg-5 col-md-5 col-pad">
                          <div class="property-thumbnail">
                              <a href="properties-details.html" class="property-img">
                                  <div class="tag button alt featured">Featured</div>
                                  <div class="price-ratings-box">
                                      <p class="price">
                                          $178,000
                                      </p>
                                      <div class="ratings">
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star-o"></i>
                                      </div>
                                  </div>
                                  <img src="http://placehold.it/316x211" alt="property-5" class="img-fluid">
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
                      </div>
                      <div class="col-lg-7 col-md-7 align-self-center col-pad">
                          <div class="detail">
                              <!-- title -->
                              <h1 class="title">
                                  <a href="properties-details.html">Masons Villas</a>
                              </h1>
                              <!-- Location -->
                              <div class="location">
                                  <a href="properties-details.html">
                                      <i class="fa fa-map-marker"></i>123 Kathal St. Tampa City,
                                  </a>
                              </div>
                              <!-- Paragraph -->
                              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt…</p>
                              <!--  Facilities list -->
                              <ul class="facilities-list clearfix">
                                  <li>
                                      <i class="flaticon-bed"></i> 3 Beds
                                  </li>
                                  <li>
                                      <i class="flaticon-bath"></i> 2 Baths
                                  </li>
                                  <li>
                                      <i class="flaticon-square-layouting-with-black-square-in-east-area"></i> Sq Ft:3400
                                  </li>
                                  <li>
                                      <i class="flaticon-car-repair"></i> 1 Garage
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="property-box-5">
                  <div class="row">
                      <div class="col-lg-5 col-md-5 col-pad">
                          <div class="property-thumbnail">
                              <a href="properties-details.html" class="property-img">
                                  <div class="tag button alt featured">Featured</div>
                                  <div class="price-ratings-box">
                                      <p class="price">
                                          $178,000
                                      </p>
                                      <div class="ratings">
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star-o"></i>
                                      </div>
                                  </div>
                                  <img src="http://placehold.it/316x211" alt="property-6" class="img-fluid">
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
                      </div>
                      <div class="col-lg-7 col-md-7 align-self-center col-pad">
                          <div class="detail">
                              <!-- title -->
                              <h1 class="title">
                                  <a href="properties-details.html">Sweet Family Home</a>
                              </h1>
                              <!-- Location -->
                              <div class="location">
                                  <a href="properties-details.html">
                                      <i class="fa fa-map-marker"></i>123 Kathal St. Tampa City,
                                  </a>
                              </div>
                              <!-- Paragraph -->
                              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt…</p>
                              <!--  Facilities list -->
                              <ul class="facilities-list clearfix">
                                  <li>
                                      <i class="flaticon-bed"></i> 3 Beds
                                  </li>
                                  <li>
                                      <i class="flaticon-bath"></i> 2 Baths
                                  </li>
                                  <li>
                                      <i class="flaticon-square-layouting-with-black-square-in-east-area"></i> Sq Ft:3400
                                  </li>
                                  <li>
                                      <i class="flaticon-car-repair"></i> 1 Garage
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="property-box-5">
                  <div class="row">
                      <div class="col-lg-5 col-md-5 col-pad">
                          <div class="property-thumbnail">
                              <a href="properties-details.html" class="property-img">
                                  <div class="tag button alt featured">Featured</div>
                                  <div class="price-ratings-box">
                                      <p class="price">
                                          $178,000
                                      </p>
                                      <div class="ratings">
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star-o"></i>
                                      </div>
                                  </div>
                                  <img src="http://placehold.it/316x211" alt="property-7" class="img-fluid">
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
                      </div>
                      <div class="col-lg-7 col-md-7 align-self-center col-pad">
                          <div class="detail">
                              <!-- title -->
                              <h1 class="title">
                                  <a href="properties-details.html">Masons Villas</a>
                              </h1>
                              <!-- Location -->
                              <div class="location">
                                  <a href="properties-details.html">
                                      <i class="fa fa-map-marker"></i>123 Kathal St. Tampa City,
                                  </a>
                              </div>
                              <!-- Paragraph -->
                              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt…</p>
                              <!--  Facilities list -->
                              <ul class="facilities-list clearfix">
                                  <li>
                                      <i class="flaticon-bed"></i> 3 Beds
                                  </li>
                                  <li>
                                      <i class="flaticon-bath"></i> 2 Baths
                                  </li>
                                  <li>
                                      <i class="flaticon-square-layouting-with-black-square-in-east-area"></i> Sq Ft:3400
                                  </li>
                                  <li>
                                      <i class="flaticon-car-repair"></i> 1 Garage
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="property-box-5">
                  <div class="row">
                      <div class="col-lg-5 col-md-5 col-pad">
                          <div class="property-thumbnail">
                              <a href="properties-details.html" class="property-img">
                                  <div class="tag button alt featured">Featured</div>
                                  <div class="price-ratings-box">
                                      <p class="price">
                                          $178,000
                                      </p>
                                      <div class="ratings">
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star-o"></i>
                                      </div>
                                  </div>
                                  <img src="http://placehold.it/316x211" alt="property-8" class="img-fluid">
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
                      </div>
                      <div class="col-lg-7 col-md-7 align-self-center col-pad">
                          <div class="detail">
                              <!-- title -->
                              <h1 class="title">
                                  <a href="properties-details.html">Big Head House</a>
                              </h1>
                              <!-- Location -->
                              <div class="location">
                                  <a href="properties-details.html">
                                      <i class="fa fa-map-marker"></i>123 Kathal St. Tampa City,
                                  </a>
                              </div>
                              <!-- Paragraph -->
                              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt…</p>
                              <!--  Facilities list -->
                              <ul class="facilities-list clearfix">
                                  <li>
                                      <i class="flaticon-bed"></i> 3 Beds
                                  </li>
                                  <li>
                                      <i class="flaticon-bath"></i> 2 Baths
                                  </li>
                                  <li>
                                      <i class="flaticon-square-layouting-with-black-square-in-east-area"></i> Sq Ft:3400
                                  </li>
                                  <li>
                                      <i class="flaticon-car-repair"></i> 1 Garage
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="property-box-5">
                  <div class="row">
                      <div class="col-lg-5 col-md-5 col-pad">
                          <div class="property-thumbnail">
                              <a href="properties-details.html" class="property-img">
                                  <div class="tag button alt featured">Featured</div>
                                  <div class="price-ratings-box">
                                      <p class="price">
                                          $178,000
                                      </p>
                                      <div class="ratings">
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star-o"></i>
                                      </div>
                                  </div>
                                  <img src="http://placehold.it/316x211" alt="property-9" class="img-fluid">
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
                      </div>
                      <div class="col-lg-7 col-md-7 align-self-center col-pad">
                          <div class="detail">
                              <!-- title -->
                              <h1 class="title">
                                  <a href="properties-details.html">Park avenue</a>
                              </h1>
                              <!-- Location -->
                              <div class="location">
                                  <a href="properties-details.html">
                                      <i class="fa fa-map-marker"></i>123 Kathal St. Tampa City,
                                  </a>
                              </div>
                              <!-- Paragraph -->
                              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt…</p>
                              <!--  Facilities list -->
                              <ul class="facilities-list clearfix">
                                  <li>
                                      <i class="flaticon-bed"></i> 3 Beds
                                  </li>
                                  <li>
                                      <i class="flaticon-bath"></i> 2 Baths
                                  </li>
                                  <li>
                                      <i class="flaticon-square-layouting-with-black-square-in-east-area"></i> Sq Ft:3400
                                  </li>
                                  <li>
                                      <i class="flaticon-car-repair"></i> 1 Garage
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="property-box-5">
                  <div class="row">
                      <div class="col-lg-5 col-md-5 col-pad">
                          <div class="property-thumbnail">
                              <a href="properties-details.html" class="property-img">
                                  <div class="tag button alt featured">Featured</div>
                                  <div class="price-ratings-box">
                                      <p class="price">
                                          $178,000
                                      </p>
                                      <div class="ratings">
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star-o"></i>
                                      </div>
                                  </div>
                                  <img src="http://placehold.it/316x211" alt="property-3" class="img-fluid">
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
                      </div>
                      <div class="col-lg-7 col-md-7 align-self-center col-pad">
                          <div class="detail">
                              <!-- title -->
                              <h1 class="title">
                                  <a href="properties-details.html">Luxury Villa</a>
                              </h1>
                              <!-- Location -->
                              <div class="location">
                                  <a href="properties-details.html">
                                      <i class="fa fa-map-marker"></i>123 Kathal St. Tampa City,
                                  </a>
                              </div>
                              <!-- Paragraph -->
                              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt…</p>
                              <!--  Facilities list -->
                              <ul class="facilities-list clearfix">
                                  <li>
                                      <i class="flaticon-bed"></i> 3 Beds
                                  </li>
                                  <li>
                                      <i class="flaticon-bath"></i> 2 Baths
                                  </li>
                                  <li>
                                      <i class="flaticon-square-layouting-with-black-square-in-east-area"></i> Sq Ft:3400
                                  </li>
                                  <li>
                                      <i class="flaticon-car-repair"></i> 1 Garage
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>
              </div> --}}
              @if ($propertiesCount > 0)
                {{ $properties->links() }}
              @endif
          </div>
          <div class="col-lg-4 col-md-12">
              <div class="sidebar mbl">
                  <!-- Search area start -->
                  <div class="widget search-area">
                      <h5 class="sidebar-title">Search</h5>
                      <div class="search-area-inner">
                          <div class="search-contents ">
                              <form method="GET">
                                  <div class="form-group">
                                        <label>Property Status</label>
                                        <select 
                                          class="selectpicker search-fields" 
                                          name="property-status"
                                          data-search-property-status
                                        >
                                            <option value="all">All</option>
                                            <option 
                                                value="sale" 
                                                {{ request('status') == 'sale' ? 'selected' : '' }}
                                            >
                                                For Sale
                                            </option>
                                            <option 
                                                value="rent"
                                                {{ request('status') == 'rent' ? 'selected' : '' }}
                                            >
                                                For Rent
                                            </option>
                                        </select>
                                  </div>
                                  <div class="form-group">
                                        <label>Property Type</label>
                                        <select 
                                            class="selectpicker search-fields" 
                                            name="category"
                                            data-search-property-type
                                        >
                                            <option value="all">All</option>
                                            @foreach ($categories as $category)
                                                <option
                                                    {{ request('type') == $category->contentload->name ? 'selected' : '' }}
                                                >
                                                    {{ $category->contentload->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                  </div>
                                  <div class="form-group">
                                        <label>Location</label>
                                        <select 
                                          class="selectpicker search-fields" 
                                          name="location"
                                          data-search-property-location
                                        >
                                              <option value="all">All</option>
                                              @foreach ($locations as $location)
                                                  <option
                                                    {{ request('location') == $location->contentload->location ? 'selected' : '' }}
                                                  >
                                                    {{ $location->contentload->location }}
                                                  </option>
                                              @endforeach
                                        </select>
                                  </div>
                                    <div class="form-group rooms-filter">
                                        <label class="beds-label">Beds</label>
                                        <div class="beds-radio">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <div class="bed-input-block">
                                                    <input 
                                                        value="{{ $i }}" 
                                                        type="radio" 
                                                        id="{{ $i }}-plus-bed" 
                                                        name="radio-bed"
                                                        data-search-property-bed="{{ $i }}"
                                                        data-search-property-bed-selected="false"
                                                    >
                                                    <label for="{{$i}}-plus-bed" data-bed="{{ $i }}">
                                                        <span class="bed-text">{{ $i }}+</span>
                                                    </label>
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                  
                                  <br>
                                  <div class="form-group" data-search-property-price>
                                        <label>Price</label>
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
                                <div class="form-group">
                                    <input class="form-control" 
                                        placeholder="Search by reference" 
                                        type="search" 
                                        name="reference"
                                        data-search-property-reference
                                        value="{{ request('reference') ? request('reference') : '' }}"
                                    >
                                </div>
                                <br>
                                <button class="search-button btn-md btn-color" data-search-submit>Search</button>
                              </form>
                          </div>
                      </div>
                  </div>

                  <!-- Recent posts start -->
                  @if( ! empty($recent_properties))
                    <div class="widget recent-posts">
                        <h5 class="sidebar-title">Recent Properties</h5>
                        @foreach ($recent_properties as $property)
                            <div class="media mb-4">
                                <a class="pr-4" href="{{ url_property($property->alias, $language) }}">
                                    <img src="{{ $property->imageByStatus }}" alt="sub-property">
                                </a>
                                <div class="media-body align-self-center">
                                    <h5>
                                        <a href="{{ url_property($property->alias, $language) }}">
                                            {{ $property->contentload->name }}
                                        </a>
                                    </h5>
                                    <p>{{ \Carbon\Carbon::parse($property['created_at'])->format('M d, Y') }}</p>
                                    <p>
                                        @if($property->sales == 1 && $property->rentals == 1)
                                            @if($property->prices['price'])
                                                <strong>{{ $property->currency->symbol}} {{ $property->prices['price'] }} Price</strong>
                                            @endif
                                            @if($property->prices['week'])
                                                <strong>{{ $property->currency->symbol}} {{ $property->prices['week'] }} Per Week</strong>
                                            @endif
                                            @if($property->prices['month'])
                                                <strong>{{ $property->currency->symbol}} {{ $property->prices['month'] }} Per Month</strong>
                                            @endif
                                        @elseif($property->rentals == 1)
                                            @if($property->prices['week'])
                                                <strong>{{ $property->currency->symbol}} {{ $property->prices['week'] }} Per Week</strong>
                                            @endif
                                            @if($property->prices['month'])
                                                <strong>{{ $property->currency->symbol}} {{ $property->prices['month'] }} Per Month</strong>
                                            @endif
                                        @elseif($property->sales == 1)
                                            @if($property->prices['price'])
                                                <strong>{{ $property->currency->symbol}} {{ $property->prices['price'] }} Price</strong>
                                            @endif
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @endforeach
                        {{-- <div class="media mb-4">
                            <a class="pr-4" href="properties-details.html">
                                <img src="http://placehold.it/75x75" alt="sub-property-2">
                            </a>
                            <div class="media-body align-self-center">
                                <h5>
                                    <a href="properties-details.html">Sweet Family Home</a>
                                </h5>
                                <p>February 27, 2018</p>
                                <p> <strong>$245,000</strong></p>
                            </div>
                        </div>
                        <div class="media">
                            <a class="pr-4" href="properties-details.html">
                                <img src="http://placehold.it/75x75" alt="sub-property-3">
                            </a>
                            <div class="media-body align-self-center">
                                <h5>
                                    <a href="properties-details.html">Real Luxury Villa</a>
                                </h5>
                                <p>February 27, 2018</p>
                                <p> <strong>$245,000</strong></p>
                            </div>
                        </div> --}}
                    </div>
                  @endif
              </div>
          </div>
      </div>
  </div>
</div>
<!-- properties list rightside end -->

@endsection