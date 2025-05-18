<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\StarResource;
use App\Http\Resources\ServiceResource;

class MediaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->idmedia,
            'med_name' => $this->med_name,
            'med_type' => $this->med_type,
            'med_content' => $this->med_content,
            'languages_idlanguages' => $this->languages_idlanguages,
            'categories_idcategories' => $this->categories_idcategories,
            'cities_idcities' => $this->cities_idcities,
            'places_idplaces' => $this->places_idplaces,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
} 
 