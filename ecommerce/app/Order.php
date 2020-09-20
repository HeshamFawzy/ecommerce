<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'code', 'quantity', 'color', 'size', 'product_id', 'user_id'
    ];
}
