<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'email' => [
                'required',
                'email',
                Rule::unique('users','email')->ignore($this->user_id)
            ],
            'user_type' => 'required|in:A,E',
            'password' => Rule::requiredIf(!isset($this->user_id)),
            'blocked' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Invalid email format',
            'email.unique' => 'Email already in use',
            'password.required' => 'Password cannot be empty',
            'user_type.required' => 'User type is required',
            'user_type.in' => 'User type must be Administrator or Employee',
            'blocked.required' => 'Blocked is required',
            'blocked.boolean' => 'Blocked must be boolean',
            ];
    }
}
