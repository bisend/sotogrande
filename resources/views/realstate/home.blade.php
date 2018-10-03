@extends('realstate.layout')

@section('mainsection')
<div class="contact-form-fix Call-Back-wrap form-active home-form-call">
        <div class="show-btn-wrapper">
            <button class="show-collback"><i class="fa fa-volume-control-phone" aria-hidden="true"></i></button>
        </div>
        <div class="fix-form-header">
            Call Back
        </div>
        <form action="" id="coll-back-form" method="post">
            <input type="hidden" name="_token" class="token" value="{{ csrf_token() }}">
            <label for="name">Name:</label>
            <input id="call-back-name" type="text" placeholder="Name" name="name">
            <label for="phone">Phone Number:</label>
            <input id="call-back-phone" type="text" placeholder="Phone" name="phone">
            <div class="recaptcha-div">
                <span id="recaptcha-error-callback">Please complete the verification!</span>
                <div class="recaptcha-style" id="call-back-captcha"></div>
            </div>
           

            <button id="send-coll-back" class="button button-icon alt small"><i class="fa fa-volume-control-phone" aria-hidden="true"></i>Send</button>
        </form>
    </div>


<section class="module no-padding-top filter search-home-section filter-home">

<div class="tabs tabs-home">

  <div class="filter-header">
    <div class="container">
        <ul>
          <li><a class="tbs-sale" href="#tabs-2">For Sale</a></li>
          <li><a class="tbs-rent" href="#tabs-3">For Rental</a></li>
        </ul>
    </div><!-- end container -->
  </div><!-- end filter header -->

  <div class="container">
    <input type="hidden" data-sale-min-price value="{{ $saleMinPrice ? $saleMinPrice : 0 }}">
    <input type="hidden" data-sale-max-price value="{{ $saleMaxPrice ? $saleMaxPrice : 0 }}">
    <input type="hidden" data-rent-min-price-per-week value="{{ $rentMinPricePerWeek ? $rentMinPricePerWeek : 0 }}">
    <input type="hidden" data-rent-max-price-per-week value="{{ $rentMaxPricePerWeek ? $rentMaxPricePerWeek : 0 }}">
    <input type="hidden" data-rent-min-price-per-month value="{{ $rentMinPricePerMonth ? $rentMinPricePerMonth : 0 }}">
    <input type="hidden" data-rent-max-price-per-month value="{{ $rentMaxPricePerMonth ? $rentMaxPricePerMonth : 0 }}">
    
    <input type="hidden" data-sale-min-price-pound value="{{ $saleMinPricePound ? $saleMinPricePound : 0 }}">
    <input type="hidden" data-sale-max-price-pound value="{{ $saleMaxPricePound ? $saleMaxPricePound : 0 }}">
    <input type="hidden" data-rent-min-price-per-week-pound value="{{ $rentMinPricePerWeekPound ? $rentMinPricePerWeekPound : 0 }}">
    <input type="hidden" data-rent-max-price-per-week-pound value="{{ $rentMaxPricePerWeekPound ? $rentMaxPricePerWeekPound : 0 }}">
    <input type="hidden" data-rent-min-price-per-month-pound value="{{ $rentMinPricePerMonthPound ? $rentMinPricePerMonthPound : 0 }}">
    <input type="hidden" data-rent-max-price-per-month-pound value="{{ $rentMaxPricePerMonthPound ? $rentMaxPricePerMonthPound : 0 }}">
    
    <div id="tabs-2" class="ui-tabs-hide">
        <form id="search-sale" class="select-search-form">
            <div class="filter-item filter-item-7">
                <label>Property Type</label>
                <select id="search_sale-type" name="property-type">
                    <option value="">All</option>
                    @if(isset($categories))
                      @foreach($categories as $category)
                          <option value="{{$category->id}}">{{$category->contentDefault->name}}</option>
                      @endforeach
                    @endif
                </select>
              </div>

              <div class="filter-item filter-item-7">
                <label>Country</label>
                <select id="search_sale-country" name="property-country">
                  {{-- <option class="country-any" value="">Any</option> --}}
                  @foreach($countries as $country)
                    <option value="{{$country->id}}" {{$country->contentDefault->location == 'Gibraltar' ? 'selected' : ''}}>
                    {{$country->contentDefault->location}}
                  </option>
                  @endforeach
                </select>
              </div>
    
              <div class="filter-item filter-item-7">
                <label>Location</label>
                <select class="location-select" id="search_sale-location" name="location">
                      <option class="location-any" value="">Any</option>
                      @foreach($locations as $location)
                          <option class="country-{{$location->country_id}}" 
                              value="{{$location->id}}">
                              {{$location->contentDefault->location}}
                          </option>                        
                      @endforeach
                </select>
              </div>
    
              <div class="filter-item filter-item-7 filter-item-sale beds-item-sale rooms-filter">
                  <label>Beds</label>
                  <div class="beds-radio">
                      <p>
                          <input value="1" type="radio" id="1-plus-sale" name="radio-group-sale">
                          <label for="1-plus-sale"></label>
                          <span>1+</span>
                      </p>
                      <p>
                          <input value="2" type="radio" id="2-plus-sale" name="radio-group-sale">
                          <label for="2-plus-sale"></label>
                          <span>2+</span>
                      </p>
                      <p>
                          <input value="3" type="radio" id="3-plus-sale" name="radio-group-sale">
                          <label for="3-plus-sale"></label>
                          <span>3+</span>
                      </p>
                      <p>
                          <input value="4" type="radio" id="4-plus-sale" name="radio-group-sale">
                          <label for="4-plus-sale"></label>
                          <span>4+</span>
                      </p>
                      <p>
                          <input value="5" type="radio" id="5-plus-sale" name="radio-group-sale">
                          <label for="5-plus-sale"></label>
                          <span>5+</span>
                      </p>
                  </div>
              </div>
    
              <div class="filter-item filter-item-7">
                  <label>Price</label>
                  
                  <div id="slider-price-sale" class="slider-price">
                      <div class="price-slider" id="price-slider"></div>
                      <div class="price-slider-values">
                        <span class="price-range-num" id="price-low-value-1"></span>
                        <span class="price-range-num right" id="price-high-value-1"></span>
                    </div>
                    <span class="low-price"></span>
                  </div>

                  <div id="slider-price-sale-pound" class="slider-price">
                      <div class="price-slider-pound" id="price-slider-pound"></div>
                      <div class="price-slider-values">
                        <span class="price-range-num" id="price-low-value-1"></span>
                        <span class="price-range-num right" id="price-high-value-1"></span>
                    </div>
                    <span class="low-price"></span>
                  </div>
              </div>

              <div class="filter-item filter-item-7 ">
                <label>Search By Reference:</label>
                <input id="refer-val-sale" 
                class="reference" 
                type="text" 
                name="reference-search" 
                placeholder="Search By Reference:">
              </div>
              

              <div class="filter-item filter-item-7 home-filter-btn">
                <label class="label-submit">Submit</label><br/>
                <input type="submit" id="find-sale" class="button alt" value="Find Properties">
              </div>

          
        </form>
    </div><!-- end tab 2 -->

    <div id="tabs-3" class="ui-tabs-hide">
        <form id="search-rent" class="select-search-form" method="post">
            <div class="filter-item filter-item-7">
                <label>Property Type</label>
                <select id="search_rent-type" name="property-type">
                    <option value="">All</option>
                    @if(isset($categories))
                      @foreach($categories as $category)
                          <option value="{{$category->id}}">{{$category->contentDefault->name}}</option>
                      @endforeach
                    @endif
                </select>
              </div> 

              <div class="filter-item filter-item-7 filter-item-rent">
                <label>Country</label>
                <select id="search_rent-country" name="property-country">
                      {{-- <option class="country-any" value="">Any</option> --}}
                      @foreach($countries as $country)
                      <option value="{{$country->id}}" {{$country->contentDefault->location == 'Gibraltar' ? 'selected' : ''}}>
                        {{$country->contentDefault->location}}
                      </option>
                      @endforeach
                </select>
              </div>
    
              <div class="filter-item filter-item-7 filter-item-rent">
                <label>Location</label>
                <select class="location-select" id="search_rent-location" name="location">
                      <option class="location-any" value="">Any</option>
                      @foreach($locations as $location)
                          <option class="country-{{$location->country_id}}" value="{{$location->id}}">{{$location->contentDefault->location}}</option>                        
                      @endforeach
                </select>
              </div>
    
              <div class="filter-item filter-item-7 filter-item-rent beds-item-rent rooms-filter">
                  <label>Beds</label>
                  <div class="beds-radio">
                      <p>
                          <input value="1" type="radio" id="1-plus-rent" name="radio-group-rent">
                          <label for="1-plus-rent"></label>
                          <span>1+</span>
                      </p>
                      <p>
                          <input value="2" type="radio" id="2-plus-rent" name="radio-group-rent">
                          <label for="2-plus-rent"></label>
                          <span>2+</span>
                      </p>
                      <p>
                          <input value="3" type="radio" id="3-plus-rent" name="radio-group-rent">
                          <label for="3-plus-rent"></label>
                          <span>3+</span>
                      </p>
                      <p>
                          <input value="4" type="radio" id="4-plus-rent" name="radio-group-rent">
                          <label for="4-plus-rent"></label>
                          <span>4+</span>
                      </p>
                      <p>
                          <input value="5" type="radio" id="5-plus-rent" name="radio-group-rent">
                          <label for="5-plus-rent"></label>
                          <span>5+</span>
                      </p>
                  </div>
              </div>
    
              <div class="filter-item filter-item-7 filter-item-rent">
                  <label>Price per week</label>
                  <div id="price-rent-pw" class="slider-price">
                      <div class="price-slider-rent" id="price-slider-rent-per-week"></div>
                      <div class="price-slider-rent-values">
                        <span class="price-range-num" id="price-low-value-1"></span>
                        <span class="price-range-num right" id="price-high-value-1"></span>
                    </div>
                  </div>
                  
                  <div id="price-rent-pw" class="slider-price">
                      <div class="price-slider-rent" id="price-slider-rent-per-week-pound"></div>
                      <div class="price-slider-rent-values">
                        <span class="price-range-num" id="price-low-value-1"></span>
                        <span class="price-range-num right" id="price-high-value-1"></span>
                    </div>
                  </div>
              </div>

              <div class="filter-item filter-item-7 filter-item-rent">
                  <label>Price per month</label>
                  <div id="price-rent-pm" class="slider-price">
                      <div class="price-slider-rent" id="price-slider-rent-per-month"></div>
                      <div class="price-slider-rent-values">
                          <span class="price-range-num" id="price-low-value-1"></span>
                          <span class="price-range-num right" id="price-high-value-1"></span>
                      </div>
                  </div>
                  
                  <div id="price-rent-pm" class="slider-price">
                      <div class="price-slider-rent" id="price-slider-rent-per-month-pound"></div>
                      <div class="price-slider-rent-values">
                          <span class="price-range-num" id="price-low-value-1"></span>
                          <span class="price-range-num right" id="price-high-value-1"></span>
                      </div>
                  </div>
              </div>

              <div class="filter-item filter-item-7 filter-item-rent">
                <label>Search By Reference:</label>
                <input id="refer-val-rent" class="reference" name="reference-search-rent" type="text" placeholder="Search By Reference:">
              </div>
    
              <div class="filter-item filter-item-7 filter-item-rent home-filter-btn">
                <label class="label-submit">Submit</label><br/>
                <input id="find-rent-btn" type="submit" class="button alt" value="Find Properties" />
              </div>
        </form>
    </div><!-- end tab 3 -->

  </div><!-- end container -->
