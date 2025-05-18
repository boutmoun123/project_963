<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->iduser,
            'languages_idlanguages' => $this->languages_idlanguages,
            'socials_idsocials' => $this->socials_idsocials,
            'way_idway' => $this->way_idway,
            'places_idplaces' => $this->places_idplaces,
            'media_idmedia' => $this->media_idmedia,
            'services_idservices' => $this->services_idservices,
            'categories_idcategories' => $this->categories_idcategories,
            'links_idlinks' => $this->links_idlinks,
            'cities_idcities' => $this->cities_idcities,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
