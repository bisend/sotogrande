@extends('layouts.admin')

@section('title')
    <title>{{get_string('create_property') . ' - ' . get_setting('site_name', 'site')}}</title>
    <link href="/realstate/assets/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" media="screen">
    <link  href="/assets/css/cropper.css" rel="stylesheet">

    <!-- Latest compiled and minified CSS -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

<!-- Optional theme -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous"> -->
@endsection

@section('content')
@section('page_title')
    <h3 class="page-title mbot10">{{get_string('create_property')}}</h3>
@endsection
<div class="col s12">
    @if(!$errors->isEmpty())
        <span class="wrong-error">* {{get_string('validation_error')}}</span>
    @endif
    {!!Form::open(['method' => 'post', 'url' => route('admin.property.store'), 'files' => 'true'])!!}
        <div class="panel">
            <div class="panel-heading">
                <ul class="nav nav-tabs">
                    <li class="tab active"><a href="#content-panel" data-toggle="tab">{{get_string('content')}}</a></li>
                    <li class="tab"><a href="#data-panel" data-toggle="tab">{{get_string('data')}}</a></li>
                    <li class="tab"><a href="#property-panel" data-toggle="tab">{{get_string('property')}}</a></li>
                    <li class="tab"><a href="#meta-panel" data-toggle="tab">{{get_string('meta')}}</a></li>
                </ul>
            </div>
        <div class="panel-body">
            <div class="tab-content">
                <div id="content-panel" class="tab-pane active">
                    <div class="panel">
                        <div class="panel-heading">
                            <ul class="nav nav-tabs">
                                @foreach($languages as $language)
                                    <li class="tab {{$language->default ? 'active' : ''}}"><a href="#lang{{$language->id}}" data-parent="#content" data-toggle="tab"><img src="{{$language->flag}}"/><span>{{$language->language}}</span></a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="panel-body">
                            <div class="tab-content">
                                @foreach($languages as $language)
                                    <div id="lang{{$language->id}}" class="tab-pane {{$language->default ? 'active' : ''}}">
                                        <div class="col s12">
                                            <div class="form-group  {{$errors->has('name.'.$language->id.'') ? 'has-error' : ''}}">
                                                {{Form::text('name['.$language->id.']', null, ['class' => 'form-control', 'placeholder' => get_string('enter_property_name')])}}
                                                {{Form::label('name['.$language->id.']', get_string('property_name'))}} *
                                                @if($errors->has('name.'.$language->id.''))
                                                    <span class="wrong-error">* {{$errors->first('name.'.$language->id.'')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col s12">
                                            {{Form::textarea('description['.$language->id.']', null, ['class' => 'hidden desc-content'])}}
                                            @if($errors->has('description.'.$language->id.''))
                                                <span class="wrong-error">* {{$errors->first('description.'.$language->id.'')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div id="data-panel" class="tab-pane">
                    <div class="col s12 clearfix">
                        <h5 class="section-title">{{get_string('general')}}</h5>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('property_info.property_reference') || $errors->has('property_reference') ? 'has-error' : ''}}">
                            {{Form::text('property_info[property_reference]', null, ['class' => 'form-control', 'placeholder' => 'Property Reference'])}}
                            {{Form::label('property_info[property_reference]', 'Property Reference')}} *
                            @if($errors->has('property_reference'))
                                <span class="wrong-error">* {{$errors->first('property_reference')}}</span>
                            @endif
                            @if($errors->has('property_info.property_reference'))
                                <span class="wrong-error">* {{$errors->first('property_info.property_reference')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col m6 s6">
                        <div class="form-group  {{$errors->has('category_id') ? 'has-error' : ''}}">
                            {{Form::select('category_id', $categories, null, ['class' => 'category-select form-control', 'placeholder' => get_string('choose_category')])}}
                            {{Form::label('category_id', get_string('choose_category'))}} *
                            @if($errors->has('category_id'))
                                <span class="wrong-error">* {{$errors->first('category_id')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col m6 s6">
                        <div class="form-group  {{$errors->has('country_id') ? 'has-error' : ''}}">
                            {{Form::select('country_id', $countries, 'Gibraltar', ['class' => 'country-select form-control', 'placeholder' => 'Select country'])}}
                            {{Form::label('country_id', 'Country')}} *
                            @if($errors->has('country_id'))
                                <span class="wrong-error">* {{$errors->first('country_id')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col m6 s6">
                        <div class="form-group  {{$errors->has('location_id') ? 'has-error' : ''}}">
                            {{-- {{Form::select('location_id', $locations, null, ['class' => 'location-select form-control country-', 'placeholder' => get_string('choose_location')])}} --}}
                            <select name="location_id" id="select_location_id" 
                                class="location-select form-control" 
                                placeholder="Select location">
                            <option value="" disabled="disabled" hidden="hidden" selected>Select location</option>
                            @foreach($locations as $location)
                                <option class="country-{{$location->country_id}}" 
                                    value="{{$location->id}}" 
                                    {{ $location->id == old('location_id') ? 'selected' : ''}}
                                    >
                                    {{$location->contentDefault->location}}
                                </option>    
                            @endforeach
                            </select>
                            {{-- {{ old('location_id')}} --}}
                            {{Form::label('location_id', 'Location')}} *
                            @if($errors->has('location_id'))
                                <span class="wrong-error">* {{$errors->first('location_id')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col s12 well checkbox-grid">
                        <p>{{get_string('choose_features')}}</p>
                        @foreach($features as $feature)
                            <div class="col s2">
                                <div class="form-group">
                                    <input type="checkbox" name="features[]" @if(old('features') && in_array_r($feature->id, old('features'))) checked @endif value="{{$feature->id}}" class="filled-in primary-color" id="{{$feature->id}}" />
                                    <label for="{{$feature->id}}"></label>
                                    <span class="checkbox-label">{{$feature->feature[$default_language->id]}}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col s12 clearfix">
                        <h5 class="section-title">{{get_string('media')}}</h5>
                    </div>
                    <div class="col l12 m12 s12">
                        <div id="file-dropzone" class="dropzone">
                            <div class="dz-message">{{get_string('upload_images')}}<br/><i class="material-icons medium">cloud_upload</i>
                            </div>
                            <div class="fallback">
                            </div>
                            <input type="hidden" id="main-photo" name="main_photo">
                        </div>
                    </div>
                    <!-- <div class="col s12">
                        <div class="form-group  {{$errors->has('video') ? 'has-error' : ''}}">
                            {{Form::text('video', null, ['class' => 'form-control', 'placeholder' => get_string('video_id')])}}
                            {{Form::label('video', get_string('video_id'))}}
                            @if($errors->has('video'))
                                <span class="wrong-error">* {{$errors->first('video')}}</span>
                            @endif
                        </div>
                    </div> -->
                    <div class="col s12 clearfix">
                        <h5 class="section-title">{{get_string('location')}} *</h5>
                    </div>
                    <div class="col s12">
                        <div class="row mbot0">
                            <div class="col l6 m12 s12">
                                <div class="form-group  {{($errors->has('location.geo_lon') || ($errors->has('location.geo_lon')))  ? 'has-error' : ''}}">
                                    <!-- {{Form::text('marker', null, ['class' => 'form-control autocomplete', 'id' => 'address-map', 'placeholder' => get_string('drop_marker')])}}
                                    {{Form::label('marker', get_string('drop_marker'))}} -->
                                    @if($errors->has('location.geo_lon') || $errors->has('location.geo_lat'))
                                        <span class="wrong-error">* {{get_string('google_address_required')}} </span>
                                    @endif
                                </div>
                                    <div id="google-map">
                                </div>
                            </div>
                            <div class="col l6 m12 s12">
                                <div class="row mbot0">
                                    <!-- <div class="col l12 m12 s12">
                                        <div class="form-group  {{$errors->has('location.address') ? 'has-error' : ''}}">
                                            {{Form::text('location[address]', null, ['class' => 'form-control', 'placeholder' => get_string('address')])}}
                                            {{Form::label('location[address]', get_string('address'))}}
                                            @if($errors->has('location.address'))
                                                <span class="wrong-error">* {{$errors->first('location.address')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col l12 m12 s12">
                                        <div class="form-group  {{$errors->has('location.city') ? 'has-error' : ''}}">
                                            {{Form::text('location[city]', null, ['class' => 'form-control', 'placeholder' => get_string('city')])}}
                                            {{Form::label('location[city]', get_string('city'))}}
                                            @if($errors->has('location.city'))
                                                <span class="wrong-error">* {{$errors->first('location.city')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col l12 m12 s12">
                                        <div class="form-group  {{$errors->has('location.state') ? 'has-error' : ''}}">
                                            {{Form::text('location[state]', null, ['class' => 'form-control', 'placeholder' => get_string('state')])}}
                                            {{Form::label('location[state]', get_string('state'))}}
                                            @if($errors->has('location.state'))
                                                <span class="wrong-error">* {{$errors->first('location.state')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col l12 m12 s12">
                                        <div class="form-group  {{$errors->has('location.country') ? 'has-error' : ''}}">
                                            {{Form::text('location[country]', null, ['class' => 'form-control', 'placeholder' => get_string('country')])}}
                                            {{Form::label('location[country]', get_string('country'))}}
                                            @if($errors->has('location.country'))
                                                <span class="wrong-error">* {{$errors->first('location.country')}}</span>
                                            @endif
                                        </div>
                                    </div> -->
                                    <div class="col l12 m12 s12">
                                        <div class="form-group">
                                            {{Form::hidden('location[geo_lon]', null, ['class' => 'form-control', 'placeholder' => get_string('geo_lon')])}}
                                            <!-- {{Form::label('location[geo_lon]', get_string('geo_lon'))}} -->
                                        </div>
                                    </div>
                                    <div class="col l12 m12 s12">
                                        <div class="form-group">
                                            {{Form::hidden('location[geo_lat]', null, ['class' => 'form-control', 'placeholder' => get_string('geo_lat')])}}
                                            <!-- {{Form::label('location[geo_lat]', get_string('geo_lat'))}} -->
                                        </div>
                                    </div>
                                    <div class="col l12 m12 s12">
                                        <div class="form-group">
                                            {{Form::hidden('location[geo_zoom]', null, ['class' => 'form-control', 'placeholder' => 'Zoom'])}}
                                            <!-- {{Form::label('location[zoom]', 'Zoom')}} -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 clearfix">
                        <h5 class="section-title">Files</h5>
                    </div>
                    <div class="col l12 m12 s12 new-file">
                        <div class="clearfix input-group">
                            <label class="input-group-btn">
                                <span class="btn btn-primary">Default File
                                    <input type="text" style="display: none;" name="default_file" value="findaproperty-agreement.doc">
                                </span>
                            </label>
                            <input type="text" class="form-control" readonly value="findaproperty-agreement.doc">
                            <i class="material-icons small remove-property-file" data-remove-property-file="default">clear</i>
                        </div>
                        <br>
                        <div class="clearfix input-group">
                            <label class="input-group-btn">
                                <span class="btn btn-primary">File <i class="material-icons small">add_circle</i>
                                    <input type="file" name="files[]" style="display: none;">
                                </span>
                            </label>
                            <input type="text" class="form-control" readonly data-file-name>
                        </div>
                    </div>
                    {{-- <div class="col s12">
                        <ul class="collapsible collapsible-accordion">
                            <li>
                                <div class="collapsible-header"><span>{{get_string('contact')}}</span><i class="material-icons small accordion-active">remove_circle</i><i class="material-icons small accordion-disabled">add_circle</i>
                                    <i class="material-icons small color-red {{($errors->has('contact.tel1') || $errors->has('contact.tel2') || $errors->has('contact.fax') || $errors->has('contact.email') || $errors->has('contact.web')) ? '' : 'hidden'}}">report_problem</i>
                                </div>
                                <div class="collapsible-body">
                                    <div class="col l4 m6 s12">
                                        <div class="form-group  {{$errors->has('contact.tel1') ? 'has-error' : ''}}">
                                            {{Form::text('contact[tel1]', null, ['class' => 'form-control', 'placeholder' => get_string('contact_tel1')])}}
                                            {{Form::label('contact[tel1]', get_string('contact_tel1'))}}
                                            @if($errors->has('contact.tel1'))
                                                <span class="wrong-error">* {{$errors->first('contact.tel1')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col l4 m6 s12">
                                        <div class="form-group  {{$errors->has('contact.tel2') ? 'has-error' : ''}}">
                                            {{Form::text('contact[tel2]', null, ['class' => 'form-control', 'placeholder' => get_string('contact_tel2')])}}
                                            {{Form::label('contact[tel2]', get_string('contact_tel2'))}}
                                            @if($errors->has('contact.tel3'))
                                                <span class="wrong-error">* {{$errors->first('contact.tel2')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col l4 m6 s12">
                                        <div class="form-group  {{$errors->has('contact.fax') ? 'has-error' : ''}}">
                                            {{Form::text('contact[fax]', null, ['class' => 'form-control', 'placeholder' => get_string('fax')])}}
                                            {{Form::label('contact[fax]', get_string('fax'))}}
                                            @if($errors->has('contact.fax'))
                                                <span class="wrong-error">* {{$errors->first('contact.fax')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col l4 m6 s12">
                                        <div class="form-group  {{$errors->has('contact.email') ? 'has-error' : ''}}">
                                            {{Form::text('contact[email]', null, ['class' => 'form-control', 'placeholder' => get_string('email')])}}
                                            {{Form::label('contact[email]', get_string('email'))}}
                                            @if($errors->has('contact.email'))
                                                <span class="wrong-error">* {{$errors->first('contact.email')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col l4 m6 s12">
                                        <div class="form-group  {{$errors->has('contact.web') ? 'has-error' : ''}}">
                                            {{Form::text('contact[web]', null, ['class' => 'form-control', 'placeholder' => get_string('website')])}}
                                            {{Form::label('contact[web]', get_string('website'))}}
                                            @if($errors->has('contact.web'))
                                                <span class="wrong-error">* {{$errors->first('contact.web')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div> --}}
                    {{-- <div class="col s12">
                        <ul class="collapsible collapsible-accordion">
                            <li>
                                <div class="collapsible-header"><span>{{get_string('social_networks')}}</span><i class="material-icons small accordion-active">remove_circle</i><i class="material-icons small accordion-disabled">add_circle</i></div>
                                <div class="collapsible-body">
                                    <div class="col l4 m6 s12">
                                        <div class="form-group  {{$errors->has('social[facebook]') ? 'has-error' : ''}}">
                                            {{Form::text('social[facebook]', null, ['class' => 'form-control', 'placeholder' => get_string('facebook')])}}
                                            {{Form::label('social[facebook]', get_string('facebook'))}}
                                            @if($errors->has('social[facebook]'))
                                                <span class="wrong-error">* {{$errors->first('social[facebook]')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col l4 m6 s12">
                                        <div class="form-group  {{$errors->has('social[gplus]') ? 'has-error' : ''}}">
                                            {{Form::text('social[gplus]', null, ['class' => 'form-control', 'placeholder' => get_string('google_plus')])}}
                                            {{Form::label('social[gplus]', get_string('google_plus'))}}
                                            @if($errors->has('social[gplus]'))
                                                <span class="wrong-error">* {{$errors->first('social[gplus]')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col l4 m6 s12">
                                        <div class="form-group  {{$errors->has('social[twitter]') ? 'has-error' : ''}}">
                                            {{Form::text('social[twitter]', null, ['class' => 'form-control', 'placeholder' => get_string('twitter')])}}
                                            {{Form::label('social[twitter]', get_string('twitter'))}}
                                            @if($errors->has('social[twitter]'))
                                                <span class="wrong-error">* {{$errors->first('social[twitter]')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col l4 m6 s12">
                                        <div class="form-group  {{$errors->has('social[instagram]') ? 'has-error' : ''}}">
                                            {{Form::text('social[instagram]', null, ['class' => 'form-control', 'placeholder' => get_string('instagram')])}}
                                            {{Form::label('social[instagram]', get_string('instagram'))}}
                                            @if($errors->has('social[instagram]'))
                                                <span class="wrong-error">* {{$errors->first('social[instagram]')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col l4 m6 s12">
                                        <div class="form-group  {{$errors->has('social[pinterest]') ? 'has-error' : ''}}">
                                            {{Form::text('social[pinterest]', null, ['class' => 'form-control', 'placeholder' => get_string('pinterest')])}}
                                            {{Form::label('social[pinterest]', get_string('pinterest'))}}
                                            @if($errors->has('social[pinterest]'))
                                                <span class="wrong-error">* {{$errors->first('social[pinterest]')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col l4 m6 s12">
                                        <div class="form-group  {{$errors->has('social[linkedin]') ? 'has-error' : ''}}">
                                            {{Form::text('social[linkedin]', null, ['class' => 'form-control', 'placeholder' => get_string('linkedin')])}}
                                            {{Form::label('social[linkedin]', get_string('linkedin'))}}
                                            @if($errors->has('social[linkedin]'))
                                                <span class="wrong-error">* {{$errors->first('social[linkedin]')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div> --}}
                    <div class="hidden-fields hidden">
                    </div>
                </div>

                <div id="property-panel" class="tab-pane">
                    <div class="col s12 clearfix">
                        <h5 class="section-title">Sales or Rentals *</h5>
                    </div>
                    <div class="col s6 checkbox-grid">
                        <div class="form-group  {{$errors->has('sale_rent') ? 'has-error' : ''}}">
                            <form action="" class="form-control">
                                <div class="col s2">
                                    <div class="form-group">
                                        <input type="checkbox" 
                                            class="filled-in primary-color" 
                                            id="contactChoice1" 
                                            name="sale_rent[]" 
                                            value="sales" {{ old('sale_rent') && in_array('sales', old('sale_rent')) ? 'checked' : '' }}
                                        >
                                        <label for="contactChoice1"></label>
                                        <span class="checkbox-label">Sales</span>
                                    </div>
                                </div>
                                <div class="col s2">
                                    <div class="form-group">
                                        <input type="checkbox"  
                                            class="filled-in primary-color" 
                                            id="contactChoice2" 
                                            name="sale_rent[]" 
                                            value="rentals"{{ old('sale_rent') && in_array('rentals', old('sale_rent')) ? 'checked' : '' }}
                                        >
                                        <label for="contactChoice2"></label>
                                        <span class="checkbox-label">Rentals</span>
                                    </div>
                                </div>
                            </form>
                            @if($errors->has('sale_rent'))
                                <span class="wrong-error">* Choose one of the options</span>
                            @endif
                        </div>
                    </div>
                    <div class="col s12 clearfix">
                        <h5 class="section-title">{{get_string('property_info')}}</h5>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('property_info.internal_area') ? 'has-error' : ''}}">
                            {{Form::text('property_info[internal_area]', null, ['class' => 'form-control', 'placeholder' => 'Internal Area'])}}
                            {{Form::label('property_info[internal_area]', 'Internal Area m')}}<sup>2</sup> *
                            @if($errors->has('property_info.internal_area'))
                                <span class="wrong-error">* {{$errors->first('property_info.internal_area')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('property_info.external_area') ? 'has-error' : ''}}">
                            {{Form::text('property_info[external_area]', null, ['class' => 'form-control', 'placeholder' => 'External Area'])}}
                            {{Form::label('property_info[external_area]', 'External Area m')}}<sup>2</sup> *
                            @if($errors->has('property_info.external_area'))
                                <span class="wrong-error">* {{$errors->first('property_info.external_area')}}</span>
                            @endif
                        </div>
                    </div>
                    {{-- <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('guest_number') ? 'has-error' : ''}}">
                            {{Form::text('guest_number', null, ['class' => 'form-control', 'placeholder' => get_string('guest_number')])}}
                            {{Form::label('guest_number', get_string('guest_number'))}} *
                            @if($errors->has('guest_number'))
                                <span class="wrong-error">* {{$errors->first('guest_number')}}</span>
                            @endif
                        </div>
                    </div> --}}
                    {{-- <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('rooms') ? 'has-error' : ''}}">
                            {{Form::text('rooms', null, ['class' => 'form-control', 'placeholder' => get_string('property_rooms')])}}
                            {{Form::label('rooms', get_string('property_rooms'))}} *
                            @if($errors->has('rooms'))
                                <span class="wrong-error">* {{$errors->first('rooms')}}</span>
                            @endif
                        </div>
                    </div> --}}
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('property_info.bedrooms') ? 'has-error' : ''}}">
                            {{Form::text('property_info[bedrooms]', null, ['class' => 'form-control', 'placeholder' => get_string('property_bedrooms')])}}
                            {{Form::label('property_info[bedrooms]', get_string('property_bedrooms'))}} *
                            @if($errors->has('property_info.bedrooms'))
                                <span class="wrong-error">* {{$errors->first('property_info.bedrooms')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('property_info.bathrooms') ? 'has-error' : ''}}">
                            {{Form::text('property_info[bathrooms]', null, ['class' => 'form-control', 'placeholder' => get_string('property_bathrooms')])}}
                            {{Form::label('property_info[bathrooms]', get_string('property_bathrooms'))}} *
                            @if($errors->has('property_info.bathrooms'))
                                <span class="wrong-error">* {{$errors->first('property_info.bathrooms')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col s12 clearfix">
                        <h5 class="section-title">{{get_string('Currency')}}</h5>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('currency_id') ? 'has-error' : ''}}">
                            @php($currencyCounter = 0)
                            @foreach($currencies as $currency)
                                <p>
                                <label for="currency_id_{{ $currency->id }}">
                                    @if(old('currency_id'))
                                        <input type="radio" 
                                            id="currency_id_{{ $currency->id }}"
                                            name="currency_id" 
                                            value="{{ $currency->id }}" 
                                            {{ old('currency_id') == $currency->id ? 'checked' : ''}}
                                        >
                                    @else
                                        <input type="radio" 
                                            id="currency_id_{{ $currency->id }}"
                                            name="currency_id" 
                                            value="{{ $currency->id }}" 
                                            {{ $currencyCounter == 1 ? 'checked' : ''}}
                                        >
                                    @endif
                                        {{ $currency->code}}
                                </label>
                                </p>
                                @php($currencyCounter++)
                            @endforeach
                            @if($errors->has('prices.price'))
                                <span class="wrong-error">* {{$errors->first('currency_id')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col s12 clearfix">
                        <h5 class="section-title">{{get_string('property_prices')}}</h5>
                    </div>
                    <div class="col l6 m6 s12" data-prices-price>
                        <div class="form-group  {{$errors->has('prices.price') ? 'has-error' : ''}}">
                            {{Form::text('prices[price]', null, ['class' => 'form-control', 'placeholder' => 'Price'])}}
                            {{Form::label('prices[price]', 'Price')}}
                            @if($errors->has('prices.price'))
                                <span class="wrong-error">* {{$errors->first('prices.price')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12" data-prices-sc-sale>
                        <div class="form-group  {{$errors->has('prices.service_charge') ? 'has-error' : ''}}">
                            {{Form::text('prices[service_charge]', null, ['class' => 'form-control', 'placeholder' => 'Service Charge'])}}
                            {{Form::label('prices[service_charge]', 'Service Charge (required for sale)')}}
                            @if($errors->has('prices.service_charge'))
                                <span class="wrong-error">* {{$errors->first('prices.service_charge')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12" data-prices-rate-sale>
                        <div class="form-group  {{$errors->has('prices.rates') ? 'has-error' : ''}}">
                            {{Form::text('prices[rates]', null, ['class' => 'form-control', 'placeholder' => 'Rates'])}}
                            {{Form::label('prices[rates]', 'Rates (required for sale)')}} 
                            @if($errors->has('prices.rates'))
                                <span class="wrong-error">* {{$errors->first('prices.rates')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12" data-prices-pw-rent>
                        <div class="form-group  {{$errors->has('prices.week') ? 'has-error' : ''}}">
                            {{Form::text('prices[week]', null, ['class' => 'form-control', 'placeholder' => 'Price per week'])}}
                            {{Form::label('prices[week]', 'Price per week (required for rent)')}}
                            @if($errors->has('prices.week'))
                                <span class="wrong-error">* {{$errors->first('prices.week')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12" data-prices-pm-rent>
                        <div class="form-group  {{$errors->has('prices.month') ? 'has-error' : ''}}">
                            {{Form::text('prices[month]', null, ['class' => 'form-control', 'placeholder' => 'Price per month'])}}
                            {{Form::label('prices[month]', 'Price per month (required for rent)')}} 
                            @if($errors->has('prices.month'))
                                <span class="wrong-error">* {{$errors->first('prices.month')}}</span>
                            @endif
                        </div>
                    </div>
                    <!-- <div class="col s12 clearfix">
                        <h5 class="section-title">{{get_string('property_fees')}}</h5>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('fees.city_fee') ? 'has-error' : ''}}">
                            {{Form::text('fees[city_fee]', 0, ['class' => 'form-control', 'placeholder' => get_string('city_fee')])}}
                            {{Form::label('fees[city_fee]', get_string('city_fee'))}}
                            @if($errors->has('fees.city_fee'))
                                <span class="wrong-error">* {{$errors->first('fees.city_fee')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  {{$errors->has('fees.cleaning_fee') ? 'has-error' : ''}}">
                            {{Form::text('fees[cleaning_fee]', 0, ['class' => 'form-control', 'placeholder' => get_string('cleaning_fee')])}}
                            {{Form::label('fees[cleaning_fee]', get_string('cleaning_fee'))}}
                            @if($errors->has('fees.cleaning_fee'))
                                <span class="wrong-error">* {{$errors->first('fees.cleaning_fee')}}</span>
                            @endif
                        </div>
                    </div> -->
                </div>
                <div id="meta-panel" class="tab-pane">
                    <div class="col s12 clearfix">
                        <h5 class="section-title">{{get_string('meta')}}</h5>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group">
                            {{Form::text('meta_title', null, ['class' => 'form-control', 'placeholder' => get_string('meta_title')])}}
                            {{Form::label('meta_title', get_string('meta_title'))}}
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group">
                            {{Form::text('meta_keywords', null, ['class' => 'form-control', 'placeholder' => get_string('meta_keywords')])}}
                            {{Form::label('meta_keywords', get_string('meta_keywords'))}}
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="form-group">
                            {{Form::textarea('meta_description', null, ['class' => 'form-control', 'placeholder' => get_string('meta_description')])}}
                            {{Form::label('meta_description', get_string('meta_description'))}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col clearfix s12 mtop10">
                <div class="form-group">
                    <button class="btn waves-effect" type="submit" name="action">{{get_string('create_property')}}</button>
                    <a href="{{route('admin.property.index')}}" class="btn waves-effect">{{get_string('property_all')}}</a>
                </div>
            </div>
            {{Form::hidden('user_id', Auth::user()->id)}}
            {!!Form::close()!!}
        </div>
    </div>
</div>
@endsection

@section('footer')

 

<!-- Modal -->
<div class="modal fade cropper-section-modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
      <div class="cropper-section">
<div class="container">
  <div class="row">
    <div class="col-md-9 col9crop">
      <!-- <h3>Demo:</h3> -->
      <div class="img-container">
          <div class="cropper-img">

          </div>
      </div>
    </div>
    <div class="col-md-3 col3crop docs-buttons">
      <!-- <h3>Toolbar:</h3> -->
      <div class="btn-group">
        <button type="button"  class="btn btn-primary width50" data-method="rotate" data-option="-45" title="Rotate Left">
          <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;rotate&quot;, -45)">
            <span class="fa fa-rotate-left"></span>
          </span>
        </button>
        <button type="button" class="btn btn-primary width50" data-method="rotate" data-option="45" title="Rotate Right">
          <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;rotate&quot;, 45)">
            <span class="fa fa-rotate-right"></span>
          </span>
        </button>
        <div class="docs-toggles">
      <!-- <h3>Toggles:</h3> -->
      <div class="btn-group d-flex flex-nowrap" data-toggle="buttons">
        <label class="btn btn-primary active width50">
          <input type="radio" class="sr-only" id="aspectRatio0" name="aspectRatio" value="1.7777777777777777">
          <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="aspectRatio: 16 / 9">
            16:9
          </span>
        </label>
        <label class="btn btn-primary width50">
          <input type="radio" class="sr-only" id="aspectRatio1" name="aspectRatio" value="1.3333333333333333">
          <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="aspectRatio: 4 / 3">
            4:3
          </span>
        </label>
        <label class="btn btn-primary width50">
          <input type="radio" class="sr-only" id="aspectRatio2" name="aspectRatio" value="1">
          <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="aspectRatio: 1 / 1">
            1:1
          </span>
        </label>
        <label class="btn btn-primary width50">
          <input type="radio" class="sr-only" id="aspectRatio3" name="aspectRatio" value="0.6666666666666666">
          <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="aspectRatio: 2 / 3">
            2:3
          </span>
        </label>
        <label class="btn btn-primary width100">
          <input type="radio" class="sr-only" id="aspectRatio4" name="aspectRatio" value="NaN">
          <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="aspectRatio: NaN">
            Free
          </span>
        </label>
      </div>

    </div><!-- /.docs-toggles -->
    <button id="saveImgCropp" type="button" class="btn btn-secondary width100" data-method="getData" data-option data-target="#putData">
        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false">
          Save
        </span>
      </button>
      </div>


    

      <!-- <div class="btn-group btn-group-crop">
        <button type="button" class="btn btn-success" data-method="getCroppedCanvas" data-option="{ &quot;maxWidth&quot;: 4096, &quot;maxHeight&quot;: 4096 }">
          <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;getCroppedCanvas&quot;, { maxWidth: 4096, maxHeight: 4096 })">
            Get Cropped Canvas
          </span>
        </button>
      </div> -->

      <!-- Show the cropped image in modal -->
      <div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="getCroppedCanvasTitle">Cropped</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <a class="btn btn-primary" id="download" href="javascript:void(0);" download="cropped.jpg">Download</a>
            </div>
          </div>
        </div>
      </div>
      <!-- /.modal -->     
      <input type="hidden" class="form-control" id="putData" rows="1" placeholder="Get data to here or set data with this value">
    </div><!-- /.docs-buttons -->

    
  </div>
</div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>

    $('body').on('click', '#saveImgCropp', function () {
        console.log('YES!')
        let imgID = $('.cropper-img img').attr('id');
        let putData = $('#putData').val();
        console.log(imgID, putData)

        $.ajax({
            url: '{{url('/image_handler/update')}}',
            type: 'POST',
            data: {
                _token: $('[name=_token]').val(),
                imgID: imgID,
                putData: putData
            },
            success: function (data) {
                if (data.status == 'success') {
                    console.log(data.img);
                                        
                    $( ".dz-image img" ).each(function() {
                        if($(this).attr('id') == imgID){
                             $(this).attr('src', 'data:image/png;base64,'+data.img)
                        }
                    });
                    $('.cropper-section-modal').modal('hide');

                    // if($('.dz-image img').attr('id') == imgID){
                    //     $('.dz-image img').attr('src', data.img)
                    // }
                }
            },
            error: function (error) {
                
            }
        });

    })

    var $image;
       $('body').on('click','.open-cropper', function () {
        //    console.log(123123123123123123)

           $('.cropper-section-modal').modal('show');
           let tmpIMG = $('<img>');
           tmpIMG.attr('src', $(this).prev('img').attr('src'));

           let imgVal = $(this).children('input').val();
           console.log(imgVal)
        
           tmpIMG.attr('id', imgVal);

           $('.cropper-img').html(tmpIMG);

           $('.cropper-section-modal').on('shown.bs.modal', function() {
            $('#aspectRatio4').click();
            $('#viewMode3').trigger("click");
                //     setTimeout(() => {
                //         console.log(12313213123)
                //     $('#aspectRatio4').click();
                //     $('#viewMode3').trigger("click");
                // }, 500);
$(function () {

'use strict';

var console = window.console || { log: function () {} };
var URL = window.URL || window.webkitURL;
 $image = tmpIMG;
var $download = $('#download');
var $dataX = $('#dataX');
var $dataY = $('#dataY');
var $dataHeight = $('#dataHeight');
var $dataWidth = $('#dataWidth');
var $dataRotate = $('#dataRotate');
var $dataScaleX = $('#dataScaleX');
var $dataScaleY = $('#dataScaleY');
var options = {
      aspectRatio: 16 / 9,
      preview: '.img-preview',
      crop: function (e) {
        $dataX.val(Math.round(e.detail.x));
        $dataY.val(Math.round(e.detail.y));
        $dataHeight.val(Math.round(e.detail.height));
        $dataWidth.val(Math.round(e.detail.width));
        $dataRotate.val(e.detail.rotate);
        $dataScaleX.val(e.detail.scaleX);
        $dataScaleY.val(e.detail.scaleY);
      }
    };
var originalImageURL = $image.attr('src');
var uploadedImageName = 'cropped.jpg';
var uploadedImageType = 'image/jpeg';
var uploadedImageURL;


// Tooltip
$('[data-toggle="tooltip"]').tooltip();

// $('#aspectRatio4').trigger( "click" );
// $('#viewMode3').trigger( "click" );
// Cropper

$image.on({
  ready: function (e) {
    console.log(e.type);
  },
  cropstart: function (e) {
    console.log(e.type, e.detail.action);
  },
  cropmove: function (e) {
    console.log(e.type, e.detail.action);
  },
  cropend: function (e) {
    console.log(e.type, e.detail.action);
    this.cropper.destroy();
  },
  crop: function (e) {
    console.log(e.type);
  },
  zoom: function (e) {
    console.log(e.type, e.detail.ratio);
  }
}).cropper(options);


// Buttons
if (!$.isFunction(document.createElement('canvas').getContext)) {
  $('button[data-method="getCroppedCanvas"]').prop('disabled', true);
}

if (typeof document.createElement('cropper').style.transition === 'undefined') {
  $('button[data-method="rotate"]').prop('disabled', true);
  $('button[data-method="scale"]').prop('disabled', true);
}


// Download
if (typeof $download[0].download === 'undefined') {
  $download.addClass('disabled');
}


// Options
$('.docs-toggles').on('change', 'input', function () {
  var $this = $(this);
  var name = $this.attr('name');
  var type = $this.prop('type');
  var cropBoxData;
  var canvasData;

  if (!$image.data('cropper')) {
    return;
  }

  if (type === 'checkbox') {
    options[name] = $this.prop('checked');
    cropBoxData = $image.cropper('getCropBoxData');
    canvasData = $image.cropper('getCanvasData');

    options.ready = function () {
      $image.cropper('setCropBoxData', cropBoxData);
      $image.cropper('setCanvasData', canvasData);
    };
  } else if (type === 'radio') {
    options[name] = $this.val();
  }

  $image.cropper('destroy').cropper(options);
});


// Methods
$('.docs-buttons').on('click', '[data-method]', function () {
  var $this = $(this);
  var data = $this.data();
  var cropper = $image.data('cropper');
  var cropped;
  var $target;
  var result;

  if ($this.prop('disabled') || $this.hasClass('disabled')) {
    return;
  }

  if (cropper && data.method) {
    data = $.extend({}, data); // Clone a new one

    if (typeof data.target !== 'undefined') {
      $target = $(data.target);

      if (typeof data.option === 'undefined') {
        try {
          data.option = JSON.parse($target.val());
        } catch (e) {
          console.log(e.message);
        }
      }
    }

    cropped = cropper.cropped;

    switch (data.method) {
      case 'rotate':
        if (cropped && options.viewMode > 0) {
          $image.cropper('clear');
        }

        break;

      case 'getCroppedCanvas':
        if (uploadedImageType === 'image/jpeg') {
          if (!data.option) {
            data.option = {};
          }

          data.option.fillColor = '#fff';
        }

        break;
    }

    result = $image.cropper(data.method, data.option, data.secondOption);

    switch (data.method) {
      case 'rotate':
        if (cropped && options.viewMode > 0) {
          $image.cropper('crop');
        }

        break;

      case 'scaleX':
      case 'scaleY':
        $(this).data('option', -data.option);
        break;

      case 'getCroppedCanvas':
        if (result) {
          // Bootstrap's Modal
          $('#getCroppedCanvasModal').modal().find('.modal-body').html(result);

          if (!$download.hasClass('disabled')) {
            download.download = uploadedImageName;
            $download.attr('href', result.toDataURL(uploadedImageType));
          }
        }

        break;

      case 'destroy':
        if (uploadedImageURL) {
          URL.revokeObjectURL(uploadedImageURL);
          uploadedImageURL = '';
          $image.attr('src', originalImageURL);
        }

        break;
    }

    if ($.isPlainObject(result) && $target) {
      try {
        $target.val(JSON.stringify(result));
      } catch (e) {
        console.log(e.message);
      }
    }

  }
});


// Keyboard
$(document.body).on('keydown', function (e) {

  if (!$image.data('cropper') || this.scrollTop > 300) {
    return;
  }

  switch (e.which) {
    case 37:
      e.preventDefault();
      $image.cropper('move', -1, 0);
      break;

    case 38:
      e.preventDefault();
      $image.cropper('move', 0, -1);
      break;

    case 39:
      e.preventDefault();
      $image.cropper('move', 1, 0);
      break;

    case 40:
      e.preventDefault();
      $image.cropper('move', 0, 1);
      break;
  }

});


// Import image
var $inputImage = $('#inputImage');

if (URL) {
  $inputImage.change(function () {
    var files = this.files;
    var file;

    if (!$image.data('cropper')) {
      return;
    }

    if (files && files.length) {
      file = files[0];

      if (/^image\/\w+$/.test(file.type)) {
        uploadedImageName = file.name;
        uploadedImageType = file.type;

        if (uploadedImageURL) {
          URL.revokeObjectURL(uploadedImageURL);
        }

        uploadedImageURL = URL.createObjectURL(file);
        $image.cropper('destroy').attr('src', uploadedImageURL).cropper(options);
        $inputImage.val('');
      } else {
        window.alert('Please choose an image file.');
      }
    }
  });
} else {
  $inputImage.prop('disabled', true).parent().addClass('disabled');
}
})
        
      
});

})
// $('.cropper-section-modal').on('hidden.bs.modal', function() {
//     // cropper.destroy();
//     // this.cropper.destroy();
//     $image.destroy();
// });
</script>
<!-- <script src="/assets/js/cropper.js"></script> -->

<script src="https://maps.googleapis.com/maps/api/js?key={{get_setting('google_map_key', 'site')}}&libraries=places"></script>



    <script>
        
        var selectedCountryId = 0;

        selectedCountryId = $('.country-select') ? $('.country-select').val() : 0;

        function checkCountry () {
            var country_id = selectedCountryId;

            // $('#select_location_id').val('');

            if (country_id == '') {
                $(".location-select option" ).each(function() {
                    $(this).show();
                });
            } else {
                $(".location-select option").each(function() {
                    if($(this).hasClass('country-' + country_id)) {
                        $(this).show();
                        $('.location-any').show();
                    } else {
                        $(this).hide();
                        $('.location-any').show();
                    }
                });
            }
        }

        $(document).ready(function() {

            checkCountry();

            $(document).on('change', 'input[name="files[]"]', function () {
                var input = $(this)[0];
                if (input.files && input.files[0])
                {
                    var reader = new FileReader();
                    $(reader).on('load', function (e)
                    {
                        var newFile = '<br><div class="clearfix input-group"><label class="input-group-btn"><span class="btn btn-primary">File <i class="material-icons small">add_circle</i><input type="file" name="files[]" style="display:none"></span></label><input type="text" class="form-control pdf-name" data-file-name></div>';
                        $('.new-file').append(newFile);
                        $(input).parent().parent().parent().find('.pdf-name').val(input.files[0].name);
                    });
                    reader.readAsDataURL(input.files[0]);
                }
                var cl = "<i class='material-icons small remove-property-file' data-remove-property-file='default'>clear</i>";
                $(input).parent().parent().parent().find('[data-file-name]').after(cl);
            });
            $('.desc-content').summernote({
                height: 200,
                maxwidth: false,
                minwidth: false,
                placeholder: '{{get_string('enter_property_content')}}',
                disableDragAndDrop: true,
                toolbar: [
                    ["style", ["style"]],
                    ["font", ["bold", "underline", "clear"]],
                    ["color", ["color"]],
                    ["para", ["ul", "ol", "paragraph"]],
                ],callbacks: {
                    onPaste: function (e) {
                        var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                        e.preventDefault();
                        document.execCommand('insertText', false, bufferText);
                    }
                }
            });
        });

        var imgCount = 0;
        var checkCount = 0;
        var cropImg = 0;
        var lastImg = 0;
        var cropImgEdit = 0;

        $(document).ready(function(){
            Dropzone.autoDiscover = false;
            $('#file-dropzone').dropzone({
                url: '{{url('/image_handler/upload')}}',
                paramsName: 'image',
                params: {_token: $('[name=_token]').val()},
                maxFilesize: 100,
                uploadMultiple: false,
                addRemoveLinks: true,
                maxfilesize: 1,
                parallelUploads: 1,
                maxFiles: 10,
                init: function() {

                   @if(old('images'))
                        @foreach(old('images') as $image)
                            var mockFile = { name: '{{ $image }}', size: 100000 };
                            this.emit("addedfile", mockFile);
                            this.createThumbnailFromUrl(mockFile, '/images/data/{{ $image }}');
                            this.emit("success", mockFile);
                            $('[data-dz-name]').each(function (index, elem) {
                                if ($(elem).text() == '{{$image}}') {
                                    $(elem).closest('.dz-preview').find('a.dz-remove').attr('data-dz-remove', '{{$image}}')
                                }
                            })
                        
                        $('.hidden-fields').append('<input type="hidden" name="images[]" value="{{ $image }}">');

                        //  let lastUploadImg = $($('.dz-image img').get(lastImg++))
                        

                        var cropbtn = $($('.open-cropper').get(cropImgEdit++))
                        cropbtn.last().append('<input type="hidden" value="{{ $image }}">');

                            var checkboxList = $($('.checkboxList').get(checkCount++))
                            checkboxList.last().append('<input type="checkbox" id="{{ $image }}" class="filled-in primary-color" name="general photo" value="{{ $image }}" ><label for="{{ $image }}"></label><span>Main photo</span>');
                            
                            // checkboxList.find('input').on('change', function(){
                            //     if(this.checked) {
                            //     var mainPhoto = $(this).val();
                            //     $('#main-photo').val(mainPhoto);
                            //     console.log($('#main-photo').val())
                            //     console.log(mainPhoto)
                            //     $.ajax({
                            //         url: '{{url('/image_handler/status')}}',
                            //         type: 'POST',
                            //         data: {
                            //             _token: $('[name="_token"]').val(),
                            //             mainPhoto: mainPhoto
                            //         },
                            //         success: function(msg){
                            //             //toastr.success(msg);
                            //         },
                            //         error:function(msg){
                            //             toastr.error(msg.responseJSON);
                            //         }
                            //     });
                            // } else {
                            //     $('#main-photo').val('');
                            //     console.log($('#main-photo').val())
                            // }
                            // });

                            $( ".checkboxList input[type=checkbox]" ).each(function(  ) {
                            if(this.checked){
                                var current = $(this);
                                var parent = current.parent();
                                var index = current.index();
                                var checked = current.prop('checked');

                                // disable others in current div
                            current.siblings().each(function () {
                                    var other = $(this);

                                    if (checked){
                                            other.attr('disabled', true);
                                            other.addClass('disable-by-current');
                                    }else {
                                            other.removeClass('disable-by-current');
                                            if (other.hasClass('disable-by-others')){
                                                    // can not disabled
                                            }else{
                                                    other.attr('disabled', false);
                                            }
                                    }

                            });

                            $('.checkboxList input[type=checkbox]').each(function () {
                                    var tmpCurrent = $(this);
                                    var tmpParent = tmpCurrent.parent();
                                    var tmpIndex = tmpCurrent.index();
                                    var tmpChecked = tmpCurrent.prop('checked');

                                    // if not current div
                                    if (tmpParent.get(0) !== parent.get(0)) {
                                            // common in other div
                                            if (tmpIndex === index) {
                                                    if (checked){
                                                            tmpCurrent.attr('disabled', true);
                                                            tmpCurrent.addClass('disable-by-others');
                                                    }else{
                                                            tmpCurrent.removeClass('disable-by-others');
                                                            if (tmpCurrent.hasClass('disable-by-current')){
                                                                    // can not disable
                                                            }else {
                                                                    tmpCurrent.attr('disabled', false);
                                                            }
                                                    }
                                            }
                                    }

                            });
                        }
                    });
                            


            $(function () {
                var groups = $('.checkboxList');
                $('body').on('change', '.checkboxList input[type=checkbox]', function () {

                    var current = $(this);
                    var parent = current.parent();
                    var index = current.index();
                    var checked = current.prop('checked');

                    // disable others in current div
                    current.siblings().each(function () {
                        var other = $(this);

                        if (checked){
                            other.attr('disabled', true);
                            other.addClass('disable-by-current');
                        }else {
                            other.removeClass('disable-by-current');
                            if (other.hasClass('disable-by-others')){
                                // can not disabled
                            }else{
                                other.attr('disabled', false);
                            }
                        }

                    });

                    $('.checkboxList input[type=checkbox]').each(function () {
                        var tmpCurrent = $(this);
                        var tmpParent = tmpCurrent.parent();
                        var tmpIndex = tmpCurrent.index();
                        var tmpChecked = tmpCurrent.prop('checked');

                        // if not current div
                        if (tmpParent.get(0) !== parent.get(0)) {
                            // common in other div
                            if (tmpIndex === index) {
                                if (checked){
                                    tmpCurrent.attr('disabled', true);
                                    tmpCurrent.addClass('disable-by-others');
                                }else{
                                    tmpCurrent.removeClass('disable-by-others');
                                    if (tmpCurrent.hasClass('disable-by-current')){
                                        // can not disable
                                    }else {
                                        tmpCurrent.attr('disabled', false);
                                    }
                                }
                            }
                        }

                    })
                })
            });

                        @endforeach
                    @endif
                    
                    this.on('success', function(file, json) {
                        var selector = file._removeLink;
                        $(selector).attr('data-dz-remove', json.data);
                        $('.hidden-fields').append('<input type="hidden" name="images[]" value="'+ json.data +'">');
                        
                        
                        let lastUploadImg = $($('.dz-image img').get(lastImg++))
                        lastUploadImg.last().attr('id',json.data)

                        // let rot = $($('.rotate-btn').get(imgCount++))
                        let cropbtn = $($('.open-cropper').get(cropImg++))
                        cropbtn.last().append('<input type="hidden" value="'+ json.data +'">');
                        
                        let checkboxList = $($('.checkboxList').get(checkCount++))

                        checkboxList.last().append('<input type="checkbox" id="'+ json.data +'" class="filled-in primary-color" name="general photo" value="'+ json.data +'" ><label for="'+ json.data +'"></label><span>Main photo</span>');
                                               
                        checkboxList.find('input').on('change', function(){
                            if(this.checked) {
                                
                                var mainPhoto = $(this).val();
                                $('#main-photo').val(mainPhoto);
                                console.log($('#main-photo').val())
                            } else {
                                $('#main-photo').val('');
                                console.log($('#main-photo').val())
                            }
                        });

                         $( ".checkboxList input[type=checkbox]" ).each(function(  ) {
                            if(this.checked){
                                var current = $(this);
                                var parent = current.parent();
                                var index = current.index();
                                var checked = current.prop('checked');

                                // disable others in current div
                            current.siblings().each(function () {
                                    var other = $(this);

                                    if (checked){
                                            other.attr('disabled', true);
                                            other.addClass('disable-by-current');
                                    }else {
                                            other.removeClass('disable-by-current');
                                            if (other.hasClass('disable-by-others')){
                                                    // can not disabled
                                            }else{
                                                    other.attr('disabled', false);
                                            }
                                    }

                            });

                            $('.checkboxList input[type=checkbox]').each(function () {
                                    var tmpCurrent = $(this);
                                    var tmpParent = tmpCurrent.parent();
                                    var tmpIndex = tmpCurrent.index();
                                    var tmpChecked = tmpCurrent.prop('checked');

                                    // if not current div
                                    if (tmpParent.get(0) !== parent.get(0)) {
                                            // common in other div
                                            if (tmpIndex === index) {
                                                    if (checked){
                                                            tmpCurrent.attr('disabled', true);
                                                            tmpCurrent.addClass('disable-by-others');
                                                    }else{
                                                            tmpCurrent.removeClass('disable-by-others');
                                                            if (tmpCurrent.hasClass('disable-by-current')){
                                                                    // can not disable
                                                            }else {
                                                                    tmpCurrent.attr('disabled', false);
                                                            }
                                                    }
                                            }
                                    }

                            });
                        }
                    });
                            


            $(function () {
                var groups = $('.checkboxList');
                $('body').on('change', '.checkboxList input[type=checkbox]', function () {

                    var current = $(this);
                    var parent = current.parent();
                    var index = current.index();
                    var checked = current.prop('checked');

                    // disable others in current div
                    current.siblings().each(function () {
                        var other = $(this);

                        if (checked){
                            other.attr('disabled', true);
                            other.addClass('disable-by-current');
                        }else {
                            other.removeClass('disable-by-current');
                            if (other.hasClass('disable-by-others')){
                                // can not disabled
                            }else{
                                other.attr('disabled', false);
                            }
                        }

                    });

                    $('.checkboxList input[type=checkbox]').each(function () {
                        var tmpCurrent = $(this);
                        var tmpParent = tmpCurrent.parent();
                        var tmpIndex = tmpCurrent.index();
                        var tmpChecked = tmpCurrent.prop('checked');

                        // if not current div
                        if (tmpParent.get(0) !== parent.get(0)) {
                            // common in other div
                            if (tmpIndex === index) {
                                if (checked){
                                    tmpCurrent.attr('disabled', true);
                                    tmpCurrent.addClass('disable-by-others');
                                }else{
                                    tmpCurrent.removeClass('disable-by-others');
                                    if (tmpCurrent.hasClass('disable-by-current')){
                                        // can not disable
                                    }else {
                                        tmpCurrent.attr('disabled', false);
                                    }
                                }
                            }
                        }

                    })
                })
            });


        });

                    this.on('addedfile', function(file) {

                    });

                    this.on("removedfile", function(file) {
                        var selector = file._removeLink;
                        var data = $(selector).attr('data-dz-remove');
                        // if (!data) {
                            // data = file.name;
                        // }
                        console.log('removed', file)
                        $.ajax({
                            type: 'POST',
                            url: '{{url('/image_handler/delete')}}',
                            data: {data: data, _token: $('[name=_token]').val()},
                            dataType: 'html',
                            success: function(msg){
                                $('.hidden-fields').find('[value="'+ data +'"]').remove();
                            },
                            error: function(error) {
                                console.log(error);
                            }
                        });
                    });
                }
            });

            $('.country-select').on('change', function () {
                var country_id = $(this).val();
                $('#select_location_id').val('');
                if(country_id == '') {
                $(".location-select option" ).each(function() {
                        $(this).show();
                    });
                }else{
                    $(".location-select option").each(function() {
                        if($(this).hasClass('country-'+country_id)){
                            $(this).show();
                            $('.location-any').show();
                        }else{
                            $(this).hide();
                            $('.location-any').show();
                        }
                    });
                }
            });

        });

        // Google Map
        $(document).ready(function() {
            if(typeof google !== 'undefined' && google){
                var map = new google.maps.Map(document.getElementById('google-map'), {
                    center:{
                        lat: {{ old('location.geo_lon') ? old('location.geo_lon') : 36.14474 }},
                        lng: {{ old('location.geo_lat') ? old('location.geo_lat') : -5.35257 }}
                    },
                    zoom: 15
                });
                var marker = new google.maps.Marker({
                    position: {
                        lat: {{ old('location.geo_lon') ? old('location.geo_lon') : 36.14474 }},
                        lng: {{ old('location.geo_lat') ? old('location.geo_lat') : -5.35257 }}
                    },
                    map: map,
                    draggable: true
                });
                var infowindow = new google.maps.InfoWindow();
                var searchBox = document.getElementById('address-map');
                var autocomplete = new google.maps.places.Autocomplete(searchBox);
                marker.setVisible(true);
                autocomplete.bindTo('bounds', map);
                // autocomplete.addListener('place_changed', function() {
                //     infowindow.close();
                //     marker.setVisible(false);
                //     var place = autocomplete.getPlace();
                //     if (!place.geometry) {
                //         return;
                //     }

                //     // If the place has a geometry, then present it on a map.
                //     if (place.geometry.viewport) {
                //         map.fitBounds(place.geometry.viewport);
                //     } else {
                //         map.setCenter(place.geometry.location);
                //         map.setZoom(15);
                //     }

                //     marker.setPosition(place.geometry.location);
                //     marker.setVisible(false);

                //     var address = '';
                //     if (place.address_components) {
                //         address = [
                //             (place.address_components[0] && place.address_components[0].short_name || ''),
                //             (place.address_components[1] && place.address_components[1].short_name || ''),
                //             (place.address_components[2] && place.address_components[2].short_name || '')
                //         ].join(' ');
                //     }

                //     infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
                //     infowindow.open(map, marker);
                // });

                google.maps.event.addListener(marker, 'position_changed', function () {
                    var lat = marker.getPosition().lat();
                    var lng = marker.getPosition().lng();
                    $('[name="location[geo_lon]"]').val(lat);
                    $('[name="location[geo_lat]"]').val(lng);
                });
                google.maps.event.addListener(map, 'center_changed', function () {
                    var zoom = map.getZoom();
                    var lat = map.getCenter().lat();
                    var lng = map.getCenter().lng();
                    $('[name="location[geo_lon]"]').val(lat);
                    $('[name="location[geo_lat]"]').val(lng);
                    $('[name="location[geo_zoom]"]').val(zoom);
                });
                $('a[href$="data-panel"]').click(function(){
                    var currCenter = map.getCenter();
                    setTimeout(function(){
                        google.maps.event.trigger($("#google-map")[0], 'resize');
                        map.setCenter(currCenter);
                    }, 50);
                });
            }
        });

        /*
        show/hide prices if sale/rent
        */
        $(document).ready(function() {
            var saleCheck = document.getElementById('contactChoice1'),
                rentCheck = document.getElementById('contactChoice2'),
                prc = $('[data-prices-price]'),
                pwRent = $('[data-prices-pw-rent]'), 
                pmRent = $('[data-prices-pm-rent]'),
                scSale = $('[data-prices-sc-sale]'),
                rateSale = $('[data-prices-rate-sale]');

            function hidePrices (type) {
                if (type == 'rent') {
                    pwRent.hide().find('input').val('');
                    pmRent.hide().find('input').val('');
                }

                if (type == 'sales') {
                    prc.hide().find('input').val('');
                    scSale.hide().find('input').val('');
                    rateSale.hide().find('input').val('');
                }
            }

            function showPrices (type) {
                if (type == 'rent') {
                    pwRent.show();
                    pmRent.show();
                }

                if (type == 'sales') {
                    prc.show();
                    scSale.show();
                    rateSale.show();
                }
            }

            function checkPrices () {
                if (saleCheck.checked && rentCheck.checked) {
                    showPrices('rent');
                    showPrices('sales');
                }

                if (saleCheck.checked && ! rentCheck.checked) {
                    hidePrices('rent');
                    showPrices('sales');
                }
                
                if ( ! saleCheck.checked && rentCheck.checked) {
                    hidePrices('sales');
                    showPrices('rent');
                }

                if ( ! saleCheck.checked &&  ! rentCheck.checked) {
                    hidePrices('sales');
                    hidePrices('rent');
                }
            }

            checkPrices();

            $('body').on('change', '#contactChoice1', function () {
                checkPrices();
            });
            
            $('body').on('change', '#contactChoice2', function () {
                checkPrices();
            });

            $('body').on('click', '[data-remove-property-file]', function (e) {
                $(this).parent('.input-group').next('br').remove();
                $(this).parent('.input-group').remove();
            });

            $('body').on("input", "[data-prices-price] input", function() {
                this.value = this.value.replace(/\D/g,'');
            });

            $('body').on("input", "[data-prices-sc-sale] input", function() {
                this.value = this.value.replace(/\D/g,'');
            });

            $('body').on("input", "[data-prices-rate-sale] input", function() {
                this.value = this.value.replace(/\D/g,'');
            });

            $('body').on("input", "[data-prices-pw-rent] input", function() {
                this.value = this.value.replace(/\D/g,'');
            });
            
            $('body').on("input", "[data-prices-pm-rent] input", function() {
                this.value = this.value.replace(/\D/g,'');
            });
        });

    </script>
    <!-- <script src="/assets/js/cropper.common.js"></script> -->
    <script src="/assets/js/cropper.js"></script>

    <script src="/assets/js/cropper-main.js"></script>

@endsection
