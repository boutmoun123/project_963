<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        // You can manage access permissions for this request if needed
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'cat_name' => 'string|max:255',
            'cat_type' => 'integer|max:255',
            'cat_photo' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,webm|max:1048576',
            'description' => 'string',
            'languages_idlanguages' => 'integer|exists:languages,idlanguages'
        ];

        // Add required rule only for new categories
        if ($this->isMethod('POST')) {
            $rules['cat_name'] = 'required|' . $rules['cat_name'];
            $rules['cat_type'] = 'required|' . $rules['cat_type'];
            $rules['cat_photo'] = 'required|' . $rules['cat_photo'];                     
            $rules['description'] = 'required|' . $rules['description'];
            $rules['languages_idlanguages'] = 'required|' . $rules['languages_idlanguages'];
        }

        return $rules;
    }
 
    public function messages(): array
    {
        return [
            'cat_name.required' => 'The category name is required.',
            'cat_name.string' => 'The category name must be a string.',
            'cat_name.max' => 'The category name may not be greater than 255 characters.',
            
            'cat_type.required' => 'The category type is required.',
            'cat_type.integer' => 'The category type must be an integer.',
            'cat_type.max' => 'The category type must be less than 255.',

            
            'languages_idlanguages.required' => 'The language ID is required.',
            'languages_idlanguages.integer' => 'The language ID must be an integer.',
            'languages_idlanguages.exists' => 'The selected language does not exist.'
        ];
    }
}
