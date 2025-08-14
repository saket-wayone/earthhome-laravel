<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPassword extends FormRequest
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
            'newpassword' => 'required|min:8', // New password is required and must be at least 8 characters long
            'confirmpassword' => 'required|same:newpassword', // Confirm password is required and must match the new password
        ];
    
        return $rules;

    }
}
