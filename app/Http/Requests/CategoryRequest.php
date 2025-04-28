<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize()
    {
        // You can manage access permissions for this request if needed
        return true;
    }

    public function rules()
    {
        return [
            'cat_name' => 'required|string|max:255',
            'cat_type' => 'required|integer|max:255',
            'languages_idlanguages' => 'required|integer|exists:languages,idlanguages',
            'admin_idadmin' => 'required|integer|exists:admins,idadmin',
            'media_idmedia' => 'required|integer|exists:media,idmedia',
            'links_idlinks' => 'required|integer|exists:links,idlinks',
        ];
    }
 
    public function messages()
    {
        return [
            'cat_name.required' => 'The name field is required.',
            'cat_type.required' => 'The category type is required.',
            'languages_idlanguages.required' => 'The language ID is required.',
            'languages_idlanguages.exists' => 'The selected language does not exist.',
            'admin_idadmin.required' => 'The admin ID is required.',
            'admin_idadmin.exists' => 'The selected admin does not exist.',
            'media_idmedia.required' => 'The media ID is required.',
            'media_idmedia.exists' => 'The selected media does not exist.',
        ];
    }
}
