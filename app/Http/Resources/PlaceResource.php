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
            'photo' => $this->photo ?? '/storage/places/default.png',
            'description' => $this->description,
            'languages_idlanguages' => $this->languages_idlanguages,
            'categories_idcategories' => $this->categories_idcategories,
            'cities_idcities' => $this->cities_idcities,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'star' => $this->star,
            'service' => $this->service,
'date_created' => optional($this->getAttribute('date_created'))->format('Y-m-d'),
        ];
    }
         
}
