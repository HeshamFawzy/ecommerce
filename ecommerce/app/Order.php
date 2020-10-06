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
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function userR()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function colorR()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function sizeR()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }

    public function orderProductsR()
    {
        return $this->hasMany(OrderProducts::class, 'order_id')->with('productR', 'colorR', 'sizeR');
    }

    public static function getStatus($order)
    {
        if ($order->status == 1) {
            return "Ordered";
        } elseif ($order->status == 2) {
            return "Chopping";
        } elseif ($order->status == 3) {
            return "Finishing";
        } elseif ($order->status == 4) {
            return "Delivered";
        } else {
            return "Done";
        }
    }

}
