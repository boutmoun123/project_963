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
        $rules = [
            'city_name' => 'string|max:255',
            'city_type' => 'integer|max:255',
            'photo' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,webm|max:1048576',
            'description' => 'nullable|string',
            'languages_idlanguages' => 'integer|exists:languages,idlanguages',
            'categories_idcategories' => 'integer|exists:categories,idcategories'
        ];

        // Add required rule only for new cities
        if ($this->isMethod('POST')) {
            $rules['city_name'] = 'required|' . $rules['city_name'];
            $rules['city_type'] = 'required|' . $rules['city_type'];
            $rules['photo'] = 'required|' . $rules['photo'];
            $rules['languages_idlanguages'] = 'required|' . $rules['languages_idlanguages'];
            $rules['categories_idcategories'] = 'required|' . $rules['categories_idcategories'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'city_name.required' => 'The city name is required.',
            'city_name.string' => 'The city name must be a string.',
            'city_name.max' => 'The city name may not be greater than 255 characters.',
            
            'city_type.required' => 'The city type is required.',
            'city_type.integer' => 'The city type must be an integer.',
            'city_type.max' => 'The city type must be less than 255.',
            
            'photo.required' => 'The photo is required.',
            'photo.file' => 'The photo must be a file.',
            'photo.mimes' => 'The photo must be a file of type: jpeg, png, jpg, gif, mp4, webm.',
            'photo.max' => 'The photo may not be greater than 1MB.',
            
            'description.string' => 'The description must be a string.',
            
            'languages_idlanguages.required' => 'The language ID is required.',
            'languages_idlanguages.integer' => 'The language ID must be an integer.',
            'languages_idlanguages.exists' => 'The selected language does not exist.',
            
            'categories_idcategories.required' => 'The category ID is required.',
            'categories_idcategories.integer' => 'The category ID must be an integer.',
            'categories_idcategories.exists' => 'The selected category does not exist.'
        ];
    }
}

