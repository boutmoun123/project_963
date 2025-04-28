<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlaceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->idplaces,
            'place_name' => $this->place_name,
            'place_type' => $this->place_type,
            'languages_idlanguages' => $this->languages_idlanguages,
            'admin_idadmin' => $this->admin_idadmin,
            'media_idmedia' => $this->media_idmedia,
            'links_idlinks' => $this->links_idlinks,
            'categories_idcategories' => $this->categories_idcategories,
            'cities_idcities' => $this->cities_idcities,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'city' => new CityResource($this->whenLoaded('city')),
            'media' => new MediaResource($this->whenLoaded('media')),
            'link' => new LinkResource($this->whenLoaded('link')),
            'admin' => new AdminResource($this->whenLoaded('admin')),
            'language' => new LanguageResource($this->whenLoaded('language')),
        ];
    }
         
}