</div><!-- end tabs -->
</section>



<section class="subheader subheader-slider">
  <div class="slider-wrap">

    <div class="slider-nav slider-nav-simple-slider">
      <span class="slider-prev"><i class="fa fa-angle-left"></i></span>
      <span class="slider-next"><i class="fa fa-angle-right"></i></span>
    </div>

    <div class="slider slider-simple slider-advanced">
    @foreach($slider as $slide)     
      <div class="slide" style="background-image: url('{{ $slide->imageByStatus }}')">
        <div class="img-overlay black"></div>
        <div class="container">
            <div class="slide-price">
                @if($slide->sales == 1 && $slide->rentals == 1)
                    @if($slide->prices['price'])
                    <div>{{ $slide->currency->symbol}} {{ $slide->prices['price'] }} Price</div>
                    @endif
                    @if($slide->prices['week'])
                    <div>{{ $slide->currency->symbol}} {{ $slide->prices['week'] }} Per Week</div>
                    @endif
                    @if($slide->prices['month'])
                    <div>{{ $slide->currency->symbol}} {{ $slide->prices['month'] }} Per Month</div>
                    @endif
                @elseif($slide->rentals == 1)
                    @if($slide->prices['week'])
                    <div>{{ $slide->currency->symbol}} {{ $slide->prices['week'] }} Per Week</div>
                    @endif
                    @if($slide->prices['month'])
                    <div>{{ $slide->currency->symbol}} {{ $slide->prices['month'] }} Per Month</div>
                    @endif
                @elseif($slide->sales == 1)
                    @if($slide->prices['price'])
                    <div>{{ $slide->currency->symbol}} {{ $slide->prices['price'] }} Price</div>
                    @endif
                @endif
            </div>

          <div class="slide-content">
            <h1>{{ $slide->contentload->name }}</h1>
            <p class="slide-text">{!! str_limit($slide->contentload->description, 200, ' ...') !!}</p>
            <table>
              <tr>
                <td><i class="fa fa-home" aria-hidden="true"></i></i>{{ $slide->category->contentDefault->name }}</td>
                @if($slide->property_info['bedrooms'])
                <td><i class="fa fa-bed"></i>{{ $slide->property_info['bedrooms'] }}</td>
                @endif
                @if($slide->property_info['internal_area'])
                <td><i class="fa fa-expand"></i>{{ $slide->property_info['internal_area'] }}</td>
                @endif
                {{-- <td><i class="fa fa-user" aria-hidden="true"></i>{{ $slide->guest_number }}</td> --}}
              </tr>
            </table>
            @if($slide->property_status)
            <span class="lable-sale right mobile-lable-flout label-actv-slider">{{ $slide->property_status->name }}</span>
            @endif
            @if($slide->sales == 1 && $slide->rentals == 1)
                <span class="lable-sale right mobile-lable-flout">Sale</span>
                <span class="lable-rent right mobile-lable-flout">Rental</span>
            @elseif($slide->rentals == 1)
                <span class="lable-rent right mobile-lable-flout">Rental</span>
            @elseif($slide->sales == 1)
                <span class="lable-sale right mobile-lable-flout">Sale</span>
            @endif
            <a href="/property/{{$slide->alias}}" class="button button-icon"><i class="fa fa-angle-right"></i>View Details</a>
          </div>
        </div>
      </div>
    @endforeach
    
    </div><!-- end slider -->
  </div><!-- end slider wrap -->
