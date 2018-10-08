<?php

namespace App\Http\Controllers;

use App\Models\Admin\Property;
use App\Models\Admin\PropertyContent;
use App\Models\Admin\Service;
use App\Models\Admin\ServiceContent;
use Illuminate\Http\Request;
use App\Models\Admin\Language;
use App\Http\Helpers\Languages;
use App\Models\Admin\Location;
use App\Models\Admin\Category;

class SearchController extends Controller
{
    protected $default_language, $static_data;
    public function __construct()
    {
        $this->default_language = default_language();

        $this->static_data = static_home();
    }

    public function index(Request $request){
        $default_language = $this->default_language;
        $static_data = $this->static_data;

        $term = $request->keyword ? $request->keyword : '';

        $property_ids = PropertyContent::where('name', 'LIKE', '%'.$term.'%')->get()->pluck('property_id');

        // If filtering by features is enabled
        $feature_ids = [];
        if(get_setting('filter_by_features', 'property')){
            if($request->features){
                foreach($request->features as $feature){        
                    $p = Property::whereNot('features', 'LIKE', '%"' . $feature . '"%')->pluck('id')->toArray();
                    array_push($feature_ids, $p);
                }   
                if(count($feature_ids)) $feature_ids = array_unique(array_reduce($feature_ids, 'array_merge', []));
            }
        }

        $properties = Property::with(['images', 'contentload' => function($query) use($default_language){
            $query->where('language_id', $default_language->id);
        }])->where('status', 1)->whereIn('id', $property_ids)->whereNotIn('id', $feature_ids);


        if($request->location_id) {
            $properties->where('location_id', $request->location_id);
        }
        if($request->category_id) {
            $properties->where('category_id', $request->category_id);
        }

        $properties = $properties->get();
            
        if(get_setting('services_allowed', 'service')){

            $service_ids = ServiceContent::where('name', 'LIKE', '%'.$term.'%')->get()->pluck('service_id');
        
            $services = Service::with(['images', 'contentload' => function($query) use($default_language){
                $query->where('language_id', $default_language->id);
            }])->where('status', 1)->whereIn('id', $service_ids);

            if($request->location_id) {
                $services->where('location_id', $request->location_id);
            }
            if($request->category_id) {
                $services->where('category_id', $request->category_id);
            }

            $services = $services->get();
        } else {
            $services = [];
        }

        if(get_setting('allow_featured_properties','property')){
            $featured_properties = Property::with(['images', 'contentload' => function($query) use($default_language){
                $query->where('language_id', $default_language->id);
            }])->where('status', 1)->where('featured', 1)->inRandomOrder()->take(6)->get();
        }else{
            $featured_properties = null;
        }

        if(get_setting('services_allowed', 'service') && get_setting('allow_featured_services', 'service')){
            $featured_services = Service::with(['images', 'contentload' => function($query) use($default_language){
                $query->where('language_id', $default_language->id);
            }])->where('status', 1)->where('featured', 1)->inRandomOrder()->take(6)->get();
        }else{
            $featured_services = null;
        }

        return view('home.search', compact(
            'services', 
            'static_data', 
            'default_language', 
            'featured_properties', 
            'featured_services',
            'services', 
            'properties'
        ));
    }

    public function searchSale(Request $request)
    {
        $static_data = $this->static_data;
        $properties = Property::where('status', 1);
        if (isset($request->type)) {
            $properties->where('category_id', $request->type);
        }
        if (isset($request->beds)) {
            $properties->each(function ($value) use ($request) {
                return $value->property_info['bedrooms'] == $request->beds;
            });
        }
        if (isset($request->lower) && isset($request->upper)) {
            $properties->each(function ($value) use ($request) {
                return $value->prices['service_charge'] > $request->lower && $value->prices['service_charge'] < $request->upper;
            });
        }
        $search_properties = $properties->paginate(3);

        return view('realstate.sale', compact('static_data', 'search_properties'));
    }

