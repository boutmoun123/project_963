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
            'languages_idlanguages' => 'required|exists:languages,idlanguages',
            'socials_idsocials' => 'nullable|exists:socials,idsocials',
            'places_idplaces' => 'nullable|exists:places,idplaces',
            'services_idservices' => 'nullable|exists:services,idservices',
            'categories_idcategories' => 'nullable|exists:categories,idcategories',
            'links_idlinks' => 'nullable|exists:links,idlinks',
            'cities_idcities' => 'nullable|exists:cities,idcities',
        ];

    }
}
// 'email' => 'required|string|email|max:255|unique:users,email,' //.$userId = $this->route('user')
//  'password' => 'required|string|min:6',
