<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'image_filename', 'image_mime', 'image_original_filename'
    ];
}
