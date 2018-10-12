@extends('sotogrande.layout')

@section('mainsection')

<input type="hidden" data-property-reference value="{{ $property->property_info['property_reference'] }}">

<!-- Sub banner start -->
<div class="sub-banner overview-bgi">
    <div class="container">
        <div class="breadcrumb-area">
            <h1>{{ $property->contentload->name }}</h1>
            <ul class="breadcrumbs">
                <li><a href="{{ url_home($language) }}">Home</a></li>
                <li class="active">{{ $property->contentload->name }}</li>
            </ul>
        </div>
    </div>
</div>
<!-- Sub banner end -->

<!-- Properties details page start -->
<div class="properties-details-page content-area-15">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div id="propertiesDetailsSlider" class="carousel properties-details-sliders slide mb-60">
                    <div class="heading-properties">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pull-left">
                                    <h3>{{ $property->contentload->name }}</h3>
                                    <p><i class="fa fa-map-marker"></i> {{ $property->prop_location->contentload->location }}</p>
                                </div>
                                <div class="p-r">
                                    <h3> 
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
                                  </h3>
                                    {{-- <p><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></p> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- main slider carousel items -->
                    <div class="carousel-inner">
                        @php($imageCounter = 0)
                        @if ($property->images->count() > 0)
                            @foreach ($property->images as $image)
                            <div class="{{ $imageCounter == 0 ? 'active' : '' }} item carousel-item" data-slide-number="{{$imageCounter}}">
                                <div class="eq-slider">
                                <img src="{{ asset('images/data/' . $image->image) }}" class="img-fluid" alt="blog-2">

                                </div>
                            </div>
                            @php($imageCounter++) 
                            @endforeach
                        @else
                            <div class="{{ $imageCounter == 0 ? 'active' : '' }} item carousel-item" data-slide-number="{{$imageCounter}}">
                                <div class="eq-slider">
                                    <img src="{{ $property->imageByStatus }}" class="img-fluid" alt="blog-2">
                                </div>
                            </div>
                        @endif
                        <a class="carousel-control left" href="#propertiesDetailsSlider" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                        <a class="carousel-control right" href="#propertiesDetailsSlider" data-slide="next"><i class="fa fa-angle-right"></i></a>
                    </div>
                    <!-- main slider carousel nav controls -->
                    <ul class="carousel-indicators smail-properties list-inline nav nav-justified ">
                        @php($imgCounter = 0)
                        @if ($property->images->count() > 0)
                            @foreach ($property->images as $image)
                            <li class="list-inline-item {{ $imgCounter == 0 ? 'active' : '' }}">
                                <a id="carousel-selector-{{$imgCounter}}" class="selected" data-slide-to="{{$imgCounter}}" data-target="#propertiesDetailsSlider">
                                    <img src="{{ asset('images/data/' . $image->image) }}" class="img-fluid" alt="blog-3">
                                </a>
                            </li>
                            @php($imgCounter++)
                            @endforeach
                        @else
                            <li class="list-inline-item {{ $imgCounter == 0 ? 'active' : '' }}">
                                <a id="carousel-selector-{{$imgCounter}}" class="selected" data-slide-to="{{$imgCounter}}" data-target="#propertiesDetailsSlider">
                                    <img src="{{ $property->imageByStatus }}" class="img-fluid" alt="blog-3">
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-12 slider">
                <!-- Search area start -->
                {{-- <div class="widget-2 search-area d-lg-none d-xl-none">
                    <h5 class="sidebar-title">Advanced Search</h5>
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
                </div> --}}
                <!-- Tabbing box start -->
                <div class="tabbing tabbing-box mb-60">
                    <ul class="nav nav-tabs" id="carTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show" id="one-tab" data-toggle="tab" href="#one" role="tab" aria-controls="one" aria-selected="false">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="two-tab" data-toggle="tab" href="#two" role="tab" aria-controls="two" aria-selected="false">Attachments</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" id="three-tab" data-toggle="tab" href="#three" role="tab" aria-controls="three" aria-selected="true">Details</a>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a class="nav-link" id="4-tab" data-toggle="tab" href="#4" role="tab" aria-controls="4" aria-selected="true">Video</a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link" id="5-tab" data-toggle="tab" href="#5" role="tab" aria-controls="5" aria-selected="true">Location</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="6-tab" data-toggle="tab" href="#6" role="tab" aria-controls="6" aria-selected="true">Related Properties</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="carTabContent">
                        <div class="tab-pane fade active show" id="one" role="tabpanel" aria-labelledby="one-tab">
                            <h3 class="heading">Property Description</h3>
                            <div class="property-desc">
                              {!! $property->contentload->description !!}
                            </div>
                        </div>
                        <div class="tab-pane fade" id="two" role="tabpanel" aria-labelledby="two-tab">
                            <div class="floor-plans mb-60">
                              	@if( ! empty($property->pdfFile['file_name']))
                                  <a 
                                    href="{{'/public/files/' . urlencode($property->pdfFile['file_name']) . '.pdf'}}" 
                                    target="_blank" 
                                    class="pdf-down-prop"
                                  >
                                    <i class="fa fa-file-text-o" aria-hidden="true"></i><span> PDF</span>
                                  </a>
                                  <br>
                                  <br>
                                @endif
                              @if(isset($property->files))
                                @foreach($property->files as $file)
                                  <a href="{{$file->path}}" target="_blank"><i class="fa fa-file-o icon"></i> {{$file->name}}</a><br/><br/>
                                @endforeach
                              @endif
                                {{-- <h3 class="heading">Floor Plans</h3> --}}
                                {{-- <table>
                                    <tbody>
                                      <tr>
                                        <td><strong>Size</strong></td>
                                        <td><strong>Rooms</strong></td>
                                        <td><strong>Bathrooms</strong></td>
                                      </tr>
                                      <tr>
                                          <td>1600</td>
                                          <td>3</td>
                                          <td>2</td>
                                      </tr>
                                    </tbody>
                                </table> --}}
                                {{-- <img src="http://placehold.it/730x370" alt="floor-plans" class="img-fluid"> --}}
                            </div>
                        </div>
                        {{-- <div class="tab-pane fade " id="three" role="tabpanel" aria-labelledby="three-tab">
                            <div class="property-details">
                                <h3 class="heading">Property Details</h3>
                                <div class="row">
                                    <div class="col-md-4 col-sm-6">
                                        <ul>
                                            <li>
                                                <strong>Property Id:</strong>215
                                            </li>
                                            <li>
                                                <strong>Price:</strong>$1240/ Month
                                            </li>
                                            <li>
                                                <strong>Property Type:</strong>House
                                            </li>
                                            <li>
                                                <strong>Bathrooms:</strong>3
                                            </li>
                                            <li>
                                                <strong>Bathrooms:</strong>2
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <ul>
                                            <li>
                                                <strong>Property Lot Size:</strong>800 ft2
                                            </li>
                                            <li>
                                                <strong>Land area</strong>230 ft2
                                            </li>
                                            <li>
                                                <strong>Year Built</strong>2018
                                            </li>
                                            <li>
                                                <strong>Available From</strong>2018
                                            </li>
                                            <li>
                                                <strong>Garages:</strong>2
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <ul>
                                            <li>
                                                <strong>Sold:</strong>Yes
                                            </li>
                                            <li>
                                                <strong>City:</strong>Usa
                                            </li>
                                            <li>
                                                <strong>Parking:</strong>Yes
                                            </li>
                                            <li>
                                                <strong>Property Owner:</strong>Sohel Rana
                                            </li>
                                            <li>
                                                <strong>Zip Code: </strong>2451
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        {{-- <div class="tab-pane fade " id="4" role="tabpanel" aria-labelledby="4-tab">
                            <div class="property-video">
                                <h3 class="heading">Property Vedio</h3>
                                <iframe src="https://www.youtube.com/embed/m5_AKjDdqaU"></iframe>
                            </div>
                        </div> --}}
                        <div class="tab-pane fade " id="5" role="tabpanel" aria-labelledby="5-tab">
                            <div class="section location">
                                <h3 class="heading">Property Location</h3>
                                <div class="map">
                                    {{-- <div id="map-single"></div> --}}
                                    <div id="contactMap" class="contact-map"></div>
                                </div>
                            </div>
                        </div>
                        @if ( ! empty($related_properties))
                          <div class="tab-pane fade " id="6" role="tabpanel" aria-labelledby="6-tab">
                              <div class="related-properties">
                                  <h3 class="heading">Related Properties</h3>
                                  <div class="row">
                                    @foreach ($related_properties as $property)
                                      <div class="col-md-6">
                                          <div class="property-box">
                                              <div class="property-thumbnail">
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
                                                    <br>
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
                                  </div>
                              </div>
                          </div>
                        @endif
                    </div>
                </div>
                <!-- Amenities box start -->
                <div class="amenities-box mb-40">
                    <h3 class="heading">Condition</h3>
                    <div class="row">
                      @if ( ! empty($property['property_info']['internal_area']))
                        <div class="col-md-3 col-sm-6">
                          <ul>
                            <li><span><i class="flaticon-square-layouting-with-black-square-in-east-area"></i> Int. {{ $property['property_info']['internal_area'] }} Sq mt </span></li>
                          </ul>
                        </div>
                      @endif
                      @if ( ! empty($property['property_info']['external_area']))
                        <div class="col-md-3 col-sm-6">
                          <ul>
                            <li><span><i class="flaticon-square-layouting-with-black-square-in-east-area"></i> Ext. {{ $property['property_info']['external_area'] }} Sq mt </span></li>
                          </ul>
                        </div>
                      @endif
                      @if ( ! empty($property['property_info']['bedrooms']))
                        <div class="col-md-3 col-sm-6">
                          <ul>
                            <li><span><i class="flaticon-bed"></i> {{ $property['property_info']['bedrooms'] }} Beds</span></li>
                          </ul>
                        </div>
                      @endif
                      @if ( ! empty($property['property_info']['bathrooms']))
                        <div class="col-md-3 col-sm-6">
                          <ul>
                            <li><span><i class="flaticon-bath"></i> {{ $property['property_info']['bathrooms'] }} Bathroom</span></li>
                          </ul>
                        </div>
                      @endif
                    </div>
                </div>
                <!-- Features opions start -->
                @if( ! empty($property->features) && count($property->features) > 0)
                  <div class="features-opions mb-60">
                      <h3 class="heading">Features</h3>
                      <div class="row">
                              @foreach($features as $feature)
                                @php($featureCounter = 1)
                                @foreach($property->features as $propertyFeature)
                                  @if($propertyFeature == $feature->id)
                                  @if($featureCounter == 1 || $featureCounter % 4 == 0)
                                    <div class="col-md-3 col-sm-6">
                                      <ul>
                                  @endif
                                    <li>
                                      <i class="flaticon-check-mark"></i>
                                      {{ $feature->feature[$languageId] }}
                                    </li>
                                  @if ($featureCounter == 1 || $featureCounter % 4 == 0)
                                      </ul>
                                    </div>
                                  @endif
                                  @php($featureCounter++)
                                  @endif
                                @endforeach
                              @endforeach
                      </div>
                  </div>
                @endif
                <!-- Comments section start -->
                {{-- <div class="comments-section">
                    <h3 class="heading">Comments Section</h3>
                    <ul class="comments">
                        <li>
                            <div class="comment">
                                <div class="comment-author">
                                    <a href="#">
                                        <img src="http://placehold.it/60x60" class="rounded-circle" alt="avatar-13">
                                    </a>
                                </div>
                                <div class="comment-content">
                                    <div class="comment-meta">
                                        <div class="comment-meta-author">
                                            Jane Doe
                                        </div>
                                        <div class="comment-meta-reply">
                                            <a href="#">Reply</a>
                                        </div>
                                        <div class="comment-meta-date">
                                            <span>8:42 PM 10/3/2018</span>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="comment-body">
                                        <div class="comment-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus tincidunt aliquam. Aliquam gravida massa at sem vulputate interdum et vel eros. Maecenas eros enim, tincidunt vel turpis vel, dapibus tempus nulla. Donec vel nulla dui. Pellentesque sed ante sed.</p>
                                    </div>
                                </div>
                            </div>
                            <ul>
                                <li>
                                    <div class="comment">
                                        <div class="comment-author">
                                            <a href="#">
                                                <img src="http://placehold.it/60x60" class="rounded-circle" alt="avatar-13">
                                            </a>
                                        </div>

                                        <div class="comment-content">
                                            <div class="comment-meta">
                                                <div class="comment-meta-author">
                                                    Jane Doe
                                                </div>

                                                <div class="comment-meta-reply">
                                                    <a href="#">Reply</a>
                                                </div>

                                                <div class="comment-meta-date">
                                                    <span>8:42 PM 10/3/2018</span>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="comment-body">
                                                <div class="comment-rating">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus tincidunt aliquam. Aliquam gravida massa at sem vulputate interdum et vel eros. Maecenas eros enim, tincidunt vel turpis vel, dapibus tempus nulla. Donec vel nulla dui.</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <div class="comment">
                                <div class="comment-author">
                                    <a href="#">
                                        <img src="http://placehold.it/60x60" class="rounded-circle" alt="avatar-13">
                                    </a>
                                </div>
                                <div class="comment-content">
                                    <div class="comment-meta">
                                        <div class="comment-meta-author">
                                            Jane Doe
                                        </div>
                                        <div class="comment-meta-reply">
                                            <a href="#">Reply</a>
                                        </div>
                                        <div class="comment-meta-date">
                                            <span>8:42 PM 10/3/2018</span>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="comment-body">
                                        <div class="comment-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus tincidunt aliquam. Aliquam gravida massa at sem vulputate interdum et vel eros. Maecenas eros enim, tincidunt vel turpis vel, dapibus tempus nulla. Donec vel nulla dui. Pellentesque.</p>
                                    </div>
                                </div>
                            </div>

                        </li>
                    </ul>
                </div> --}}
                <!-- Contact 1 start -->
                {{-- <div class="contact-3 mb-60">
                    <h3 class="heading">Leave a Comment</h3>
                    <div class="container">
                        <div class="row">
                            <form action="#" method="GET" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group name">
                                            <input type="text" name="name" class="form-control" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group email">
                                            <input type="email" name="email" class="form-control" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group subject">
                                            <input type="text" name="subject" class="form-control" placeholder="Subject">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group number">
                                            <input type="text" name="phone" class="form-control" placeholder="Number">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group message">
                                            <textarea class="form-control" name="message" placeholder="Write message"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <div class="send-btn">
                                            <button type="submit" class="btn btn-color btn-md btn-message">Send Message</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> --}}
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="sidebar mbl">
                    <!-- Search area start -->
                    <div class="widget search-area d-xl-block d-lg-block">
                        <h5 class="sidebar-title">Advanced Search</h5>
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
                                    {{-- <div class="form-group">
                                        <label>Area From</label>
                                        <select class="selectpicker search-fields" name="area">
                                            <option>Area From</option>
                                            <option>1500</option>
                                            <option>1200</option>
                                            <option>900</option>
                                            <option>600</option>
                                            <option>300</option>
                                            <option>100</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Property Status</label>
                                        <select class="selectpicker search-fields" name="Status">
                                            <option>Property Status</option>
                                            <option>For Sale</option>
                                            <option>For Rent</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Location</label>
                                        <select class="selectpicker search-fields" name="Location">
                                            <option>Location</option>
                                            <option>United Kingdom</option>
                                            <option>American Samoa</option>
                                            <option>Belgium</option>
                                            <option>Canada</option>
                                            <option>Delaware</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Property Types</label>
                                        <select class="selectpicker search-fields" name="types">
                                            <option>Property Types</option>
                                            <option>Residential</option>
                                            <option>Commercial</option>
                                            <option>Land</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Bedrooms</label>
                                        <select class="selectpicker search-fields" name="bedrooms">
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
                                    <div class="form-group">
                                        <label>Bathrooms</label>
                                        <select class="selectpicker search-fields" name="bedrooms">
                                            <option>Bathrooms</option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                        </select>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label>Price</label>
                                        <div class="range-slider">
                                            <div data-min="0" data-max="150000" data-unit="USD" data-min-name="min_price" data-max-name="max_price" class="range-slider-ui ui-slider" aria-disabled="false"></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <br/>
                                    <button class="search-button btn-md btn-color">Search</button> --}}
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Categories start -->
                    {{-- <div class="widget categories">
                        <h5 class="sidebar-title">Categories</h5>
                        <ul>
                            <li><a href="#">Apartments<span>(12)</span></a></li>
                            <li><a href="#">Houses<span>(8)</span></a></li>
                            <li><a href="#">Family Houses<span>(23)</span></a></li>
                            <li><a href="#">Offices<span>(5)</span></a></li>
                            <li><a href="#">Villas<span>(63)</span></a></li>
                            <li><a href="#">Other<span>(7)</span></a></li>
                        </ul>
                    </div> --}}

                    <!-- Financing calculator  start -->
                    {{-- <div class="contact-1 financing-calculator widget">
                        <h5 class="sidebar-title">Mortgage Calculator</h5>
                        <form action="#" method="GET" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="form-label">Property Price</label>
                                <input type="text" class="form-control" placeholder="$36.400">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Interest Rate (%)</label>
                                <input type="text" class="form-control" placeholder="10%">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Period In Months</label>
                                <input type="text" class="form-control" placeholder="10 Months">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Down PaymenT</label>
                                <input type="text" class="form-control" placeholder="$21,300">
                            </div>
                            <br>
                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-color btn-md btn-message btn-block">Cauculate</button>
                            </div>
                        </form>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Properties details page start -->

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{get_setting('google_map_key', 'site')}}&sensor=false"></script>
<script src="/realstate/js/map-single.js"></script> <!-- google maps -->
<script>
  var mapOptions = {
    zoom: {{ $property->location['geo_zoom'] }},
    scrollwheel: false,
		center: new google.maps.LatLng({{ $property->location['geo_lon'] }}, {{ $property->location['geo_lat'] }}),
		disableDefaultUI: false,
		draggable: true		
	};
</script>

@endsection