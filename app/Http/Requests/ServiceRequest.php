<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ser_name' => 'required|string|max:45',
            'languages_idlanguages' => 'required|integer|exists:languages,idlanguages',
            'admin_idadmin' => 'required|integer|exists:admins,idadmin',
            'media_idmedia' => 'required|integer|exists:media,idmedia',
            'links_idlinks' => 'required|integer|exists:links,idlinks',
            'places_idplaces' => 'required|integer|exists:places,idplaces',
            'cities_idcities' => 'required|integer|exists:cities,idcities',
            'categories_idcategories' => 'required|integer|exists:categories,idcategories'
        ];
    }
    public function messages(): array
    {
        return [
            'ser_name.required' => 'The service name is required.',
            'languages_idlanguages.required' => 'The language ID is required.',
            'admin_idadmin.required' => 'The admin ID is required.',
            'media_idmedia.required' => 'The media ID is required.',
            'links_idlinks.required' => 'The link ID is required.',
            'places_idplaces.required' => 'The place ID is required.',
            'cities_idcities.required' => 'The city ID is required.',
        ];
    }
}
