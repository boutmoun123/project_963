<?PHP

// app/Http/Resources/ServiceResource.php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class  StarResource  extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->idstars,
            'star_type' => $this->star_type,
            'number' => $this->number,
            'languages_idlanguages' => $this->languages_idlanguages,
            'categories_idcategories' => $this->categories_idcategories,
            'cities_idcities' => $this->cities_idcities,
            'services_idservices' => $this->services_idservices,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
         
}
