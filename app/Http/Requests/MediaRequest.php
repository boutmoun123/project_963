<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'med_name' => 'required|string|max:255',
            'med_type' => 'required|integer',
            'med_content' => 'required|file|mimes:jpeg,png,jpg,gif,mp3,mp4,webm,txt,zip|max:1048576',
            'languages_idlanguages' => 'required|integer|exists:languages,idlanguages',
            'categories_idcategories' => 'required|integer|exists:categories,idcategories',
            'cities_idcities' => 'required|integer|exists:cities,idcities',
            'places_idplaces' => 'required|integer|exists:places,idplaces',
        ];
    }

    public function messages(): array
    {
        return [
            'med_name.required' => 'The media name is required.',
            'med_type.required' => 'The media type is required.',
            'med_content.required' => 'The media file is required.',
            'med_content.file' => 'The media must be a file.',
            'med_content.mimes' => 'The media must be a file of type: jpeg, png, jpg, gif, mp3, mp4, webm, txt, zip.',
            'med_content.max' => 'The media file may not be greater than 1GB.',
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