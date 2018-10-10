<?php

namespace App\Http\Controllers;

use App\Models\Admin\Property;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\Location;
use App\Models\Admin\Country;
use App\Models\Admin\Page;
use App\Models\Admin\Language;
use App\Http\Helpers\Languages;

class SaleController extends Controller
{
    protected $static_data, $default_language;

    public function __construct()
    {
        $this->static_data = static_home();

        $this->default_language = default_language();
    }

    public function index($language = Languages::DEFAULT_LANGUAGE)
    {
        Languages::localizeApp($language);

        $page = 'sale';
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

        $title = 'Sale | Ayling';

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
        ->where('sales', 1)
        ->where('status', 1)
        ->orderBy('created_at', 'desc')
        ->paginate(9);

        $propertiesCount = $properties->total();

        // $static_data = $this->static_data;

        // $default_language = $this->default_language;

        // $title = 'Sale | Findaproperty';

        // $countries = Country::all();

        // $locations = Location::all();

        // $categories = Category::get();

        // $recent_properties = Property::with([
        //         'property_status',
        //         'currency'
        //     ])
        //     ->orderBy('created_at', 'desc')
        //     ->take(Property::RECENT_PROPERTIES)
        //     ->where('status', 1)
        //     ->get();
        
        // if (isset($request->search) && $request->search) {
        //     $ids = [];

        //     $propIds = [];

        //     $priceIds = [];

        //     $categoryIds = [];

        //     $countryIds = [];

        //     $locationIds = [];

        //     $bedIds = [];

        //     $currencyId = request('currency-id');

        //     if (isset($request->property)) {
        //         $saleProperties = Property::select([
        //             "id",
        //             "property_info"
        //         ])->where('sales', '=', 1)
        //         ->where('status', 1)
        //         ->get();

        //         if ( ! empty($saleProperties)) {
        //             foreach ($saleProperties as $prop) {
        //                 if ($prop['property_info']['property_reference'] == $request->property) {
        //                     $propIds[] = $prop['id'];
        //                 }
        //             }
        //         }

        //         $ids = $propIds;
        //     } else {
        //         $salePrices = Property::select([
        //             "id",
        //             "prices",
        //             "currency_id"
        //         ])->where('sales', 1)
        //         ->where('currency_id', $currencyId)
        //         ->where('status', 1)
        //         ->get();
                
        //         foreach ($salePrices as $price) {
        //             if ($price['prices']['price'] && $price['prices']['price'] >= $request->lower && $price['prices']['price'] <= $request->upper)
        //             {
        //                 $priceIds[] = $price['id'];
        //             }
        //         }
                
                
        //         $ids = $priceIds;
                
        //         if (isset($request->type)) {
        //             $saleCategories = Property::select([
        //                 "id",
        //                 "category_id"
        //             ])->where('sales', '=', 1)
        //             ->where('status', 1)
        //             ->where('category_id', '=', $request->type)
        //             ->get();

        //             if (! empty($saleCategories)) {
        //                 foreach ($saleCategories as $cat) {
        //                     $categoryIds[] = $cat['id'];
        //                 }
        //             }

        //             if (empty($ids)) {
        //                 $ids = $categoryIds;
        //             } else {
        //                 $ids = array_intersect($ids, $categoryIds);
        //             }
        //         }

        //         // if (isset($request->country)) {
        //             // $saleCountries = Property::select([
        //             //     "id",
        //             //     "country_id",
        //             //     'currency_id'
        //             // ])->where('sales', 1)
        //             // ->where('country_id', $request->country)
        //             // ->where('currency_id', $currencyId)
        //             // ->where('status', 1)
        //             // ->get();

        //             // $saleCountries = Property::whereIn('id', $ids)->get();

        //             // if ( ! empty($saleCountries)) {
        //             //     foreach ($saleCountries as $saleCountry) {
        //             //         $countryIds[] = $saleCountry['id'];
        //             //     }
        //             // }

        //             // if (empty($ids)) {
        //             //     $ids = $countryIds;
        //                 // dd($ids, $countryIds);
        //             // } else {
        //                 // $temp = array_intersect($ids, $countryIds);
        //                 // $ids = $temp;
        //             // }
        //         // }

        //         if (isset($request->location)) {
        //             $saleLocations = Property::select([
        //                 "id",
        //                 "location_id"
        //             ])->where('sales', '=', 1)
        //             ->where('status', 1)
        //             ->where('location_id', '=', $request->location)
        //             ->get();

        //             if ( ! empty($saleLocations)) {
        //                 foreach ($saleLocations as $saleLocation) {
        //                     $locationIds[] = $saleLocation['id'];
        //                 }
        //             }

        //             if (empty($ids)) {
        //                 $ids = $locationIds;
        //             } else {
        //                 $ids = array_intersect($ids, $locationIds);
        //             }
        //         }

        //         if (isset($request->beds)) {
        //             $saleBeds = Property::select([
        //                 "id",
        //                 "property_info"
        //             ])->where('status', 1)
        //             ->where('sales', '=', 1)
        //             ->get();

        //             if ( !empty($saleBeds)) {
        //                 foreach ($saleBeds as $bed) {
        //                     if ($bed['property_info']['bedrooms'] >= $request->beds) {
        //                         $bedIds[] = $bed['id'];
        //                     }
        //                 }
        //             }
                    
        //             if (empty($ids)) {
        //                 $ids = $bedIds;
        //             } else {
        //                 $ids = array_intersect($ids, $bedIds);
        //             }
        //         }
        //     }
            
        //     if (isset($request->property)) {
        //         $properties = Property::with([
        //             'property_status',
        //             'currency'
        //         ])
        //         ->where('sales', 1)
        //         ->where('status', 1)
        //         ->whereIn('id', $ids)
        //         ->orderBy('created_at', 'desc')
        //         ->paginate(Property::GET_PROPERTIES);
        //     } else {
        //         $properties = Property::with([
        //                 'property_status',
        //                 'currency'
        //             ])
        //             ->where('sales', 1)
        //             ->where('status', 1)
        //             ->where('currency_id', $currencyId)
        //             ->whereIn('id', $ids)
        //             ->orderBy('created_at', 'desc')
        //             ->paginate(Property::GET_PROPERTIES);
        //     }

        //     $properties->appends(request()->all());
            
        // } else {
        //     $properties = Property::with([
        //             'property_status',
        //             'currency'
        //         ])
        //         ->where('sales', 1)
        //         ->where('status', 1)
        //         ->orderBy('created_at', 'desc')
        //         ->paginate(Property::GET_PROPERTIES);
        // }

        // $salePrices = Property::select("prices")
        //     ->where('sales', '=', 1)
        //     ->where('status', 1)
        //     ->get();

        // $salePricesPound = Property::select("prices")
        //     ->where('sales', '=', 1)
        //     ->where('currency_id', 2)
        //     ->where('status', 1)
        //     ->get();

        // $p = [];
        // $pPound = [];
        // $saleMinPrice = 0;
        // $saleMaxPrice = 0;
        // $saleMinPricePound = 0;
        // $saleMaxPricePound = 0;

        // foreach ($salePrices as $price) {
        //     $p[] = $price['prices']['price'];
        // }

        // if ( ! empty($p) > 0) {
        //     $saleMinPrice = min($p);
        //     $saleMaxPrice = max($p);
        // }

        // foreach ($salePricesPound as $price) {
        //     $pPound[] = $price['prices']['price'];
        // }

        // if ( ! empty($pPound) > 0) {
        //     $saleMinPricePound = min($pPound);
        //     $saleMaxPricePound = max($pPound);
        // }
        
        // $pages = Page::with('contentDefault')->where('status', 1)->orderBy('position','asc')->get();
        
        // return view('realstate.sale', compact(
        //     'static_data', 
        //     'properties', 
        //     'recent_properties', 
        //     'categories', 
        //     'title', 
        //     'countries', 
        //     'locations',
        //     'saleMinPrice',
        //     'saleMaxPrice',
        //     'saleMinPricePound',
        //     'saleMaxPricePound',
        //     'pages'
        // ));
        return view('sotogrande.sale', compact(
            'static_data',
            'title',
            'languages',
            'language',
            'page',
            'properties',
            'propertiesCount'
        ));
    }
}
