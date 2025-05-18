<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'type' => 'required|integer|min:0|max:127',
            'admin_idadmin' => 'required|integer|exists:admins,idadmin'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The language name field is required.',
            'name.string' => 'The language name must be a string.',
            'name.max' => 'The language name may not be greater than 255 characters.',
            
            'code.required' => 'The language code field is required.',
            'code.string' => 'The language code must be a string.',
            'code.max' => 'The language code may not be greater than 255 characters.',

            'type.required' => 'The language type field is required.',
            'type.integer' => 'The language type must be an integer.',
            'type.min' => 'The language type must be between 0 and 127.',
            'type.max' => 'The language type may not be greater than 127.',

            'admin_idadmin.required' => 'The admin ID field is required.',
            'admin_idadmin.integer' => 'The admin ID must be an integer.',
            'admin_idadmin.exists' => 'The admin ID must exist in the admins table.'
        ];
    }
}
