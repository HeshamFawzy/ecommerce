<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'product_id', 'color', 'image_filename', 'image_mime', 'image_original_filename', 'alter_image_filename', 'alter_image_mime', 'alter_image_original_filename',
    ];

    protected $casts = [
        'color' => 'array',
    ];
}
