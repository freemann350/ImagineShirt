<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TshirtRequest extends FormRequest
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
            'name' => 'required',
            'category' => 'required',
            'description' => 'sometimes',
            'tshirt_image' => [
                'image',
                'max:4096',
                Rule::requiredIf(!isset($this->tshirt_id))
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'category.required' => 'Category is required',
            'tshirt_image.required' => 'Image is required on creation',
            'tshirt_image.image' => 'File is not image type',
            'tshirt_image.size' => 'Size cannot exceed 4MB',
        ];
    }
}
