<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name_en', 'name_ar', 'category_id', 'image_filename', 'image_mime', 'image_original_filename', 'alter_image_filename', 'alter_image_mime', 'alter_image_original_filename', 'colors', 'sizes', 'price', 'discount'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category' , 'category_id');
    }

}
