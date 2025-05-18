<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'languages_idlanguages' => 'required|integer|exists:languages,idlanguages',
            'socials_idsocials' => 'required|integer|exists:socials,idsocials',
            'way_idway' => 'required|integer|exists:way,idway',
            'places_idplaces' => 'required|integer|exists:places,idplaces',
            'media_idmedia' => 'required|integer|exists:media,idmedia',
            'services_idservices' => 'required|integer|exists:services,idservices',
            'categories_idcategories' => 'required|integer|exists:categories,idcategories',
            'links_idlinks' => 'required|integer|exists:links,idlinks',
            'cities_idcities' => 'required|integer|exists:cities,idcities'
        ];
    }

    public function messages(): array
    {
        return [
            'languages_idlanguages.required' => 'The language ID is required.',
            'languages_idlanguages.exists' => 'The selected language does not exist.',
            'socials_idsocials.required' => 'The social ID is required.',
            'socials_idsocials.exists' => 'The selected social does not exist.',
            'way_idway.required' => 'The way ID is required.',
            'way_idway.exists' => 'The selected way does not exist.',
            'places_idplaces.required' => 'The place ID is required.',
            'places_idplaces.exists' => 'The selected place does not exist.',
            'media_idmedia.required' => 'The media ID is required.',
            'media_idmedia.exists' => 'The selected media does not exist.',
            'services_idservices.required' => 'The service ID is required.',
            'services_idservices.exists' => 'The selected service does not exist.',
            'categories_idcategories.required' => 'The category ID is required.',
            'categories_idcategories.exists' => 'The selected category does not exist.',
            'links_idlinks.required' => 'The link ID is required.',
            'links_idlinks.exists' => 'The selected link does not exist.',
            'cities_idcities.required' => 'The city ID is required.',
            'cities_idcities.exists' => 'The selected city does not exist.'
        ];
    }
}
// 'email' => 'required|string|email|max:255|unique:users,email,' //.$userId = $this->route('user')
//  'password' => 'required|string|min:6',
