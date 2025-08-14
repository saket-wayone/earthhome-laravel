<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class BookValidate extends FormRequest
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
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    
        // If it's an update operation, exclude password validation and adjust email validation
        if ($request->has('book_id')) {
            $userId = $request->post('book_id'); // Assuming you're passing the user model through the route
            $rules['title'] = 'required|unique:books,title,' . $userId;
            $rules['cover_image'] ='sometimes|image|mimes:jpeg,png,jpg,gif|max:2048';

        } else {
            // For other operations (e.g., create), include password validation and normal email validation
            $rules['title'] = 'required|unique:books,title';
            $rules['cover_image'] ='required|image|mimes:jpeg,png,jpg,gif|max:2048';
        }
    
        return $rules;
    }
}
