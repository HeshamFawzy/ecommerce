<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
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
            $image = asset('sliders/' . $this->image_filename);
        }
        return [
            'image' => $image,
        ];
    }
}
