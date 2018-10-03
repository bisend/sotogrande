<?php

namespace App\Http\Controllers;

use App\Models\Admin\Property;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\Location;
use App\Models\Admin\Country;
use App\Models\Admin\Page;

class CommercialController extends Controller
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

        $title = 'Commercial | Findaproperty';

        $countries = Country::all();

        $locations = Location::all();

        $categories = Category::get();

        $recent_properties = Property::with([
                'property_status',
                'currency'
            ])
            ->orderBy('created_at', 'desc')
            ->where('status', 1)
            ->take(Property::RECENT_PROPERTIES)
            ->get();
        
        $properties = Property::with([
                'property_status',
                'currency'
            ])
            ->whereHas('category', function ($query) {
                $query->whereHas('contentDefault', function ($q) {
                    $q->where('name', 'Commercial');
                });
            })
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(Property::GET_PROPERTIES);

            $salePrices = Property::select("prices")
            ->where('sales', '=', 1)
            ->where('currency_id', 1)
            ->where('status', 1)
            ->get();
        
        $salePricesPound = Property::select("prices")
            ->where('sales', '=', 1)
            ->where('currency_id', 2)
            ->where('status', 1)
            ->get();

        $p = [];
        $pPound = [];
        $saleMinPrice = 0;
        $saleMaxPrice = 0;
        $saleMinPricePound = 0;
        $saleMaxPricePound = 0;

        foreach ($salePrices as $price) {
            $p[] = $price['prices']['price'];
        }

        if ( ! empty($p) > 0) {
            $saleMinPrice = min($p);
            $saleMaxPrice = max($p);
        }

        foreach ($salePricesPound as $price) {
            $pPound[] = $price['prices']['price'];
        }

        if ( ! empty($pPound) > 0) {
            $saleMinPricePound = min($pPound);
            $saleMaxPricePound = max($pPound);
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

        return view('realstate.commercial', compact(
            'static_data', 
            'properties', 
            'recent_properties', 
            'categories', 
            'title', 
            'countries', 
            'locations',
            'saleMinPrice',
            'saleMaxPrice',
            'rentMinPricePerWeek',
            'rentMaxPricePerWeek',
            'rentMinPricePerMonth',
            'rentMaxPricePerMonth',
            'saleMinPricePound',
            'saleMaxPricePound',
            'rentMinPricePerWeekPound',
            'rentMaxPricePerWeekPound',
            'rentMinPricePerMonthPound',
            'rentMaxPricePerMonthPound',
            'pages'
        ));
    }
}
