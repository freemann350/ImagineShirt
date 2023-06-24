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
        $paymentType = $this->input('default_payment_type');

        $rules = [
            'nif' => 'nullable|digits:9',
            'address' => 'nullable',
            'default_payment_type' => 'nullable|in:VISA,MC,PAYPAL',
            'default_payment_ref' => 'nullable'
        ];

        if ($paymentType === 'VISA' || $paymentType === 'MC') {
            $rules['default_payment_ref'] .= '|digits:16';
        } elseif ($paymentType === 'PAYPAL') {
            $rules['default_payment_ref'] .= '|email';
        }

        return $rules;
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
