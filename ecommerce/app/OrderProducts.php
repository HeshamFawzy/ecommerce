<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model
{
    protected $fillable = [
        'order_id', 'quantity', 'color_id', 'size_id', 'product_id'
    ];

    public function productR()
    {
        return $this->belongsTo(Product::class, 'product_id')->with('imagesR');
    }

    public function colorR()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function sizeR()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }
}
