<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LinkResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->idlinks,
            'link_name' => $this->link_name,
            'link_http' => $this->link_http,
            'link_type' => $this->link_type,
            'languages_idlanguages' => $this->languages_idlanguages,
            'categories_idcategories' => $this->categories_idcategories,
            'cities_idcities' => $this->cities_idcities,
            'places_idplaces' => $this->places_idplaces,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];

        \Log::info('Resource data being returned:', $data);
        return $data;
    }
}
 