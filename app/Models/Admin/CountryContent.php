<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class CountryContent extends Model
{
    public $timestamps = false;
    // Enable columns to be filled with data
    protected $fillable = [
        'location', 'description', 'location_id', 'language_id'
    ];
}
