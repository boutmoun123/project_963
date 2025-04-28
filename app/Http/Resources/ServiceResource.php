<?PHP

// app/Http/Resources/ServiceResource.php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
                'id' => $this->idservices,
                'ser_name' => $this->ser_name, 
                'languages_idlanguages' => $this->languages_idlanguages,
                'admin_idadmin' => $this->admin_idadmin,
                'media_idmedia' => $this->media_idmedia,
                'links_idlinks' => $this->links_idlinks,
                'places_idplaces' => $this->places_idplaces,
                'cities_idcities' => $this->cities_idcities,
                'category' => new CategoryResource($this->category),
                'created_at' => $this->created_at, 
                'updated_at' => $this->updated_at,
        ];

}
}