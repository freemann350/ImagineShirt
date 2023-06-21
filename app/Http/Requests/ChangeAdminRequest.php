<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeAdminRequest extends FormRequest
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
                'blocked' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'blocked.required' => 'Blocked is required',
            'blocked.boolean' =>  'Blocked must be boolean',
        ];
    }
}
