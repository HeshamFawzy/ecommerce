<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->image_filename != null) {
            $image = asset('products/images/' . $this->image_filename);
        } else {
            $image = asset('assets/admin/images/Question_Mark.png');
        }
        if ($this->alter_image_filename != null) {
            $alterImage = asset('products/alterImages/' . $this->alter_image_filename);
        } else {
            $alterImage = asset('assets/admin/images/Question_Mark.png');
        }
        return [
            'id' => $this->id,
            'name_en' => $this->name_en,
            'name_ar' => $this->name_ar,
            'image' => $image,
            'alter' => $alterImage,
            'price' => $this->price,
            'colors' => $this->colors,
            'sizes' => $this->sizes
        ];
    }
}
