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
            'link_name' => 'required|string|max:255',
            'link_http' => 'required|string|max:255',
            'languages_idlanguages' => 'required|integer|exists:languages,idlanguages',
            'admin_idadmin' => 'required|integer|exists:admins,idadmin',
            'media_idmedia' => 'required|integer|exists:media,idmedia',
            'socials_idsocials' => 'required|integer|exists:socials,idsocials',
        ];
    }

    public function messages(): array
    {
        return [
            'link_name.required' => 'The link name is required.',
            'link_http.required' => 'The link http is required.',
            'languages_idlanguages.required' => 'The language ID is required.',
            'languages_idlanguages.exists' => 'The selected language does not exist.',
            'admin_idadmin.required' => 'The admin ID is required.',
            'admin_idadmin.exists' => 'The selected admin does not exist.',
            'media_idmedia.required' => 'The media ID is required.',
            'media_idmedia.exists' => 'The selected media does not exist.',
        ];
    }
} 