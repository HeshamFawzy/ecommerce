<?php

namespace App\Http\Resources;

use App\PartSize;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            $image = asset('categories/images/' . $this->image_filename);
        } else {
            $image = asset('assets/admin/images/Question_Mark.png');
        }
        if ($this->size_filename != null) {
            $sizeImage = asset('categories/sizeImages/' . $this->size_filename);
        } else {
            $sizeImage = asset('assets/admin/images/Question_Mark.png');
        }

        $sizesTable = PartSize::where('category_id', $this->id)->with(['partR', 'sizeR'])->get();

        return [
            'id' => $this->id,
            'name_en' => $this->name_en,
            'name_ar' => $this->name_ar,
            'image' => $image,
            'size' => $sizeImage,
            'sizesTable' => $sizesTable
        ];
    }
}
