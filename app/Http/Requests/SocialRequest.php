<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SocialRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'social_name' => 'required|string|max:255',
            'social_address' => 'required|string|max:255',
            'languages_idlanguages' => 'required|integer|exists:languages,idlanguages',
            'admin_idadmin' => 'required|integer|exists:admins,idadmin',
        ];
    }

    public function messages()
    {
        return [
            'social_name.required' => 'The social media name is required.',
            'social_address.required' => 'The social media URL is required.',
            'social_address.url' => 'Please provide a valid URL.',
            'languages_idlanguages.required' => 'The language ID is required.',
            'languages_idlanguages.exists' => 'The selected language does not exist.',
            'admin_idadmin.required' => 'The admin ID is required.',
            'admin_idadmin.exists' => 'The selected admin does not exist.',
        ];
    }
}

