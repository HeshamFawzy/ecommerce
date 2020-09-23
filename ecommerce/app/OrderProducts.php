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
        return $this->belongsTo('App\Product', 'product_id');
    }

    public function colorR()
    {
        return $this->belongsTo('App\Color', 'color_id');
    }

    public function sizeR()
    {
        return $this->belongsTo('App\Size', 'size_id');
    }
}
