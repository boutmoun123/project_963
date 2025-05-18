<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WayResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->idway,
            'name' => $this->name,
            'way_type' => $this->way_type,
            'horizontal' => $this->horizontal,
            'vertical' => $this->vertical,
            'address' => $this->address,
            'languages_idlanguages' => $this->languages_idlanguages,
            'categories_idcategories' => $this->categories_idcategories,
            'cities_idcities' => $this->cities_idcities,
            'places_idplaces' => $this->places_idplaces,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
