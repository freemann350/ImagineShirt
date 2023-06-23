<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TshirtUploadRequest extends FormRequest
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
            'description' => 'sometimes',
            'photo' => [
                'required',
                'image',
                'max:4096']
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'photo.required' => 'Image is required',
            'photo.image' => 'File is not image type',
            'photo.size' => 'Size cannot exceed 4MB'
        ];
    }
}
