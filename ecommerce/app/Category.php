<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable = [
        'name_en', 'name_ar', 'image_filename', 'image_mime', 'image_original_filename', 'size_filename', 'size_mime', 'size_original_filename'
    ];
    
}
