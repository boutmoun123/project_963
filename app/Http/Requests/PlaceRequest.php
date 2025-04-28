<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'place_name' => 'required|string|max:255',
            'place_type' => 'required|integer|max:255',
            'languages_idlanguages' => 'required|integer|exists:languages,idlanguages',
            'admin_idadmin' => 'required|integer|exists:admins,idadmin',
            'media_idmedia' => 'required|integer|exists:media,idmedia',
            'links_idlinks' => 'required|integer|exists:links,idlinks',
            'categories_idcategories' => 'required|integer|exists:categories,idcategories',
            'cities_idcities' => 'required|integer|exists:cities,idcities'
        ];
    }

    public function messages(): array
    {
        return [
            'place_name.required' => 'The place name is required.',
            'place_type.required' => 'The place type is required.',
            'languages_idlanguages.required' => 'The language ID is required.',
            'languages_idlanguages.exists' => 'The selected language does not exist.',
            'admin_idadmin.required' => 'The admin ID is required.',
            'admin_idadmin.exists' => 'The selected admin does not exist.',
            'media_idmedia.required' => 'The media ID is required.',
            'media_idmedia.exists' => 'The selected media does not exist.',
            'links_idlinks.required' => 'The link ID is required.',
            'links_idlinks.exists' => 'The selected link does not exist.',
            'categories_idcategories.required' => 'The category ID is required.',
            'categories_idcategories.exists' => 'The selected category does not exist.',
            'cities_idcities.required' => 'The city ID is required.',
            'cities_idcities.exists' => 'The selected city does not exist.'
        ];
    }
} 
