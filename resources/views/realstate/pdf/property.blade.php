<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>{{ $property->contentload['name'] }}</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" media="screen">
	<style>
		body {
			margin: 0;
        }

        .logo-container {
            text-align: center; 
            width: 100%;
            margin-top: 20px;
            margin-bottom: 50px;
        }
        
        .logo {
            max-width: 200px; 
        }

        .main-image-container {
            height: 300px;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
        }

        .main-image {
            height: 100%;
            width: 100%;
            /* object-fit: cover; */
        }

        .other-image {
            width: 100%;
            /* max-height: 100%; */
            height: 150px;
        }

        .other-image-container::after {
            content: "";
            clear: both;
            display: table;
        }

        .column {
            float: left;
            width: 32%;
            padding-top: 2.5%;
        }

        .col-2 {
            padding-left: 2%;
            padding-right: 2%;
        }

        .price-container {
            margin-top: 10px;
        }

        .price {
            font-weight: 400;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 9px 0 0 0;
        }

        .list-item {
            display: inline-block;
            margin-right: 20px;
        }

        .list-item i {
            margin-right: 5px;
        }

        .fa::before {
            top: -15px !important;
            position: absolute !important;
        }

        .amen {
            width: 100%;
            min-height: 300px;
            display: block;
        }

        .amen span {
            white-space: nowrap;
            display: inline;
            min-width: 100px;
        }
        
        .additional-details {
            padding: 10px 0;
            border-top: 2px solid #6d458a;
            border-bottom: 2px solid #6d458a;
        }

        .property-title {
            color: #5ba4cf;
            margin: 15px 0 0 0;
        }
	</style>
</head>
<body>
	<header>
        <div class="logo-container">
            <img
                class="logo"
                src="{{ URL::asset('assets/images/home') . '/' . get_setting('site_logo', 'site') }}"
                alt="Logo"
            >
        </div>
    </header>
    <main class="container">
        @php($imgCounter = 0)
        @if( ! empty($property->images) && count($property->images) > 0)
            <div class="main-image-container" style="background-image: url({{URL::asset('images/data') . '/' . $property->images[$imgCounter]->image }})">
                {{-- <img 
                    class="main-image"
                    src="{{ URL::asset('images/data') . '/' . $property->images[$imgCounter]->image }}" 
                    alt=""
                > --}}
            </div>
            @if(count($property->images) > 1)
                <div class="other-image-container">
                    @foreach($property->images as $image)
                        @if($imgCounter > 0 && $imgCounter < 4)
                            <div class="column {{ 'col-' . $imgCounter }}">
                                <img 
                                    class="other-image"
                                    src="{{ URL::asset('images/data') . '/' . $property->images[$imgCounter]->image }}" 
                                    alt=""
                                >
                            </div>
                        @endif
                    @php($imgCounter++)
                    @endforeach
                </div>
            @endif
        @endif

        <div class="price-container">
            @php($salePrice = ! empty($property->prices['price']) ? $property->prices['price'] . $property->currency->symbol : '' )
            @php($perWeek = ! empty($property->prices['week']) ? 'per week ' . $property->prices['week'] . $property->currency->symbol : '' )
            @php($perMonth = ! empty($property->prices['month']) ? 'per month ' . $property->prices['month'] . $property->currency->symbol : '' )
            @if($property->sales == 1 && $property->rentals == 1)
                <h2 class="price">For Sale {{ $salePrice }} , For Rent {{ $perWeek }} {{ $perMonth }} - {{ $property->contentload['name'] }}</h2>
            @elseif($property->sales == 1)
                <h2 class="price">For Sale {{ $salePrice }} - {{ $property->contentload['name'] }}</h2>
            @elseif($property->rentals == 1)
                <h2 class="price">For Rent {{ $perWeek }} {{ $perMonth }} - {{ $property->contentload['name'] }}</h2>
            @endif
        </div>

        <div class="additional-details">
            <ul>
                <li class="list-item">
                    <i class="fa fa-home"></i><span>{{ $property->category->contentDefault->name }}</span>
                </li>
                <li class="list-item">
                    <i class="fa fa-expand"></i><span>{{ $property->property_info['internal_area'] }} Sq mt</span>
                </li>
                <li class="list-item">
                    <i class="fa fa-bed"></i><span>{{ $property->property_info['bedrooms'] }} Beds</span>
                </li>
                <li class="list-item">
                    <i class="fa fa-bath"></i><span>{{ $property->property_info['bathrooms'] }} Bathrooms</span>
                </li>
            </ul>
        </div>
        <div>
            <h4>Additional details</h4>
            <ul>
                <li class="list-item">
                    Property Ref.: <span>{{ $property->property_info['property_reference'] }}</span>
                </li>
                @if($property->sales == 1 && $property->rentals == 1)
                    <li class="list-item">
                        Property Type: <span>Sale/Rental</span>
                    </li>
                @elseif($property->rentals == 1)
                    <li class="list-item">
                        Property Type: <span>Rental</span>
                    </li>
                @elseif($property->sales == 1)
                    <li class="list-item">
                        Property Type: <span>Sale</span>
                    </li>
                @endif
                @if($property->property_info['internal_area'])
                    <li class="list-item">
                        Int. Area: <span>{{ $property->property_info['internal_area'] }} Sq mt</span>
                    </li>
                @endif
                @if($property->property_info['external_area'])
                    <li class="list-item">
                        Ext. Area: <span>{{ $property->property_info['external_area'] }} Sq mt</span>
                    </li>
                @endif
            </ul>
        </div>
        @if( ! empty($property->features) && count($property->features) > 0)
            <div>
                <h4>Amenities</h4>
                <div class="amen">
                    @foreach($features as $feature)
                        @foreach($property->features as $propertyFeature)
                            @if($propertyFeature == $feature->id)
                                <span>
                                    {{ $feature->feature[$language->id] }}
                                </span>
                            @endif
                        @endforeach
                    @endforeach
                </div>
            </div>
            <br>
        @endif
        <div>
            <h2 class="property-title">{{ $property->contentload['name'] }}</h2>
            <div>
                {!! $property->contentload->description !!}
            </div>
        </div>
    </main>
</body>
</html>