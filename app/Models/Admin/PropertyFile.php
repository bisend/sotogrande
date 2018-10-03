<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class PropertyFile extends Model
{
    protected $fillable = [
        'property_id', 'name', 'file_name', 'path',
    ];
}
