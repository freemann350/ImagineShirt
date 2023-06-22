<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PriceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {


        return [
            'unit_price_catalog' => 'required|numeric',
            'unit_price_own' => 'required|numeric',
            'unit_price_catalog_discount' => 'required|numeric',
            'unit_price_own_discount' => 'required|numeric',
            'qty_discount' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'unit_price_catalog.required' => 'Unit price of images on catalog is required',
            'unit_price_catalog.numeric' => 'Unit price of catalog must be numeric',
            'unit_price_own.required' => 'Unit price of self images is required',
            'unit_price_own.numeric' => 'Unit price of self images must be numeric',
            'unit_price_catalog_discount.required' => 'Discount of images on catalog is required',
            'unit_price_catalog_discount.numeric' => 'Discount of images on catalog must be numeric',
            'unit_price_own_discount.required' => 'Discount of self images is required',
            'unit_price_own_discount.numeric' => 'Discount of self images must be numeric',
            'qty_discount.required' => 'Quantity required for discount is required',
            'qty_discount.numeric' => 'Quantity required for discount must be numeric',

        ];
    }
}
