<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HoldPaymentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'hold_amount_status' => 'nullable|string',
            'less_quantity' => 'nullable|numeric',
            'updated_rate' => 'nullable|numeric',
            'remaining_hold_amount' => 'nullable|numeric',
            'proof' => 'nullable',
            'lead_id' => 'required|exists:leads,id'
        ];
    }
}
