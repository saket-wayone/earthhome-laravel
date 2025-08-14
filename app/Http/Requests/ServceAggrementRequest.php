<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ServceAggrementRequest extends FormRequest
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
        $rules = [
            'client_type' => 'required|string',
            'clientname' => 'required|string',
            'clientplace' => 'required|string',
            'days' => 'nullable|integer',
            'months' => 'nullable|integer',
            'package' => 'required|string',
            'packageamount' => 'required|numeric',
            'paidamount' => 'required|numeric',
            'discountamount' => 'nullable|numeric',
            'discountpercentage' => 'nullable|integer',
            'balanceamount' => 'nullable|numeric',
            'bookingprofitamount' => 'nullable|numeric',
            'email' => 'required|email',
            'mobile' => 'required|string',
            'pancard' => 'required|string',
            'investamount' => 'required|numeric',
            'expirydate' => 'required|date',
            'riskscore' => 'required',
        ];

        return $rules;
    }
}