</section>


<section class="module properties home-properties">
  <div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6 sale-home-list">
            <div class="module-header">
                <h2>Sales</h2>
                <img src="/realstate/images/divider.png" alt="" />
            </div>
            <div class="row">
                @foreach($sales_properties as $sales_property)
                    <div class="col-lg-12 col-md-12">
                        <div class="property shadow-hover">
                        <a href="/property/{{$sales_property->alias}}" class="property-img">
                            <div class="img-fade"></div>
                            @if($sales_property->property_status)
                            <div class="label-actv">
                                {{ $sales_property->property_status->name }}
                            </div>
                            @endif
                            <div class="property-tag lable-sale featured">Sale</div>
                            <div class="property-price">
                                @if($sales_property->sales == 1 && $sales_property->rentals == 1)
                                    @if($sales_property->prices['price'])
                                    <div>{{ $sales_property->currency->symbol}} {{ $sales_property->prices['price'] }} Price</div>
                                    @endif
                                    @if($sales_property->prices['week'])
                                    <div>{{ $sales_property->currency->symbol}} {{ $sales_property->prices['week'] }} Per Week</div>
                                    @endif
                                    @if($sales_property->prices['month'])
                                    <div>{{ $sales_property->currency->symbol}} {{ $sales_property->prices['month'] }} Per Month</div>
                                    @endif
                                @elseif($sales_property->rentals == 1)
                                    @if($sales_property->prices['week'])
                                    <div>{{ $sales_property->currency->symbol}} {{ $sales_property->prices['week'] }} Per Week</div>
                                    @endif
                                    @if($sales_property->prices['month'])
                                    <div>{{ $sales_property->currency->symbol}} {{ $sales_property->prices['month'] }} Per Month</div>
                                    @endif
                                @elseif($sales_property->sales == 1)
                                    @if($sales_property->prices['price'])
                                    <div>{{ $sales_property->currency->symbol}} {{ $sales_property->prices['price'] }} Price</div>
                                    @endif
                                @endif
                            </div>
                            <div class="property-color-bar"></div>
                            <div class="prop-img-home">
                                <img src="{{ $sales_property->imageByStatus }}" alt="" />
                            </div>
                        </a>
                        <div class="property-content">
                            <div class="property-title">
                            <h4><a href="/property/{{$sales_property->alias}}">{{ $sales_property->contentload->name }}</a></h4>
                            </div>
                            <table class="property-details">
                            <tr>
                                <td><i class="fa fa-home" aria-hidden="true"></i></i>{{ $sales_property->category->contentDefault->name }}</td>
                                @if($sales_property->property_info['bedrooms'])
                                <td><i class="fa fa-bed"></i>{{ $sales_property->property_info['bedrooms'] }}</td>
                                @endif
                                @if($sales_property->property_info['internal_area'])
                                <td><i class="fa fa-expand"></i>{{ $sales_property->property_info['internal_area'] }}</td>
                                @endif
                                {{-- <td><i class="fa fa-user" aria-hidden="true"></i>{{ $sales_property->guest_number }}</td> --}}
                            </tr>
                            </table>
                        </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="center"><a href="{{ route('sale') }}" class="button button-icon more-properties-btn btn-showMore-home"><i class="fa fa-angle-right"></i> View More Sales</a></div>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-6 rentals-home-list">
            <div class="module-header">
                <h2>Rentals</h2>
                <img src="/realstate/images/divider.png" alt="" />
            </div>
            <div class="row">
            @foreach($rentals_properties as $rentals_property)
                <div class="col-lg-12 col-md-12">
                    <div class="property shadow-hover">
                        <a href="/property/{{$rentals_property->alias}}" class="property-img">
                        <div class="img-fade"></div>
                        @if($rentals_property->property_status)
                        <div class="label-actv">
                            {{ $rentals_property->property_status->name }}
                        </div>
                        @endif
                        <div class="property-tag lable-rent featured">Rental</div>
                        <div class="property-price">
                            @if($rentals_property->sales == 1 && $rentals_property->rentals == 1)
                                @if($rentals_property->prices['price'])
                                <div>{{ $rentals_property->currency->symbol}} {{ $rentals_property->prices['price'] }} Price</div>
                                @endif
                                @if($rentals_property->prices['week'])
                                <div>{{ $rentals_property->currency->symbol}} {{ $rentals_property->prices['week'] }} Per Week</div>
                                @endif
                                @if($rentals_property->prices['month'])
                                <div>{{ $rentals_property->currency->symbol}} {{ $rentals_property->prices['month'] }} Per Month</div>
                                @endif
                            @elseif($rentals_property->rentals == 1)
                                @if($rentals_property->prices['week'])
                                <div>{{ $rentals_property->currency->symbol}} {{ $rentals_property->prices['week'] }} Per Week</div>
                                @endif
                                @if($rentals_property->prices['month'])
                                <div>{{ $rentals_property->currency->symbol}} {{ $rentals_property->prices['month'] }} Per Month</div>
                                @endif
                            @elseif($rentals_property->sales == 1)
                                @if($rentals_property->prices['price'])
                                <div>{{ $rentals_property->currency->symbol}} {{ $rentals_property->prices['price'] }} Price</div>
                                @endif
                            @endif
                        </div>
                        <div class="property-color-bar"></div>
                        <div class="prop-img-home">
                            <img src="{{ $rentals_property->imageByStatus }}" alt="" />
                        </div>
                        </a>
                        <div class="property-content">
                        <div class="property-title">
                        <h4><a href="/property/{{$rentals_property->alias}}">{{ $rentals_property->contentload->name }}</a></h4>
                        </div>
                        <table class="property-details">
                            <tr>
                                <td>
                                    <i class="fa fa-home" aria-hidden="true"></i></i>
                                    {{ $rentals_property->category->contentDefault->name }}
                                </td>
                                @if($rentals_property->property_info['bedrooms'])
                                <td><i class="fa fa-bed"></i>{{ $rentals_property->property_info['bedrooms'] }}</td>
                                @endif
                                @if($rentals_property->property_info['internal_area'])
                                <td>
                                    <i class="fa fa-expand"></i>
                                    {{ $rentals_property->property_info['internal_area'] }}
                                </td>
                                @endif
                                {{-- <td>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    {{ $rentals_property->guest_number }}
                                </td> --}}
                            </tr>
                        </table>
                        </div>
                    </div>
                 </div>
                 @endforeach
            
            <div class="center"><a href="{{ route('rent') }}" class="button button-icon more-properties-btn btn-showMore-home"><i class="fa fa-angle-right"></i> View More Rentals</a></div>
            </div><!-- end row -->
        </div>
      </div> 
  </div><!-- end container -->
</section>

@endsection