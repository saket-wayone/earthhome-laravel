<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StatusRequest extends FormRequest
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
    public function rules(Request $request)
    {
        

        if ($request->has('id')) {
            $userId = $request->post('id'); // Assuming you're passing the user model through the route
            $rules['status'] = 'required|unique:status,status,' . $userId;
        } else {
            // For other operations (e.g., create), include password validation and normal email validation
            $rules['status'] = 'required|unique:status';
        }
        return $rules;
    }
}
