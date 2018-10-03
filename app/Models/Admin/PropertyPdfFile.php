<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class PropertyPdfFile extends Model
{
    protected $fillable = [
        'property_id', 'language_id', 'name', 'file_name', 'path',
    ];
}
