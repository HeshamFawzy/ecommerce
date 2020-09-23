<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'code', 'quantity', 'color_id', 'size_id', 'product_id', 'user_id'
    ];
}
