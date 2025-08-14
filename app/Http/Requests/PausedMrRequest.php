<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PausedMrRequest extends FormRequest
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
            'days' => 'required|integer|gte:10',
        ];

        return $rules;
    }
    public function messages(): array
    {
        return [
            'days.gte' => 'You have to pause for at least 10 days ',
        ];
    }
}
