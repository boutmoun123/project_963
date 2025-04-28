<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'city_name' => 'required|string|max:255',
            'languages_idlanguages' => 'required|integer|exists:languages,idlanguages',
            'admin_idadmin' => 'required|integer|exists:admins,idadmin',
            'media_idmedia' => 'required|integer|exists:media,idmedia',
            'links_idlinks' => 'required|integer|exists:links,idlinks',
            'categories_idcategories' => 'required|integer|exists:categories,idcategories'
        ];
    }

    public function messages(): array
    {
        return [
            'city_name.required' => 'The city name is required.',
            'languages_idlanguages.required' => 'The language ID is required.',
            'languages_idlanguages.exists' => 'The selected language does not exist.',
            'admin_idadmin.required' => 'The admin ID is required.',
            'admin_idadmin.exists' => 'The selected admin does not exist.',
            'media_idmedia.required' => 'The media ID is required.',
            'media_idmedia.exists' => 'The selected media does not exist.',
            'links_idlinks.required' => 'The link ID is required.',
            'links_idlinks.exists' => 'The selected link does not exist.',
        ];
    }
}

