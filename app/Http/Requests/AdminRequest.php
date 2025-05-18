<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    public function authorize(): bool
    {
        // You can manage access permissions for this request if needed
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name is required.',
            'password.required' => 'The password is required.',
            'password.min' => 'The password must be at least 8 characters.'
        ];
    }
}
