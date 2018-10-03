<?php

namespace App\Http\Controllers;

use App\Models\Admin\Property;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\Location;
use App\Models\Admin\Country;
use App\Models\Admin\Page;

class RentController extends Controller
{
    protected $static_data, $default_language;

    public function __construct(){
        $this->static_data = static_home();
        
        $this->default_language = default_language();
    }

    public function index(Request $request)
    {
        $static_data = $this->static_data;

        $default_language = $this->default_language;

        $title = 'Rental | Findaproperty';

        $countries = Country::all();

        $locations = Location::all();

        $categories = Category::get();

        $recent_properties = Property::with([
                'currency'
            ])
            ->orderBy('created_at', 'desc')
            ->where('status', 1)
            ->take(Property::RECENT_PROPERTIES)
            ->get();
        
        if (isset($request->search) && $request->search) {
            $ids = [];

            $propIds = [];

            $perWeekIds = [];

            $perMonthIds = [];

            $categoryIds = [];

            $countryIds = [];

            $locationIds = [];

            $bedIds = [];

            $currencyId = request('currency-id');

            if (isset($request->property)) {
                $saleProperties = Property::select([
                    "id",
                    "property_info"
                ])->where('rentals', 1)
                ->where('status', 1)
                ->get();

                if ( ! empty($saleProperties)) {
                    foreach ($saleProperties as $prop) {
                        if ($prop['property_info']['property_reference'] == $request->property) {
                            $propIds[] = $prop['id'];
                        }
                    }
                }

                $ids = $propIds;
            } else {
                $rentPrices = Property::select([
                    "id",
                    "prices"
                ])->where('rentals', 1)
                ->where('status', 1)
                ->get();

                foreach ($rentPrices as $price) {
                    if ($price['prices']['week'] >= $request->{'lower-per-week'} && $price['prices']['week'] <= $request->{'upper-per-week'}) {
                        $perWeekIds[] = $price['id'];
                    }
                    
                    if ($price['prices']['month'] >= $request->{'lower-per-month'} && $price['prices']['month'] <= $request->{'upper-per-month'}) {
                        $perMonthIds[] = $price['id'];
                    }
                }

                $ids = array_intersect($perWeekIds, $perMonthIds);

                if (isset($request->type)) {
                    $rentCategories = Property::select([
                        "id",
                        "category_id"
                    ])->where('rentals', 1)
                    ->where('category_id', $request->type)
                    ->where('status', 1)
                    ->get();

                    if ( ! empty($rentCategories)) {
                        foreach ($rentCategories as $cat) {
                            $categoryIds[] = $cat['id'];
                        }
                    }

                    if (empty($ids)) {
                        $ids = $categoryIds;
                    } else {
                        $ids = array_intersect($ids, $categoryIds);
                    }
                }

                // if (isset($request->country)) {
                //     $rentCountries = Property::select([
                //         "id",
                //         "country_id"
                //     ])->where('rentals', '=', 1)
                //     ->where('country_id', '=', $request->country)
                //     ->where('status', 1)
                //     ->get();

                //     if (count($rentCountries) > 0) {
                //         foreach ($rentCountries as $saleCountry) {
                //             $countryIds[] = $saleCountry['id'];
                //         }
                //     }

                //     if (count($ids < 1)) {
                //         $ids = $countryIds;
                //     } else {
                //         $ids = array_intersect($ids, $countryIds);
                //     }
                // }

                if (isset($request->location)) {
                    $rentLocations = Property::select([
                        "id",
                        "location_id"
                    ])->where('rentals', 1)
                    ->where('location_id', $request->location)
                    ->where('status', 1)
                    ->get();

                    if (! empty($rentLocations)) {
                        foreach ($rentLocations as $saleLocation) {
                            $locationIds[] = $saleLocation['id'];
                        }
                    }

                    if (empty($ids)) {
                        $ids = $locationIds;
                    } else {
                        $ids = array_intersect($ids, $locationIds);
                    }
                }
            
                if (isset($request->beds)) {
                    $rentBeds = Property::select([
                        "id",
                        "property_info"
                    ])->where('rentals', 1)
                    ->where('status', 1)
                    ->get();

                    if ( ! empty($rentBeds)) {
                        foreach ($rentBeds as $bed) {
                            if ($bed['property_info']['bedrooms'] >= $request->beds) {
                                $bedIds[] = $bed['id'];
                            }
                        }
                    }
                    
                    if (empty($ids)) {
                        $ids = $bedIds;
                    } else {
                        $ids = array_intersect($ids, $bedIds);
                    }
                }
            }

            if (isset($request->property)) {
                $properties = Property::with([
                    'property_status',
                    'currency'
                ])
                ->where('rentals', 1)
                ->where('status', 1)
                ->whereIn('id', $ids)
                ->orderBy('created_at', 'desc')
                ->paginate(Property::GET_PROPERTIES);
            } else {
                $properties = Property::with([
                        'property_status',
                        'currency'
                    ])
                    ->where('rentals', 1)
                    ->where('status', 1)
                    ->where('currency_id', $currencyId)
                    ->whereIn('id', $ids)
                    ->orderBy('created_at', 'desc')
                    ->paginate(Property::GET_PROPERTIES);
            }
            
            $properties->appends(request()->all());
            
        } else {
            $properties = Property::with([
                    'currency'
                ])
                ->where('rentals', 1)
                ->where('status', 1)
                ->orderBy('created_at', 'desc')
                ->paginate(Property::GET_PROPERTIES);
        }

        $rentPrices = Property::select("prices")
                        ->where('rentals', '=', 1)
                        ->where('currency_id', 1)
                        ->where('status', 1)
                        ->get();
        
        $rentPricesPound = Property::select("prices")
            ->where('rentals', '=', 1)
            ->where('currency_id', 2)
            ->where('status', 1)
            ->get();

        $perWeek = [];
        $perMonth = [];
        $rentMinPricePerWeek = 0;
        $rentMaxPricePerWeek = 0;
        $rentMinPricePerMonth = 0;
        $rentMaxPricePerMonth = 0;

        $perWeekPound = [];
        $perMonthPound = [];
        $rentMinPricePerWeekPound = 0;
        $rentMaxPricePerWeekPound = 0;
        $rentMinPricePerMonthPound = 0;
        $rentMaxPricePerMonthPound = 0;

        foreach ($rentPrices as $price) {
            $perWeek[] = $price['prices']['week'] != '' ? $price['prices']['week'] : 0;
            $perMonth[] = $price['prices']['month'] != '' ? $price['prices']['month'] : 0;
        }

        if ( ! empty($perWeek) > 0) {
            $rentMinPricePerWeek = min($perWeek);
            $rentMaxPricePerWeek = max($perWeek);
        }

        if ( ! empty($perMonth) > 0) {
            $rentMinPricePerMonth = min($perMonth);
            $rentMaxPricePerMonth = max($perMonth);
        }

        //
        foreach ($rentPricesPound as $price) {
            $perWeekPound[] = $price['prices']['week'] != '' ? $price['prices']['week'] : 0;
            $perMonthPound[] = $price['prices']['month'] != '' ? $price['prices']['month'] : 0;
        }

        if ( ! empty($perWeekPound) > 0) {
            $rentMinPricePerWeekPound = min($perWeekPound);
            $rentMaxPricePerWeekPound = max($perWeekPound);
        }

        if ( ! empty($perMonthPound) > 0) {
            $rentMinPricePerMonthPound = min($perMonthPound);
            $rentMaxPricePerMonthPound = max($perMonthPound);
        }
        
        $pages = Page::with('contentDefault')->where('status', 1)->orderBy('position','asc')->get();

        return view('realstate.rent', compact(
            'static_data', 
            'properties', 
            'recent_properties', 
            'categories', 
            'title', 
            'countries', 
            'locations',
            'rentMinPricePerWeek',
            'rentMaxPricePerWeek',
            'rentMinPricePerMonth',
            'rentMaxPricePerMonth',
            'rentMinPricePerWeekPound',
            'rentMaxPricePerWeekPound',
            'rentMinPricePerMonthPound',
            'rentMaxPricePerMonthPound',
            'pages'
        ));
    }
}
