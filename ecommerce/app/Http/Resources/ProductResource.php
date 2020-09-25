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
        if ($this->CategoryR->image_filename != null) {
            $image = asset('categories/images/' . $this->CategoryR->image_filename);
        } else {
            $image = asset('assets/admin/images/Question_Mark.png');
        }
        if ($this->CategoryR->size_filename != null) {
            $sizeImage = asset('categories/sizeImages/' . $this->CategoryR->size_filename);
        } else {
            $sizeImage = asset('assets/admin/images/Question_Mark.png');
        }

        foreach ($this->ImagesR as $Image) {
            if ($Image->image_filename != null) {
                $colorImages[] = asset('products/colorImages/' . $Image->image_filename);
            } else {
                $colorImages = asset('assets/admin/images/Question_Mark.png');
            }
            if ($Image->alter_image_filename != null) {
                $colorAlterImages[] = asset('products/colorAlterImages/' . $Image->alter_image_filename);
            } else {
                $colorAlterImages = asset('assets/admin/images/Question_Mark.png');
            }
        }

        return [
            'id' => $this->id,
            'name_en' => $this->name_en,
            'name_ar' => $this->name_ar,
            'description' => $this->description,
            'colors' => $this->colors,
            'sizes' => $this->sizes,
            'price' => $this->price,
            'discount' => $this->discount,
            'category_r' => [
                'category_id' => $this->CategoryR->id,
                "name_en" => $this->CategoryR->name_en,
                "name_ar" => $this->CategoryR->name_ar,
                "image_filename" => $image,
                "size_filename" => $sizeImage,
            ],
            "discount_r" => [
                "end_date" => $this->discountR->end_date,
                "amount" => $this->discountR->amount,
                "type" => $this->discountR->type,
            ],
            "images_r" => [
                "image_filename" => $colorImages,
                "alter_image_filename" => $colorAlterImages,
            ]
        ];
    }
}
