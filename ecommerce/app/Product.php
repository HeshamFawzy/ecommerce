<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name_en', 'name_ar', 'price', 'discount', 'image_filename', 'image_mime', 'image_original_filename', 'alter_filename', 'alter_mime', 'alter_original_filename'
    ];
}
