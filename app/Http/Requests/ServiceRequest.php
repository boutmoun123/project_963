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
            'ser_type' => 'required|integer|min:0|max:127',
            'ser_photo' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,webm|max:1048576',
            'description' => 'nullable|string',
            'languages_idlanguages' => 'required|integer|exists:languages,idlanguages',
            'categories_idcategories' => 'required|integer|exists:categories,idcategories',
            'cities_idcities' => 'required|integer|exists:cities,idcities'
        ];
    }

    public function messages(): array
    {
        return [
            'ser_name.required' => 'The service name is required.',
            'ser_name.max' => 'The service name may not be greater than 45 characters.',
            'ser_type.required' => 'The service type is required.',
            'ser_type.integer' => 'The service type must be an integer.',
            'ser_type.min' => 'The service type must be at least 0.',
            'ser_type.max' => 'The service type must be less than 127.',
            'ser_photo.file' => 'The service photo must be a file.',
            'ser_photo.mimes' => 'The service photo must be a valid image or video file.',
            'ser_photo.max' => 'The service photo may not be larger than 1MB.',
            'description.string' => 'The description must be a string.',
            'languages_idlanguages.required' => 'The language ID is required.',
            'languages_idlanguages.exists' => 'The selected language does not exist.',
            'categories_idcategories.required' => 'The category ID is required.',
            'categories_idcategories.exists' => 'The selected category does not exist.',
            'cities_idcities.required' => 'The city ID is required.',
            'cities_idcities.exists' => 'The selected city does not exist.'
        ];
    }
}
