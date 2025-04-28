<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    public function authorize()
    {
        // You can manage access permissions for this request if needed
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The admin name is required.',
            // 'email.required' => 'The email is required.',
            // 'email.email' => 'Please provide a valid email address.',
            // 'password.required' => 'The password is required.',
            // 'password.min' => 'The password must be at least 8 characters.',
            'role.required' => 'The role is required.',
            'role.in' => 'The role must be either admin or super-admin.',
        ];
    }
}
