<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WayRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'way_type' => 'required|integer|max:255',
            'horizontal' => 'required|numeric',
            'vertical' => 'required|numeric',
            'address' => 'required|string|max:255',
            'languages_idlanguages' => 'required|integer|exists:languages,idlanguages',
            'categories_idcategories' => 'required|integer|exists:categories,idcategories',
            'cities_idcities' => 'required|integer|exists:cities,idcities',
            'places_idplaces' => 'required|integer|exists:places,idplaces',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The way name is required.',
            'way_type.required' => 'The way type is required.',
            'horizontal.required' => 'The horizontal coordinate is required.',
            'vertical.required' => 'The vertical coordinate is required.',
            'address.required' => 'The address is required.',
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
