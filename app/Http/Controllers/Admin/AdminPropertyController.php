<?php

namespace App\Http\Controllers\Admin;

use App\Common\Utility;
use App\Models\Admin\Language;
use App\Models\Admin\Location;
use App\Models\Admin\LocationContent;
use App\Models\Admin\CountryContent;
use App\Models\Admin\Property;
use App\Models\Admin\CategoryContent;
use App\Models\Admin\PropertyContent;
use App\Models\Admin\PropertyDate;
use App\Models\Admin\Feature;
use App\Models\Admin\PropertyFile;
use App\Models\Admin\PropertyPdfFile;
use App\Models\Admin\PropertyStatus;
use App\Models\Admin\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\Image;
use Carbon\Carbon;
use PDF;
use Intervention\Image\Facades\Image as InterventionImage;

class AdminPropertyController extends Controller
{
    private $validation_rules, 
            $validation_messages;
    protected $languages;
    protected $static_data;
    public function __construct(Request $request){
        $this->static_data = static_home();
        //dd($request->all());
        $this->validation_rules = [
            // 'business_hours.sat'      => 'business_hours',
            // 'business_hours.week'     => 'business_hours',
            // 'business_hours.sun'      => 'business_hours',
            // 'currency_id'               => 'required',
            'category_id'             => 'required',
            'sale_rent'             => 'required',
            // 'type_id'              => 'required',
            'country_id'             => 'required',
            'location_id'             => 'required',
            // 'location.address'        => 'required',
            // 'location.city'           => 'required',
            // 'location.country'        => 'required',
            // 'location.geo_lon'        => 'required',
            // 'location.geo_lat'        => 'required',
            // 'contact.tel1'            => 'phone_number',
            // 'contact.tel2'            => 'phone_number',
            // 'contact.fax'             => 'phone_number',
            // 'contact.email'           => 'email',
            // 'contact.web'             => 'website',
            // 'rooms'                   => 'required|integer',
            // 'guest_number'            => 'required|integer',
            // 'property_info.internal_area' => 'required|integer',
            // 'property_info.external_area' => 'required|integer',
            // 'property_info.bedrooms'  => 'required|integer',
            // 'property_info.bathrooms' => 'required|integer',
            'property_info.property_reference' => 'required',
            // 'prices.d_5'              => 'integer|required',
            // 'prices.d_15'             => 'integer|required',
            // 'prices.d_30'             => 'integer|required',
            // 'fees.city_fee'           => 'integer',
            // 'fees.cleaning_fee'       => 'integer',
        ];

        // if (isset($request['sale_rent']) && in_array('rentals', $request['sale_rent'])) {
        //     $this->validation_rules['prices.week'] = 'required|integer';
        //     $this->validation_rules['prices.month'] = 'required|integer';
        // }

        // if (isset($request['sale_rent']) && in_array('sales', $request['sale_rent'])) {
        //     $this->validation_rules['prices.price'] = 'required|integer';
        //     $this->validation_rules['prices.service_charge'] = 'required|integer';
        //     $this->validation_rules['prices.rates'] = 'required|integer';
        // }

        $this->validation_messages = [
            'currency_id'                        => get_string('required_field'),
            'business_hours.sat.business_hours'  => get_string('business_hours_validation'),
            'business_hours.week.business_hours' => get_string('business_hours_validation'),
            'business_hours.sun.business_hours'  => get_string('business_hours_validation'),
            'contact.tel1.phone_number'          => get_string('phone_number_validation'),
            'contact.tel2.phone_number'          => get_string('phone_number_validation'),
            'contact.fax.phone_number'           => get_string('phone_number_validation'),
            'contact.web.website'                => get_string('website_validation'),
            'location.address.required'          => get_string('address_required'),
            'location.city.required'             => get_string('city_required'),
            'location.country.required'          => get_string('country_required'),
            'location.geo_lon.required'          => get_string('google_address_required'),
            'location.geo_lat.required'          => get_string('google_address_required'),
            'contact.email.email'                => get_string('email_invalid'),
            'category_id.required'               => get_string('category_required'),
            'rooms.required'                     => get_string('required_field'),
            'prices.d_15'                        => get_string('required_field'),
            'prices.d_5'                         => get_string('required_field'),
            'prices.d_30'                        => get_string('required_field'),
            'prices.price.required'                        => get_string('required_field'),
            'prices.service_charge.required'     => get_string('required_field'),
            'prices.rates.required'              => get_string('required_field'),
            'prices.week.required'            => get_string('required_field'),
            'prices.month.required'           => get_string('required_field'),
            'guest_number.required'              => get_string('required_field'),
            // 'type_id.required'                => get_string('type_required'),
            'location_id.required'               => get_string('location_required'),
            'property_info.internal_area.required' => get_string('required_field'),
            'property_info.external_area.required' => get_string('required_field'),
            'property_info.bedrooms.required' => get_string('required_field'),
            'property_info.bathrooms.required' => get_string('required_field'),
            'property_info.property_reference.required' => get_string('required_field'),
            'location_id.required' => get_string('required_field'),
            'country_id.required' => get_string('required_field'),
        ];
        $this->languages = Language::all();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Property::orderBy('featured','desc')
            ->orderBy('slider', 'desc')
            ->orderBy('created_at','desc')
            ->paginate(10);
        
        $sale_properties = Property::where('sales', 1)
            ->orderBy('featured_sale','desc')
            ->orderBy('slider', 'desc')
            ->orderBy('created_at','desc')
            ->paginate(10);
        
        $sale_properties_count = Property::where('sales', 1)
            ->where('featured_sale', 1)
            ->count();

        $rent_properties = Property::where('rentals', 1)
            ->orderBy('featured_rent','desc')
            ->orderBy('slider', 'desc')
            ->orderBy('created_at','desc')
            ->paginate(10);
        
        $rent_properties_count = Property::where('rentals', 1)
            ->where('featured_rent', 1)
            ->count();
        
        $statuses = PropertyStatus::all();

        return view('admin.property.index', compact(
            'properties', 
            'sale_properties', 
            'rent_properties', 
            'sale_properties_count', 
            'rent_properties_count',
            'statuses'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $default_language = Language::where('default', 1)->first();
        $categories = CategoryContent::where('language_id', $default_language->id)->get()->pluck('name', 'category_id');
        $locations = Location::all();
        $countries = CountryContent::where('language_id', $default_language->id)->get()->pluck('location', 'location_id');
        $languages = $this->languages;
        $features = Feature::all();
        $currencies = Currency::all();
        return view('admin.property.create', compact(
            'categories', 
            'languages', 
            'features', 
            'default_language', 
            'locations', 
            'countries',
            'currencies'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $languages = $this->languages;
        // Validating the Property
        if($this->validateService($request)){
            return $this->validateService($request);
        }

        // Store to base
        $data = $request->except('markers', '_token', 'action', 'images', 'name', 'description');
        $notTrimmed = $data['property_info']['property_reference'];
        $data['property_info']['property_reference'] = trim($notTrimmed);
        $data['status'] = 1;
        $data['featured'] = isset($request->featured) ? 1 : 0;
        $default_language = Language::where('default', 1)->first();
        $data['alias'] = Utility::alias($request->name[$default_language->id], [], 'property');
        if(in_array('sales', $data['sale_rent']) && in_array('rentals', $data['sale_rent'])) {
            $data['sales'] = 1;
            $data['rentals'] = 1;
        } else if (in_array('sales', $data['sale_rent'])) {
            $data['sales'] = 1;
        } else if (in_array('rentals', $data['sale_rent'])) {
            $data['rentals'] = 1;
        }

        $property = Property::create($data);

        if(isset($request->images)){
            foreach($request->images as $image){
                Image::create([
                    'image' => $image,
                    'imageable_id' => $property->id,
                    'imageable_type' => 'App\Models\Admin\Property',
                    'status' => isset($request['main_photo']) && $request['main_photo'] == $image ? 1 : 0,
                ]);

                $img = InterventionImage::make(public_path() . '/images/data/'. $image);
                $watermarkPath = public_path('/images/watermark.png');
                if(File::exists($watermarkPath)) {
                    $watermark = InterventionImage::make($watermarkPath);
                    $watermarkWidth = $watermark->width();
                    $imgWidth = $img->width();
                    if ($watermarkWidth > $imgWidth) {
                        // resize the image to a width and constrain aspect ratio (auto height)
                        $watermark->resize($imgWidth - 20, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    }
                    $img->insert($watermark, 'center', 10, 10);
                }
                $img->save();
            }
        }

        if($request->file('files')){
            foreach($request->file('files') as $file){
                $fileName = Carbon::now()->format('Y_m_d_H_i_s_u').'_'.str_replace(' ', '_', $file->getClientOriginalName());
                PropertyFile::create(['property_id' => $property->id, 'name' => $file->getClientOriginalName(),  'file_name' => $fileName, 'path' => url('/').'/files/'.$fileName]);
                $file->move(public_path().'/files', $fileName);
            }
        }

        if ($request->has('default_file')) {
            PropertyFile::create([
                    'property_id' => $property->id, 
                    'name' => $request->default_file, 
                    'file_name' => $request->default_file, 
                    'path' => '/files/'.$request->default_file
                ]);
        }

        // Updating the Content
        foreach($languages as $language) {

            unset($data);
            // Getting name
            $data['name'] = $request->name[$language->id];

            // Getting content from textarea
            $data['description'] = $request->description[$language->id];
            $data['property_id'] = $property->id;
            $data['language_id']  = $language->id;

            // Create the Property Content
            PropertyContent::create($data);
        }

        // Create available dates
        PropertyDate::create(['dates' => null, 'property_id' => $property->id]);
        $this->createPdfFile($property);
        // Redirect after saving
        return redirect('admin/property');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Why do we need to show this? You will see it in the front-end.
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $default_language = Language::where('default', 1)->first();
        $categories = CategoryContent::where('language_id', $default_language->id)->get()->pluck('name', 'category_id');
        $languages = $this->languages;
        $locations = Location::all();
        $countries = CountryContent::where('language_id', $default_language->id)->get()->pluck('location', 'location_id');
        $features = Feature::all();
        $property = Property::findOrFail($id);
        $currencies = Currency::all();
        return view('admin.property.edit', compact(
            'property', 
            'categories', 
            'default_language', 
            'languages', 
            'features', 
            'locations', 
            'countries',
            'currencies'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $languages = $this->languages;
        // Validating the Property
        
        if($this->validateServiceUpdate($request, $id)){
            return $this->validateServiceUpdate($request, $id);
        }

        $data = $request->except('markers', '_token', 'action', 'images', 'name', 'description');
        $notTrimmed = $data['property_info']['property_reference'];
        $data['property_info']['property_reference'] = trim($notTrimmed);
        $property = Property::findOrFail($id);
        $property->touch();
        $default_language = Language::where('default', 1)->first();
        $data['featured'] = isset($request->featured) ? 1 : 0;

        // Update Alias
        if($request->alias){
            if($request->alias == ''){
                $data['alias'] = $property->alias;
            }else{
                $alias = Utility::fixAlias($request->alias);
                $c = count(Property::where('alias', 'LIKE', '%'. $alias .'%')->where('id', '<>', $property->id)->get());
                if($c){
                    $data['alias'] = $alias .'-'. $c;
                }else{
                    $data['alias'] = $alias;
                }
            }
        }
        
        if (isset($data['sale_rent'])) {
           if(in_array('sales', $data['sale_rent']) && in_array('rentals', $data['sale_rent'])) {
                $data['sales'] = 1;
                $data['rentals'] = 1;
            } else if (in_array('sales', $data['sale_rent'])) {
                $data['sales'] = 1;
                $data['rentals'] = 0;
            } else if (in_array('rentals', $data['sale_rent'])) {
                $data['sales'] = 0;
                $data['rentals'] = 1;
            } 
        }
        

        $property->update($data);
        $old_images = $property->images;
        
        if(isset($request->images)){
            foreach($old_images as $image){
                if(in_array($image->image, $request->images)){
                    $image->delete();
                }
            }
            $old_images = $old_images->toArray();
            foreach($request->images as $image){
                if(!in_array($image, $old_images)){
                    Image::create([
                        'image' => $image,
                        'imageable_id' => $property->id,
                        'imageable_type' => 'App\Models\Admin\Property',
                        'status' => isset($request['main_photo']) && $request['main_photo'] == $image ? 1 : 0,
                    ]);
                    
                    $img = InterventionImage::make(public_path() . '/images/data/'. $image);
                    $watermarkPath = public_path('/images/watermark.png');
                    if(File::exists($watermarkPath)) {
                        $watermark = InterventionImage::make($watermarkPath);
                        $watermarkWidth = $watermark->width();
                        $imgWidth = $img->width();
                        if ($watermarkWidth > $imgWidth) {
                            // resize the image to a width and constrain aspect ratio (auto height)
                            $watermark->resize($imgWidth - 20, null, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                        }
                        $img->insert($watermark, 'center');
                    }
                    $img->save();
                }
            }
        }

        if($request->file('files')){
            foreach($request->file('files') as $file){
                $fileName = Carbon::now()->format('Y_m_d_H_i_s_u').'_'.str_replace(' ', '_', $file->getClientOriginalName());
                PropertyFile::create(['property_id' => $property->id, 'name' => $file->getClientOriginalName(), 'file_name' => $fileName, 'path' => url('/').'/files/'.$fileName]);
                $file->move(public_path().'/files', $fileName);
            }
        }

        // Updating the Content
        foreach($languages as $language) {

            unset($data);
            // Getting name
            $data['name'] = $request->name[$language->id];

            // Getting content from textarea
            $data['description'] = $request->description[$language->id];
            $data['property_id'] = $property->id;
            $data['language_id']  = $language->id;

            // Update the Category Content
            $category_content = PropertyContent::where(['language_id' => $language->id, 'property_id' => $id])->first();
            $category_content->update($data);
        }
        $this->createPdfFile($property);

        // Redirect after saving
        return redirect('admin/property');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if($request->ajax()){
            $this->delete($id);
            return response()->json(get_string('success_delete'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }


    // Handling mass deletion
    public function massDestroy(Request $request)
    {
        if($request->ajax() && isset($request->id)){
            $ids = $request->id;
            foreach ($ids as $id){
                $this->delete($id);
            }
            return response()->json(get_string('success_delete'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Activating post
    public function activate(Request $request, $id)
    {

        if($request->ajax()) {
            $property = Property::findOrFail($id);
            $property->status = 1;
            $property->touch();
            $property->save();
            return response()->json(get_string('success_activate'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Making Featured
    public function makeFeaturedSale(Request $request, $id)
    {

        if($request->ajax()) {
            $properties = Property::where('sales', 1)->where('featured_sale', 1)->get();
            if ($properties->count() >= Property::FEATURED_COUNT) {
                return response()->json('You can not add more '.Property::FEATURED_COUNT.' items', 400);
            }
            $property = Property::findOrFail($id);
            if ($property->status == 0) {
                return response()->json('You can not add this item, it sold', 400);
            }
            $property->featured_sale = 1;
            $property->touch();
            $property->save();
            return response()->json(get_string('success_service_featured'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Make Default
    public function makeDefaultSale(Request $request, $id)
    {
        if($request->ajax()) {
            $property = Property::findOrFail($id);
            $property->featured_sale = 0;
            $property->position = 0;
            $property->touch();
            $property->save();
            return response()->json(get_string('success_service_default'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Making Featured
    public function makeFeaturedRent(Request $request, $id)
    {

        if($request->ajax()) {
            $properties = Property::where('rentals', 1)->where('featured_rent', 1)->get();
            if ($properties->count() >= Property::FEATURED_COUNT) {
                return response()->json('You can not add more '.Property::FEATURED_COUNT.' items', 400);
            }
            $property = Property::findOrFail($id);
            $property->featured_rent = 1;
            $property->touch();
            $property->save();
            return response()->json(get_string('success_service_featured'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Make Default
    public function makeDefaultRent(Request $request, $id)
    {

        if($request->ajax()) {
            $property = Property::findOrFail($id);
            $property->featured_rent = 0;
            $property->position = 0;
            $property->touch();
            $property->save();
            return response()->json(get_string('success_service_default'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    public function changePositionSale(Request $request, $id)
    {
        if($request->ajax()) {
            $property = Property::findOrFail($id);
            $property->position_sale = $request->value;
            $property->touch();
            $property->save();
            return response()->json('Position successfuly changed', 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    public function changePositionRent(Request $request, $id)
    {
        if($request->ajax()) {
            $property = Property::findOrFail($id);
            $property->position_rent = $request->value;
            $property->touch();
            $property->save();
            return response()->json('Position successfuly changed', 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Deactivating post
    public function deactivate(Request $request, $id)
    {

        if($request->ajax()) {
            $property = Property::findOrFail($id);
            $property->status = 0;
            $property->featured_rent = 0;
            $property->featured_sale = 0;
            $property->position_sale = 0;
            $property->position_rent = 0;
            $property->slider = 0;
            $property->touch();
            $property->save();
            return response()->json(get_string('success_deactivate'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Validating the Property upon creating
    public function validateService(Request $request)
    {

        $languages = $this->languages;

        //validate property_reference must be unique
        $propertyInfos = Property::get(['property_info']);
        
        $propertyReferences = [];

        $propertyReference = $request->property_info['property_reference'];

        foreach ($propertyInfos as $propertyInfo) {
            $propertyReferences[] = $propertyInfo->property_info['property_reference'];
        }

        if (in_array($propertyReference, $propertyReferences)) {
            return Redirect::back()->withInput()->withErrors([
                'property_reference' => 'This value already exists, please try another one!'
            ]);
        }

        $validator = Validator::make($request->all(), $this->validation_rules, $this->validation_messages);

        if($validator->fails()){
            // if(isset($request->images)){
            //     foreach($request->images as $image){
            //         $path = public_path('images/data/'.$image);
            //         if(File::exists($path)){
            //             File::delete($path);
            //         }
            //     }
            // }
            return Redirect::back()->withInput()->withErrors($validator);
        }else{
            foreach($languages as $language) {
                $validator = Validator::make($request->all(), [
                    'name.' . $language->id . '' => 'required|max:50',
                    'description.' . $language->id . '' => 'required|min:100|max:5000',
                ], [
                    'name.'.$language->id.'.required'           => get_string('required_field'),
                    'name.'.$language->id.'.max'         => get_string('max_100'),
                    'description.'.$language->id.'.required'    => get_string('required_field'),
                    'description.'.$language->id.'.min'         => get_string('min_100'),
                ]);
                if($validator->fails()) {
                    // if (isset($request->images)) {
                    //     foreach ($request->images as $image) {
                    //         $path = public_path('images/data/' . $image);
                    //         if (File::exists($path)) {
                    //             File::delete($path);
                    //         }
                    //     }
                    // }
                    return Redirect::back()->withInput()->withErrors($validator);
                }
            }
        }
    }

    // Validating the Property upon updating
    public function validateServiceUpdate(Request $request, $id)
    {
        $languages = $this->languages;
        $validator = Validator::make($request->all(), $this->validation_rules, $this->validation_messages);
        $images = Property::findOrFail($id)->images->toArray();

        if($validator->fails()){
            if(isset($request->images)){
                foreach($request->images as $image){
                    if(!in_array_r($image, $images)){
                        $path = public_path('images/data/'.$image);
                        if(File::exists($path)){
                            File::delete($path);
                        }
                    }
                }
            }
            return Redirect::back()->withInput()->withErrors($validator);
        }else{
            foreach($languages as $language) {
                $validator = Validator::make($request->all(), [
                    'name.' . $language->id . '' => 'required|max:50',
                    'description.' . $language->id . '' => 'required|min:100|max:5000',
                ], [
                    'name.'.$language->id.'.required'           => get_string('required_field'),
                    'name.'.$language->id.'.max'         => get_string('max_100'),
                    'description.'.$language->id.'.required'    => get_string('required_field'),
                    'description.'.$language->id.'.min'         => get_string('min_100'),
                ]);
                if($validator->fails()) {
                    if (isset($request->images)) {
                        foreach ($request->images as $image) {
                            $path = public_path('images/data/' . $image);
                            if (File::exists($path)) {
                                File::delete($path);
                            }
                        }
                    }
                    return Redirect::back()->withInput()->withErrors($validator);
                }
            }
        }
    }

    // Autocomplete
    public function autocomplete(Request $request)
    {

        if($request->ajax()) {
            $term = $request->get('term') ? $request->get('term') : '';
            $results = [];
            $default = Language::where('default', 1)->first();

            $properties = PropertyContent::where([['name', 'LIKE', '%' . $term . '%'],['language_id', '=', $default->id]])->take(5)->get();
            foreach ($properties as $property) {
                $results[] = ['id' => $property->id, 'name' => $property->name];
            }
            return $results;
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Searching for Properties
    public function search(Request $request)
    {
        $term = request('term') ? request('term') : '';
        
        $property_ids = PropertyContent::where('name', 'LIKE', '%'.$term.'%')
            ->get()
            ->pluck('property_id');

        $ref_ids = [];
        
        $props = Property::get([
            'id', 
            'property_info'
        ]);
        
        foreach ($props as $prop) {
            if ($prop->property_info['property_reference'] == $term) {
                $ref_ids[] = $prop->id;
            }
        }

        if ( ! empty($ref_ids)) {
            foreach ($ref_ids as $id) {
                $property_ids[] = $id;
            }
        }

        $properties = Property::whereIn('id', $property_ids)
            ->orderBy('featured','desc')
            ->orderBy('slider', 'desc')
            ->orderBy('created_at','desc')
            ->paginate(10);
        $properties->appends(request()->only('term'));

        $statuses = PropertyStatus::all();

        return view('admin.property.search', compact('properties', 'statuses'));
    }

    // Helper function for delete
    public function delete($id)
    {

        // Getting the post
        $property = Property::findOrFail($id);

        // Unlinking the images
        if($property->images){
            foreach($property->images as $image){
                $path = public_path('images/data/' . $image->image);
                if(File::exists($path) && $image->image != '/images/no_image.jpg') {
                    File::delete($path);
                }
                $image->delete();
            }
        }

        if($property->files){
            foreach($property->files as $file) {
                $path = public_path("/files/$file->file_name");
                if($file->file_name != 'findaproperty-agreement.doc' && File::exists($path)){
                    File::delete($path);
                }
                $file->delete();
            }
        }

        //deleting pdf
        if ($property->pdfFile) {
            $path = public_path("/files/" . $property->pdfFile->file_name . ".pdf");

            if(File::exists($path)){
                File::delete($path);
            }

            $property->pdfFile->delete();
        }

        // Deleting the Content
        $languages = $this->languages;
        foreach($languages as $language){
            $property->content($language->id)->delete();
        }

        $property->prop_dates()->delete();

        // Deleting the post
        $property->delete();
    }

    public function updateDates(Request $request)
    {
        // Update available days
        $today = date("m-d-Y");
        $property_dates = PropertyDate::where('property_id', $request->property_id)->first();
        $allDates = explode(',', $request->dates);
        $allDates = array_map('trim', $allDates);
        $validDates = [];
        foreach ($allDates as $date) {
            if ($date > $today) {
                $validDates[] = $date;
            }
        }
        $data['dates'] = $validDates;
        $property_dates->update($data);

        return redirect('admin/property');
    }

    public function slider(Request $request, $id)
    {
        if($request->ajax()) {
            $properties = Property::where('slider', 1)->get();
            if ($properties->count() >= Property::SLIDER_COUNT && $request->value) {
                return response()->json('You can not add more '.Property::SLIDER_COUNT.' items', 400);
            }
            $property = Property::findOrFail($id);
            if ($property->status == 0) {
                return response()->json('You can not add this item, it sold', 400);
            }
            $property->slider = $request->value;
            $property->touch();
            $property->save();
            if ($request->value) {
                return response()->json('Added to slider', 200);
            }
            return response()->json('Removed from slider', 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    public function deleteFile(Request $request, $id)
    {
        if($request->ajax()){
            $file = PropertyFile::find($id);
            $path = public_path().'/files/'.$file->file_name;
            if ($file->file_name != 'findaproperty-agreement.doc') {
                if(File::exists($path)) {
                    File::delete($path);
                }
                
            }
            $file->delete();
            return response()->json(get_string('success_delete'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    public function createPdfFile($property)
    {
        $static_data = $this->static_data;
        $default_language = Language::where('default', 1)->first();
        $features = Feature::all();
        $fileName = Carbon::now()->format('Y_m_d_H_i_s_u').'_'.str_replace(' ', '_', $property->contentload['name']);
        if ($property->pdfFile) {
            $path = public_path("/files/" . $property->pdfFile->file_name . ".pdf");
            $propertyPdfFile = PropertyPdfFile::where('property_id', $property->id)->first();
            if(File::exists($path)) {
                File::delete($path);
            }
            $propertyPdfFile->update(['name' => $property->alias,  'file_name' => $fileName, 'path' => url('/').'/files/'.$fileName.'.pdf']);
        } else {
            $propertyPdfFile = PropertyPdfFile::create(['property_id' => $property->id, 'name' => $property->alias,  'file_name' => $fileName, 'path' => public_path().'/files/'.$fileName.'.pdf']);
        }
        $pdf = PDF::setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true, 
                'defaultFont' => 'sans-serif'
            ])
            ->loadView('realstate.pdf.property', compact('property', 'features', 'default_language', 'static_data'))
            ->save(public_path('/files/'.$fileName.'.pdf'));
    }

    public function setStatus (Request $request, $id)
    {
        if($request->ajax()) {
            $property = Property::findOrFail($id);
            $property->status_id = request('status_id') ? request('status_id') : null;
            $property->touch();
            $property->save();
            return response()->json('status changed', 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }
}