    public function search($language = Languages::DEFAULT_LANGUAGE)
    {
        Languages::localizeApp($language);

        $page = 'search';
        // Get Static Data
        $static_data = $this->static_data;

        $default_language = $this->default_language;

        $languages = Language::all();

        $languageId = 1;

        foreach ($languages as $lang) {
            if ($lang->code == $language) {
                $languageId = $lang->id;
            }
        }

        $title = 'Search | Ayling';

        $locations = Location::with([
            'contentload' => function($query) use ($languageId) {
                $query->where('language_id', $languageId);
            },
        ])
        ->get();

        $categories = Category::with([
            'contentload' => function($query) use ($languageId) {
                $query->where('language_id', $languageId);
            },
        ])
        ->get();

        $recent_properties = Property::orderBy('created_at', 'desc')
        ->where('status', 1)
        ->take(Property::RECENT_PROPERTIES)
        ->get();

        $minPrice = 0;
        $maxPrice = 0;
        $prices = Property::select("prices")
        ->where('status', 1)
        ->get();
        
        $prices = allPrices($prices);
        
        $minPrice = $prices->min();
        $maxPrice = $prices->max();

        $properties = [];
        
        $filter = [
            'status' => false,
            'type' => false,
            'location' => false,
            'bed' => false,
            'minSearchPrice' => false,
            'maxSearchPrice' => false,
        ];

        $reference = request('reference');

        $status = request('status');

        $type = request('type');

        $location = request('location');

        $bed = request('bed');

        $minSearchPrice = request('min-price');

        $maxSearchPrice = request('max-price');

        if ( ! empty($reference)) {
            
            $properties = Property::with([
                'property_status',
                'currency',
                'images', 
                'prop_location.contentload' => function($query) use ($languageId) {
                    $query->where('language_id', $languageId);
                },
                'contentload' => function($query) use ($languageId) {
                    $query->where('language_id', $languageId);
                },
            ])
            ->where('property_info->property_reference', 'like', "%$reference%")
            ->where('status', 1)
            ->paginate(10);
        } else {
            
            if ($status != 'all') {
                $filter['status'] = true;
            }

            if ($type != 'all') {
                $filter['type'] = true;
            }
            
            if ($location != 'all') {
                $filter['location'] = true;
            }
            
            if ($bed != 'all') {
                $filter['bed'] = true;
            }
            
            if ($minSearchPrice) {
                $filter['minSearchPrice'] = true;
            }
            
            if ($maxSearchPrice) {
                $filter['maxSearchPrice'] = true;
            }
            
            $properties = Property::with([
                'category.contentload' => function($query) use ($languageId) {
                    $query->where('language_id', $languageId);
                },
                'prop_location.contentload' => function($query) use ($languageId) {
                    $query->where('language_id', $languageId);
                },
                // 'contentload' => function($query) use ($languageId) {
                //     $query->where('language_id', $languageId);
                // },
            ])
            ->where('status', 1)
            ->get();

            $filtered = $properties->filter(function ($item, $key) use (
                    $filter, 
                    $status, 
                    $type, 
                    $location, 
                    $bed, 
                    $minSearchPrice, 
                    $maxSearchPrice
                ) {
                
                $isReturnItem = true;
                
                if ($filter['minSearchPrice'] && $filter['maxSearchPrice']) {
                    if (
                        (
                            ( ! empty($item->prices['price']) && $item->prices['price'] >= $minSearchPrice) || 
                            ( ! empty($item->prices['week']) && $item->prices['week'] >= $minSearchPrice) || 
                            ( ! empty($item->prices['month']) && $item->prices['month'] >= $minSearchPrice)
                        ) &&
                        (
                            ( ! empty($item->prices['price']) && $item->prices['price'] <= $maxSearchPrice) || 
                            ( ! empty($item->prices['week']) && $item->prices['week'] <= $maxSearchPrice) || 
                            ( ! empty($item->prices['month']) && $item->prices['month'] <= $maxSearchPrice)
                        )
                    ) {
                        $isReturnItem = true;
                    } else {
                        $isReturnItem = false;
                    }
                }

                if ($filter['status'] && $isReturnItem) {
                    if ($status == 'sale') {
                        $isReturnItem = $item->sales == 1 ? true : false;
                    }
                    if ($status == 'rent') {
                        $isReturnItem = $item->rentals == 1 ? true : false;
                    }
                }

                if ($filter['type'] && $isReturnItem) {
                    $isReturnItem = $item->category->contentload->name == $type ? true : false;
                }
                
                if ($filter['location'] && $isReturnItem) {
                    $isReturnItem = $item->prop_location->contentload->location == $location ? true : false;
                }
                
                if ($filter['bed'] && $isReturnItem) {
                    $isReturnItem = ( ! empty($item->property_info['bedrooms']) && (int) $item->property_info['bedrooms'] >= (int) $bed) ? true : false;
                }
                
                return $isReturnItem;
            });

            $ids = $filtered->map(function ($item, $key) {
                return $item->id;
            });

            $properties = Property::with([
                'property_status',
                'currency',
                'images', 
                'prop_location.contentload' => function($query) use ($languageId) {
                    $query->where('language_id', $languageId);
                },
                'contentload' => function($query) use ($languageId) {
                    $query->where('language_id', $languageId);
                },
            ])
            ->whereIn('id', $ids)
            ->where('status', 1)
            ->paginate(10);
        }

        $properties->appends(request()->all());

        $propertiesCount = $properties->total();
         
        return view('sotogrande.search', compact(
            'static_data',
            'title',
            'languages',
            'language',
            'page',
            'locations',
            'categories',
            'recent_properties',
            'minPrice',
            'maxPrice',
            'properties',
            'propertiesCount'
        ));
    }
}
