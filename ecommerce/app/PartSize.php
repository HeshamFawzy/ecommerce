<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartSize extends Model
{
    protected $table = 'parts_sizes';
    protected $fillable = [
        'value', 'category_id', 'size_id', 'part_id'
    ];
}
