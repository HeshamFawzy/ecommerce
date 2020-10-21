<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie;

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
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function discountR()
    {
        return $this->hasOne(Discount::class, 'product_id');
    }

    public function imagesR()
    {
        return $this->hasMany(Image::class, 'product_id');
    }

    public function materailR()
    {
        return $this->belongsTo(Materail::class, 'materail_id');
    }

    public function orderproductsR()
    {
        return $this->hasMany(OrderProducts::class, 'product_id');
    }

    public function scopePrice(Builder $query, $from, $to): Builder
    {
        return $query->where('price', '>=', $from)->where('price', '<=', $to);
    }
}
