<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class product_request extends FormRequest
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
            'title' => 'bail|required|string|max:50',
            'brand' => 'required|max:50',
            'code' => 'required|unique:products',
            'price' => 'required|numeric',
            //'offprice' => 'numeric',
            'availablity' => 'required',
            'color_id' => 'required',
            'description' => 'string|max:2000',
            'indexImage' => 'required|image'
        ];
    }
}