@extends('sotogrande.layout')

@section('mainsection')
<!-- Sub banner start -->
<div class="sub-banner overview-bgi">
    <div class="container">
        <div class="breadcrumb-area">
            <h1>Sale properties</h1>
            <ul class="breadcrumbs">
                <li><a href="{{ url_home($language) }}">Home</a></li>
                <li class="active">Sale properties</li>
            </ul>
        </div>
    </div>
</div>
<!-- Sub banner end -->

<!-- Properties list fullwidth start -->
<div class="properties-list-fullwidth content-area-2">
    <div class="container">
        <div class="option-bar d-none d-xl-block d-lg-block d-md-block d-sm-block">
            <div class="row clearfix">
                <div class="col-xl-4 col-lg-5 col-md-5 col-sm-5">
                    <h4>
                        <span class="heading-icon">
                            <i class="fa fa-caret-right icon-design"></i>
                            <i class="fa fa-th-large"></i>
                        </span>
                        <span class="heading">Sale properties</span>
                    </h4>
                </div>
                {{-- <div class="col-xl-8 col-lg-7 col-md-7 col-sm-7">
                    <div class="sorting-options clearfix">
                        <a href="properties-list-fullwidth.html" class="change-view-btn"><i class="fa fa-th-list"></i></a>
                        <a href="properties-grid-fullwidth.html" class="change-view-btn active-view-btn"><i class="fa fa-th-large"></i></a>
                    </div>
                    <div class="search-area">
                        <select class="selectpicker search-fields" name="location">
                            <option>High to Low</option>
                            <option>Low to High</option>
                        </select>
                    </div>
                </div> --}}
            </div>
        </div>
        <div class="subtitle">
            {{ $propertiesCount ? $propertiesCount : 0 }} Result Found
        </div>
        <div class="row">
            @foreach ($properties as $property)
              <div class="col-lg-4 col-md-6 col-sm-12">
                  <div class="property-box">
                      <div class="property-thumbnail">
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
                                    @if($property->property_status)
                                        <span class="slider-label">{{ $property->property_status->name }}</span>
                                    @endif
                                </div>
                            </div>
                          <a href="{{ url_property($property->alias, $language) }}" class="property-img">
                              {{-- <div class="tag button alt featured">Featured</div> --}}
                              {{-- <div class="price-ratings-box"> --}}
                                  {{-- <p class="price">
                                      $178,000
                                  </p> --}}
                                  {{-- <div class="ratings">
                                      <i class="fa fa-star"></i>
                                      <i class="fa fa-star"></i>
                                      <i class="fa fa-star"></i>
                                      <i class="fa fa-star"></i>
                                      <i class="fa fa-star-o"></i>
                                  </div> --}}
                              {{-- </div> --}}
                              <img src="{{ $property->imageByStatus }}" alt="property-2" class="img-fluid">
                          </a>
                          <div class="property-overlay">
                              <a href="{{ url_property($property->alias, $language) }}" class="overlay-link">
                                  <i class="fa fa-link"></i>
                              </a>
                              <div class="property-magnify-gallery">
                                  @php($iCounter = 0)
                                  @foreach($property->images as $image)
                                      @if ($iCounter == 0)
                                          <a href="{{ asset('images/data/' . $image->image) }}" class="overlay-link">
                                              <i class="fa fa-expand"></i>
                                          </a>
                                      @else
                                          <a href="{{ asset('images/data/' . $image->image) }}" class="hidden"></a>
                                      @endif
                                      @php($iCounter++)
                                  @endforeach
                              </div>
                          </div>
                      </div>
                      <div class="detail">
                          <h1 class="title">
                              <a href="{{ url_property($property->alias, $language) }}">
                                {{ $property->contentload->name }}
                              </a>
                          </h1>
                          <div class="location">
                              <a href="{{ url_property($property->alias, $language) }}">
                                  <i class="fa fa-map-marker"></i>{{ $property->prop_location->contentload->location }}
                              </a>
                          </div>
                          <div class="price">
                              @if($property->sales == 1 && $property->rentals == 1)
                                  @if($property->prices['price'])
                                      <span>{{ $property->currency->symbol}} {{ $property->prices['price'] }} Price</span>
                                  @endif
                                  @if($property->prices['week'])
                                      <span>{{ $property->currency->symbol}} {{ $property->prices['week'] }} Per Week</span>
                                  @endif
                                  @if($property->prices['month'])
                                      <span>{{ $property->currency->symbol}} {{ $property->prices['month'] }} Per Month</span>
                                  @endif
                              @elseif($property->rentals == 1)
                                  @if($property->prices['week'])
                                      <span>{{ $property->currency->symbol}} {{ $property->prices['week'] }} Per Week</span>
                                  @endif
                                  @if($property->prices['month'])
                                      <span>{{ $property->currency->symbol}} {{ $property->prices['month'] }} Per Month</span>
                                  @endif
                              @elseif($property->sales == 1)
                                  @if($property->prices['price'])
                                      <span>{{ $property->currency->symbol}} {{ $property->prices['price'] }} Price</span>
                                  @endif
                              @endif
                          </div>
                          {{-- <br> --}}
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
                      {{-- <div class="footer">
                          <a href="#">
                              <i class="fa fa-user"></i> Jhon Doe
                          </a>
                          <span>
                              <i class="fa fa-calendar-o"></i> 2 years ago
                          </span>
                      </div> --}}
                  </div>
              </div>
            @endforeach

            <div class="col-lg-12">
              {{ $properties->links() }}
                {{-- <div class="pagination-box">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="properties-grid-leftside.html"><span aria-hidden="true">«</span></a></li>
                            <li class="page-item"><a class="page-link" href="properties-grid-rightside.html">1</a></li>
                            <li class="page-item"><a class="page-link" href="properties-grid-leftside.html">2</a></li>
                            <li class="page-item"><a class="page-link active" href="properties-grid-fullwidth.html">3</a></li>
                            <li class="page-item"><a class="page-link" href="properties-grid-fullwidth.html"><span aria-hidden="true">»</span></a></li>
                        </ul>
                    </nav>
                </div> --}}
            </div>
        </div>
    </div>
</div>
<!-- Properties list fullwidth end -->
@endsection