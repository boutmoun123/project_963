<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WayRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'horizontal' => 'required|numeric|min:0|max:100',
            'vertical' => 'required|numeric|min:0|max:100',
            'address' => 'nullable|string|max:255',
            'way_add' => 'required|string|max:255',
            'cities_idcities' => 'required|exists:cities,idcities',          
            'places_idplaces' => 'required|exists:places,idplaces',
            'services_idservices' => 'required|exists:services,idservices',
            'links_idlinks' => 'required|exists:links,idlinks',
            'admin_idadmin' => 'required|exists:admins,idadmin',
            'languages_idlanguages' => 'required|exists:languages,idlanguages',
            'socials_idsocials' => 'required|exists:socials,idsocials',
        ];
    }
       
}  
