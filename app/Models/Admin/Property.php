<?php

namespace App\Models\Admin;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    const FEATURED_COUNT = 5;
    const SLIDER_COUNT = 5;
    const RECENT_PROPERTIES = 3;
    const GET_PROPERTIES = 8;
    const PRICE_RANGE = 10000;
    const RELATED_PROPERTIES_COUNT = 2;

    // Allow columns to be filled with data
    protected $fillable = [
        'user_id', 'status_id', 'currency_id', 'status', 'images', 'category_id', 'location', 'contact',
        'social', 'business_hours', 'featured', 'video', 'features', 'type_id', 'location_id',
        'property_info', 'fees', 'prices', 'alias', 'rooms', 'guest_number', 'price_per_night', 'meta_keywords', 'meta_description', 'meta_title',
        'sales', 'rentals', 'slider', 'position','country_id',
    ];

    // Storing arrays in base
    protected $casts = [
        'features' => 'array',
        'location' => 'array',
        'contact' => 'array',
        'social' => 'array',
        'images' => 'array',
        'business_hours' => 'array',
        'fees' => 'array',
        'prices' => 'array',
        'property_info' => 'array',
    ];

    // Returning the post's user
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function property_status ()
    {
        return $this->belongsTo('App\Models\Admin\PropertyStatus', 'status_id', 'id');
    }

    // Return the currency of property
    public function currency ()
    {
        return $this->belongsTo('App\Models\Admin\Currency');
    }

    // Getting the images in the post content
    public function images(){
        return $this->morphMany('App\Models\Image', 'imageable');
    }

    public function files(){
        return $this->hasMany('App\Models\Admin\PropertyFile');
    }

    // Getting the location
    public function prop_location(){
        return $this->belongsTo('App\Models\Admin\Location', 'location_id', 'id');
    }

    // Getting the category
    public function category(){
        return $this->belongsTo('App\Models\Admin\Category');
    }

    // Getting the content - Default Language
    public function contentDefault(){
        $default = Language::where('default', 1)->first();
        return $this->hasOne('App\Models\Admin\PropertyContent')->where('language_id', $default->id);
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Admin\Country');
    }

    // Getting the content all Languages
    public function content($language_id = 1){
        return $this->hasOne('App\Models\Admin\PropertyContent')->where('language_id', $language_id)->first();
    }

    // Getting property booked dates
    public function booking(){
        return $this->hasMany('App\Models\Admin\Booking');
    }

    // Getting property available dates
    public function prop_dates(){
        return $this->hasOne('App\Models\Admin\PropertyDate');
    }

    // Getting the content all Languages
    public function contentload(){
        return $this->hasOne('App\Models\Admin\PropertyContent');
    }

    // Getting the pdf
    public function pdfFile(){
        return $this->hasOne('App\Models\Admin\PropertyPdfFile');
    }

    // Add Attribute to the images
    public function getImageAttribute($value){
        if($value == 'no_image.jpg'){
            return '/images/'. $value;
        }else{
            return '/images/data/'. $value;
        }
    }

    public function getCreatedAtAttribute($date){
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }

    public function getUpdatedAtAttribute($date){
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }

    public function getImageByStatusAttribute()
    {
        if ($this->images->isNotEmpty()) {
            foreach($this->images as $image) {
                if ($image->status == 1) {
                    return asset('images/data').'/'.$image->image;
                }
            }
            return asset('images/data').'/'.$this->images->first()->image;
        }
        return asset('images/no_image.jpg');
    }
}