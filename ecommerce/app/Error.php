<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Error extends Model
{
    protected $fillable = [
        'error', 'line', 'code', 'file'
    ];
}
