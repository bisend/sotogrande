<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    // Allow columns to be filled with data
    protected $fillable = [
        'name', 'email', 'phone', 'reference', 'reference_name', 'register_interest', 'callback', 'status',
    ];
}
