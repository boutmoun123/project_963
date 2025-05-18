<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LinkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'link_name' => 'required|string|max:45',
            'link_http' => 'required|string|max:90',
            'link_type' => 'required|integer|min:0|max:127',
            'languages_idlanguages' => 'required|integer|exists:languages,idlanguages',
            'categories_idcategories' => 'required|integer|exists:categories,idcategories',
            'cities_idcities' => 'required|integer|exists:cities,idcities',
            'places_idplaces' => 'required|integer|exists:places,idplaces',
        ];
    }

    public function messages(): array
    {
        return [
            'link_name.required' => 'The link name is required.',
            'link_http.required' => 'The link URL is required.',
            'link_type.required' => 'The link type is required.',
            'link_type.integer' => 'The link type must be an integer.',
            'link_type.min' => 'The link type must be at least 0.',
            'link_type.max' => 'The link type must be less than 127.',
            'languages_idlanguages.required' => 'The language ID is required.',
            'languages_idlanguages.exists' => 'The selected language does not exist.',
            'categories_idcategories.required' => 'The category ID is required.',
            'categories_idcategories.exists' => 'The selected category does not exist.',
            'cities_idcities.required' => 'The city ID is required.',
            'cities_idcities.exists' => 'The selected city does not exist.',
            'places_idplaces.required' => 'The place ID is required.',
            'places_idplaces.exists' => 'The selected place does not exist.'
        ];
    }
} 