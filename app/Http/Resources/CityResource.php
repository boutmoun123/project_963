<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->idcities,
            'city_name' => $this->city_name,
            'languages_idlanguages' => $this->languages_idlanguages,
            'admin_idadmin' => $this->admin_idadmin,
            'media_idmedia' => $this->media_idmedia,
            'links_idlinks' => $this->links_idlinks,
            'categories_idcategories' => $this->categories_idcategories,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
