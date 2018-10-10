<?php

namespace App\Http\Controllers;

use App\Models\Admin\Category;
use App\Models\Admin\Blog;
use App\Models\Admin\Property;
use App\Models\Admin\Review;
use App\Models\Admin\Location;
use App\Models\Admin\Country;
use App\Mail\RequestMails;
use App\Models\Request as RequestModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Models\Admin\Page;
use App\Models\Admin\Language;
use App\Http\Helpers\Languages;

class HomeController extends Controller
{

    protected $static_data, $default_language;

    public $languages;

    public function __construct() 
    {
        $this->static_data = static_home();

        $this->default_language = default_language();
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($language = Languages::DEFAULT_LANGUAGE)
    {
        Languages::localizeApp($language);

        $page = 'home';
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

        $title = 'Home | Ayling';

        $slider = Property::with([
            'property_status',
            'currency',
            'images', 
            'contentload' => function($query) use ($languageId) {
                $query->where('language_id', $languageId);
            },
        ])
        ->where('status', 1)
        ->where('slider', 1)
        ->take(5)
        ->get();

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

        $sale_properties = Property::with([
            'property_status',
            'currency',
            'images', 
            'contentload' => function($query) use ($languageId) {
                $query->where('language_id', $languageId);
            },
        ])
        ->where('status', 1)
        ->where('sales', 1)
        ->where('featured_sale', 1)
        ->orderBy('position_sale', 'asc')
        ->take(Property::FEATURED_COUNT)
        ->get();

        $rent_properties = Property::with([
            'property_status',
            'currency',
            'images', 
            'contentload' => function($query) use ($languageId) {
                $query->where('language_id', $languageId);
            },
        ])
        ->where('status', 1)
        ->where('rentals', 1)
        ->where('featured_rent', 1)
        ->orderBy('position_rent', 'asc')
        ->take(Property::FEATURED_COUNT)
        ->get();

        $posts = Blog::with([
            'contentload' => function($query) use ($languageId) {
                $query->where('language_id', $languageId);
            },
        ])
        ->where('status', 1)
        ->orderBy('created_at', 'desc')
        ->limit(3)
        ->get();
        
        $minPrice = 0;
        $maxPrice = 0;
        $prices = Property::select("prices")
        ->where('status', 1)
        ->get();
        
        $prices = allPrices($prices);
        
        $minPrice = $prices->min();
        $maxPrice = $prices->max();
        
        $pages = Page::with([
            'contentload' => function ($query) use ($languageId) {
                $query->where('language_id', $languageId);
            },
        ])
        ->where('status', 1)
        ->orderBy('position', 'asc')
        ->get();

        // // Get the properties (Eager Load)
        // $number_of_properties = get_setting('fp_properties_count', 'design');;
        // if($static_data['design_settings']['fp_show_featured_only']){
        //     $properties = Property::with([
        //         'property_status',
        //         'currency',
        //         'images', 
        //         'contentload' => function($query) use($default_language){
        //             $query->where('language_id', $default_language->id);
        //     }])->where('status', 1)->where('featured', 1)->inRandomOrder()->take($number_of_properties)->get();
        // }else{
        //     $properties = Property::with([
        //         'property_status',
        //         'currency',
        //         'images', 'contentload' => function($query) use($default_language){
        //         $query->where('language_id', $default_language->id);
        //     }])->where('status', 1)->inRandomOrder()->take($number_of_properties)->get();
        // }

        // $sales_properties = Property::with([
        //     'property_status',
        //     'currency',
        //     'images', 'contentload' => function($query) use($default_language){
        //     $query->where('language_id', $default_language->id);
        // }])->where('status', 1)->where('sales', 1)->where('featured_sale', 1)->orderBy('position_sale', 'asc')->take(Property::FEATURED_COUNT)->get();

        // $rentals_properties = Property::with([
        //     'property_status',
        //     'currency',
        //     'images', 'contentload' => function($query) use($default_language){
        //     $query->where('language_id', $default_language->id);
        // }])->where('status', 1)->where('rentals', 1)->where('featured_rent', 1)->orderBy('position_rent', 'asc')->take(Property::FEATURED_COUNT)->get();

        // $f_locations = Location::with('contentload')->where('featured', 1)->orderBy('order', 'asc')->get();

        // // Get the blog (Eager Load)
        // $posts = Blog::with(['contentload' => function($query) use($default_language){
        //     $query->where('language_id', $default_language->id);
        // }])->where('status', 1)->orderBy('created_at', 'desc')->take(3)->get();

        // $slider = Property::with([
        //     'property_status',
        //     'currency',
        //     'images', 'contentload' => function($query) use($default_language){
        //     $query->where('language_id', $default_language->id);
        // }])->where('status', 1)->where('slider', 1)->take(5)->get();
        // $countries = Country::all();
        // $locations = Location::all();
        // $categories = Category::get();

        // $salePrices = Property::select("prices")
        //     ->where('sales', '=', 1)
        //     ->where('currency_id', 1)
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

        // $rentPrices = Property::select("prices")
        //                 ->where('rentals', '=', 1)
        //                 ->where('currency_id', 1)
        //                 ->where('status', 1)
        //                 ->get();
        
        // $rentPricesPound = Property::select("prices")
        //     ->where('rentals', '=', 1)
        //     ->where('currency_id', 2)
        //     ->where('status', 1)
        //     ->get();

        // $perWeek = [];
        // $perMonth = [];
        // $rentMinPricePerWeek = 0;
        // $rentMaxPricePerWeek = 0;
        // $rentMinPricePerMonth = 0;
        // $rentMaxPricePerMonth = 0;

        // $perWeekPound = [];
        // $perMonthPound = [];
        // $rentMinPricePerWeekPound = 0;
        // $rentMaxPricePerWeekPound = 0;
        // $rentMinPricePerMonthPound = 0;
        // $rentMaxPricePerMonthPound = 0;

        // foreach ($rentPrices as $price) {
        //     $perWeek[] = $price['prices']['week'] != '' ? $price['prices']['week'] : 0;
        //     $perMonth[] = $price['prices']['month'] != '' ? $price['prices']['month'] : 0;
        // }

        // if ( ! empty($perWeek) > 0) {
        //     $rentMinPricePerWeek = min($perWeek);
        //     $rentMaxPricePerWeek = max($perWeek);
        // }

        // if ( ! empty($perMonth) > 0) {
        //     $rentMinPricePerMonth = min($perMonth);
        //     $rentMaxPricePerMonth = max($perMonth);
        // }

        // //
        // foreach ($rentPricesPound as $price) {
        //     $perWeekPound[] = $price['prices']['week'] != '' ? $price['prices']['week'] : 0;
        //     $perMonthPound[] = $price['prices']['month'] != '' ? $price['prices']['month'] : 0;
        // }

        // if ( ! empty($perWeekPound) > 0) {
        //     $rentMinPricePerWeekPound = min($perWeekPound);
        //     $rentMaxPricePerWeekPound = max($perWeekPound);
        // }

        // if ( ! empty($perMonthPound) > 0) {
        //     $rentMinPricePerMonthPound = min($perMonthPound);
        //     $rentMaxPricePerMonthPound = max($perMonthPound);
        // }

        // $pages = Page::with('contentDefault')->where('status', 1)->orderBy('position','asc')->get();
        // // Returning the View
        // return view('realstate.home', compact(
        //     'posts', 
        //     'default_language',
        //     'properties', 
        //     'static_data', 
        //     'f_locations', 
        //     'sales_properties', 
        //     'rentals_properties', 
        //     'slider', 
        //     'categories', 
        //     'title', 
        //     'countries', 
        //     'locations',
        //     'saleMinPrice',
        //     'saleMaxPrice',
        //     'rentMinPricePerWeek',
        //     'rentMaxPricePerWeek',
        //     'rentMinPricePerMonth',
        //     'rentMaxPricePerMonth',
        //     'saleMinPricePound',
        //     'saleMaxPricePound',
        //     'rentMinPricePerWeekPound',
        //     'rentMaxPricePerWeekPound',
        //     'rentMinPricePerMonthPound',
        //     'rentMaxPricePerMonthPound',
        //     'pages'
        // ));
        return view('sotogrande.home', compact(
            'static_data',
            'title',
            'languages',
            'language',
            'slider',
            'locations',
            'categories',
            'sale_properties',
            'rent_properties',
            'posts',
            'minPrice',
            'maxPrice',
            'page',
            'pages'
        ));
    }

    // Contact page
    public function contact(){
        // Get Static Data
        $static_data = $this->static_data;

        $default_language = $this->default_language;

        $last_posts = Blog::with(['contentload' => function($query) use($default_language){
            $query->where('language_id', $default_language->id);
        }])->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $recent_properties = Property::orderBy('created_at', 'desc')
                                ->where('status', 1)
                                ->take(Property::RECENT_PROPERTIES)
                                ->get();

        $pages = Page::with('contentDefault')->where('status', 1)->orderBy('position','asc')->get();
        return view('realstate.contact', compact(
            'static_data', 
            'default_language', 
            'pages',
            'recent_properties',
            'last_posts'
        ));
    }

    public function reCaptcha(Request $request){
        if($request->ajax()){
            $parameters = http_build_query([
                'secret'   => get_setting('reCaptcha_api_secret', 'site'),
                'response' => $request->response,
            ]);
            $url           = 'https://www.google.com/recaptcha/api/siteverify?' . $parameters;
            $checkResponse = null;
            $checkResponse = file_get_contents($url);
            if (is_null($checkResponse) || empty( $checkResponse )) {
                response()->json(['status' => false]);
            }
            $response = json_decode($checkResponse);
            return response()->json(['status' => $response->success]);
        }else{
            return response()->json($static_data['strings']['something_happened'], 400);
        }
    }

    public function review(Request $request){
        $data = $request->all();
        if($request->property_id){
            $data['service_id'] = 0;
        }else{
            $data['property_id'] = 0;
        }
        $data['status'] = 0;
        Review::create($data);
        Session::flash('reviewDone', true);
        return redirect()->back();
    }

    public function registerInterest(Request $request)
    {

        if($request->ajax()){
            $data = $request->only(['name', 'email', 'phone', 'regPage']);
            $data['register_interest'] = 1;
            $data['reference'] = $data['regPage'];
            $property_alias = explode('/', $data['reference']);
            $property_alias = end($property_alias);
            $property = Property::where('alias',  $property_alias)->first();
            if ($property) {
                $data['reference_name'] = $property->property_info['property_reference'];
            } else {
                if ($property_alias == '') {
                    $data['reference_name'] = 'home';
                } else {
                    $data['reference_name'] = $property_alias;
                }
            }
            $data['subject'] = 'Register Interest Request from Findaproperty';
            if (RequestModel::create($data)) {
                Mail::to(get_setting('contact_email', 'site'))->send(new RequestMails($data));
                $response['status'] = 'success';
                return $response;
            }
            $response['status'] = 'error';
            return $response;
        }
    }

    public function callback(Request $request)
    {
        if($request->ajax()){
            $data = $request->only(['name', 'phone', 'backPage']);
            $data['callback'] = 1;
            $data['subject'] = 'Call Back Request from Findaproperty';
            $data['reference'] = $data['backPage'];
            $property_alias = explode('/', $data['reference']);
            $property_alias = end($property_alias);
            $property = Property::where('alias',  $property_alias)->first();
            if ($property) {
                $data['reference_name'] = $property->property_info['property_reference'];
            } else {
                if ($property_alias == '') {
                    $data['reference_name'] = 'home';
                } else {
                    $data['reference_name'] = $property_alias;
                }
            }
            if (RequestModel::create($data)) {
                Mail::to(get_setting('contact_email', 'site'))->send(new RequestMails($data));
                $response['status'] = 'success';
                return $response;
            }
            $response['status'] = 'error';
            return $response;
        }
    }
}
