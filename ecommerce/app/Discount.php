<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = [
        'end_date', 'amount', 'type' , 'product_id'
    ];
}
