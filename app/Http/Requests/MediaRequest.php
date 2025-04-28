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
            'med_type' => 'required|integer|max:255',
            'med_content' => 'required|string|max:255',
            'languages_idlanguages' => 'required|integer|exists:languages,idlanguages',
            'admin_idadmin' => 'required|integer|exists:admins,idadmin',
        ];
    }

    public function messages(): array
    {
        return [
            'med_name.required' => 'The media name is required.',
            'med_type.required' => 'The media type is required.',
            'med_content.required' => 'The media content is required.',
            'languages_idlanguages.required' => 'The language ID is required.',
            'languages_idlanguages.exists' => 'The selected language does not exist.',
            'admin_idadmin.required' => 'The admin ID is required.',
            'admin_idadmin.exists' => 'The selected admin does not exist.',
        ];
    }
}  