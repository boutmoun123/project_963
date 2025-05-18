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
        $rules = [
            'place_name' => 'string|max:255',
            'place_type' => 'integer|max:255',
            'place_photo' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,webm|max:1048576',
            'photo' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,webm|max:1048576',
            'description' => 'nullable|string',
            'languages_idlanguages' => 'integer|exists:languages,idlanguages',
            'categories_idcategories' => 'integer|exists:categories,idcategories',
            'cities_idcities' => 'integer|exists:cities,idcities',
            'star' => 'nullable|integer|exists:stars,idstars',
            'service' => 'nullable|integer|exists:services,idservices',
             'date_created' => 'nullable|date_format:Y-m-d',
        ];

        // Add required rule only for new places
        if ($this->isMethod('POST')) {
            $rules['place_name'] = 'required|' . $rules['place_name'];
            $rules['place_type'] = 'required|' . $rules['place_type'];
            $rules['place_photo'] = 'required|' . $rules['place_photo'];
            $rules['date_created'] = 'required|' . $rules['date_created'];
            $rules['languages_idlanguages'] = 'required|' . $rules['languages_idlanguages'];
            $rules['categories_idcategories'] = 'required|' . $rules['categories_idcategories'];
            $rules['cities_idcities'] = 'required|' . $rules['cities_idcities'];
            $rules['star'] = $rules['star'];
            $rules['service'] = $rules['service'];

        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'place_name.required' => 'The place name is required.',
            'place_name.string' => 'The place name must be a string.',
            'place_name.max' => 'The place name may not be greater than 255 characters.',
            
            'place_type.required' => 'The place type is required.',
            'place_type.integer' => 'The place type must be an integer.',
            'place_type.max' => 'The place type must be less than 255.',
            
            'place_photo.required' => 'The photo is required.',
            'place_photo.file' => 'The photo must be a file.',
            'place_photo.mimes' => 'The photo must be a file of type: jpeg, png, jpg, gif, mp4, webm.',
            'place_photo.max' => 'The photo may not be greater than 1GB.',
            
            'photo.file' => 'The photo must be a file.',
            'photo.mimes' => 'The photo must be a file of type: jpeg, png, jpg, gif, mp4, webm.',
            'photo.max' => 'The photo may not be greater than 1GB.',
            
            'description.string' => 'The description must be a string.',
            
            'languages_idlanguages.required' => 'The language ID is required.',
            'languages_idlanguages.integer' => 'The language ID must be an integer.',
            'languages_idlanguages.exists' => 'The selected language does not exist.',
            
            'categories_idcategories.required' => 'The category ID is required.',
            'categories_idcategories.integer' => 'The category ID must be an integer.',
            'categories_idcategories.exists' => 'The selected category does not exist.',
            
            'cities_idcities.required' => 'The city ID is required.',
            'cities_idcities.integer' => 'The city ID must be an integer.',
            'cities_idcities.exists' => 'The selected city does not exist.',
            
            'date_created.required' => 'The date created is required.',
            'date_created.date' => 'The date created must be a date.',
                
            'star.integer' => 'The star ID must be an integer.',
            'star.exists' => 'The selected star does not exist.',
            
            'service.integer' => 'The service ID must be an integer.',
            'service.exists' => 'The selected service does not exist.'
        ];
    }
} 
