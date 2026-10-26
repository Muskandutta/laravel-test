<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_name'                  => ['required', 'string', 'max:255'],
            'customer_email'                 => ['required', 'email', 'max:255'],
            'customer_phone'                 => ['nullable', 'string', 'max:20'],
            'notes'                          => ['nullable', 'string', 'max:1000'],

            'shipping_address'               => ['required', 'array'],
            'shipping_address.street'        => ['required', 'string', 'max:255'],
            'shipping_address.city'          => ['required', 'string', 'max:100'],
            'shipping_address.state'         => ['required', 'string', 'max:100'],
            'shipping_address.postal_code'   => ['required', 'string', 'max:20'],
            'shipping_address.country'       => ['required', 'string', 'max:100'],

            'items'                          => ['required', 'array', 'min:1'],
            'items.*.product_id'             => ['required', 'integer', 'exists:products,id'],
            'items.*.quantity'               => ['required', 'integer', 'min:1', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'items.required'              => 'At least one item is required to place an order.',
            'items.*.product_id.exists'   => 'One or more selected products do not exist.',
            'items.*.quantity.min'        => 'Item quantity must be at least 1.',
        ];
    }

    /**
     * Return JSON validation errors instead of redirecting.
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors'  => $validator->errors(),
            ], 422)
        );
    }
}
