<?PHP

// app/Http/Resources/ServiceResource.php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        \Log::info('Service resource data:', [
            'model' => $this->resource->toArray(),
            'ser_type' => $this->ser_type
        ]);

        $data = [
            'id' => $this->idservices,
            'ser_name' => $this->ser_name, 
            'ser_type' => $this->ser_type,
            'ser_photo' => $this->ser_photo,
            'description' => $this->description,
        
            'languages_idlanguages' => $this->languages_idlanguages,
            'categories_idcategories' => $this->categories_idcategories,
            'cities_idcities' => $this->cities_idcities,
            'created_at' => $this->created_at, 
            'updated_at' => $this->updated_at,
        ];

        \Log::info('Service resource response:', $data);
        return $data;
    }
}