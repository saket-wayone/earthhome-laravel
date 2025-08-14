<?php

namespace App\Http\Requests;
use Illuminate\Http\Request;

use Illuminate\Foundation\Http\FormRequest;


class LeadRequest extends FormRequest
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
    public function rules(Request $request): array
    {
        $rules = [
            'user_id' => 'required',
                        'name' => 'required',

            'project_status' => 'required',
            'total_amount' => 'required',
        ];
    
        // If it's an update operation, exclude password validation and adjust email validation
        // if ($request->has('user_id')) {
        //     $userId = $request->post('user_id'); // Assuming you're passing the user model through the route
        //     $rules['email'] = 'required';
        // } else {
        //     // For other operations (e.g., create), include password validation and normal email validation
        //     $rules['email'] = 'required';
        // }
    
        return $rules;
    }
}
