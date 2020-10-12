<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartSize extends Model
{
    protected $table = 'parts_sizes';
    protected $fillable = [
        'value', 'category_id', 'size_id', 'part_id'
    ];

    public function sizeR()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }

    public function partR()
    {
        return $this->belongsTo(Part::class, 'part_id');
    }
}
