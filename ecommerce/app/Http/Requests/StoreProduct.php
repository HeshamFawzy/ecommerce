<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduct extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name_en' => 'required|max:100',
            'name_ar' => 'required|max:100',
            'description_en' => 'required',
            'description_ar' => 'required',
            'materail' => 'required',
            'quantity' => 'required',
            'colors' => 'required',
            'sizes' => 'required',
            'price' => 'required',
            'discount' => 'required',
        ];
    }
}
