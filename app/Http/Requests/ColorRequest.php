<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ColorRequest extends FormRequest
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
            'code' => [
                'required',
                Rule::unique('colors','code')->ignore($this->code,'code')
            ],

            'name' => [
                'required',
            ]

        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => 'Code is required',
            'code.unique' => 'Code already in use',
            'name.required' => 'Name is required',
            'name.unique' => 'Name already in use',
        ];
    }
}
