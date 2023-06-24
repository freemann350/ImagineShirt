<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        $paymentType = $this->input('default_payment_type');

        $rules = [
            'nif' => 'required|digits:9',
            'address' => 'required',
            'default_payment_type' => 'required|in:VISA,MC,PAYPAL',
            'default_payment_ref' => 'required'
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
            'nif.required' => 'NIF is required',
            'nif.unique' => 'NIF already in use',
            'nif.size' => 'NIF must have 9 digits',
            'address.required' => 'Address is required',
            'default_payment_type.required' => 'Payment type is required',
            'default_payment_type.in' => 'Payment type must be either VISA, MC or PAYPAL',
            'default_payment_ref.required' => 'Payment reference is required'
            ];
    }
}
