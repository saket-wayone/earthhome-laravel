<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ManagerValidate extends FormRequest
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
         $rules = [
             'role' => 'required',
             'name' => 'required',
             'phone' => 'required|max:10|min:10',
             'work_area' => 'required',
         ];
     
         // If it's an update operation, exclude password validation and adjust email validation
         if ($request->has('user_id')) {
             $userId = $request->post('user_id'); // Assuming you're passing the user model through the route
             $rules['email'] = 'required|email|unique:users,email,' . $userId;
         } else {
             // For other operations (e.g., create), include password validation and normal email validation
             $rules['password'] = 'required';
             $rules['email'] = 'required|email|unique:users,email';
         }
     
         return $rules;
     }
}
