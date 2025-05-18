<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'star_type' => 'required|integer|min:0|max:127',
            'number' => 'required|integer|min:0|max:127',
            'languages_idlanguages' => 'required|integer|exists:languages,idlanguages',
            'categories_idcategories' => 'required|integer|exists:categories,idcategories',
            'cities_idcities' => 'required|integer|exists:cities,idcities',
            'services_idservices' => 'required|integer|exists:services,idservices',
        ];
    }

    public function messages(): array
    {
        return [
            'star_type.required' => 'The star type is required.',
            'number.required' => 'The number is required.',
            'languages_idlanguages.required' => 'The language ID is required.',
            'languages_idlanguages.exists' => 'The selected language does not exist.',
            'categories_idcategories.required' => 'The category ID is required.',
            'categories_idcategories.exists' => 'The selected category does not exist.',
            'cities_idcities.required' => 'The city ID is required.',
            'cities_idcities.exists' => 'The selected city does not exist.',
            'services_idservices.required' => 'The service ID is required.',
            'services_idservices.exists' => 'The selected service does not exist.',
        ];
    }
}
