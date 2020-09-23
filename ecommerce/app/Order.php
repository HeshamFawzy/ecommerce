<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'code', 'user_id', 'status'
    ];

    public function productR()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }

    public function userR()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function colorR()
    {
        return $this->belongsTo('App\Color', 'color_id');
    }

    public function sizeR()
    {
        return $this->belongsTo('App\Size', 'size_id');
    }

    public function orderProductsR()
    {
        return $this->hasMany(OrderProducts::class , 'order_id');
    }

}
