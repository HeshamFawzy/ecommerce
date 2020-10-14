<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name_en', 'name_ar', 'description_en', 'description_ar', 'materail_id', 'quantity', 'category_id', 'colors', 'sizes', 'price', 'discount'
    ];
    protected $casts = [
        'colors' => 'array',
        'sizes' => 'array',
    ];

    public function categoryR()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function discountR()
    {
        return $this->hasOne('App\Discount', 'product_id');
    }

    public function imagesR()
    {
        return $this->hasMany('App\Image', 'product_id');
    }

    public function materailR()
    {
        return $this->belongsTo('App\Materail', 'materail_id');
    }
}
