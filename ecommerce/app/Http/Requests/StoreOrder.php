<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrder extends FormRequest
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
            'orderProducts.*.quantity' => 'required',
            'orderProducts.*.color' => 'required',
            'orderProducts.*.size' => 'required',
            'orderProducts.*.product_id' => 'required',
            'orderProducts.*.user_id' => 'required'
        ];
    }
}
