<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
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
        if("'default_payment_type' => 'sometimes|in:VISA,MC'"){
            return [
                'nif' => 'sometimes|digits:9',
                'address' => 'sometimes',
                'default_payment_ref' => 'sometimes|digits:16'
            ];
        }
        if("'default_payment_type' => 'sometimes|in:PAYPAL'"){
            return [
                'nif' => 'sometimes|digits:9',
                'address' => 'sometimes',
                'default_payment_ref' => 'sometimes|email'
            ];
        }
    }

    public function messages(): array
    {
        return [
            'nif.unique' => 'NIF already in use',
            'nif.size' => 'NIF must have 9 digits',
            'default_payment_type.in' => 'Payment type must be either VISA, MC or PAYPAL'
            ];
    }
}
