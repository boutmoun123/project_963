<?php



namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'language_package' => 'nullable|string|max:255',
            'lang_name' => 'required|string|max:255',
            'lang_type' => 'required|integer|max:50',
            'admin_idadmin'=>'required|integer|max:50',
        ];
    } 
    public function messages()
{
    return [
        'language_package.required' => 'The language package field is required.',
       // 'lang_name.required' => 'The name field is required.',
        'lang_type.required' => 'The language type field is required.',
    ];
}

}
