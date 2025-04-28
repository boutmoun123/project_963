<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->idcategories,
            'cat_name' => $this->cat_name,
            'cat_type' => $this->cat_type, 
            'languages_idlanguages' => $this->languages_idlanguages,
            'admin_idadmin' => $this->admin_idadmin,
            'media_idmedia' => $this->media_idmedia,
            'links_idlinks' => $this->links_idlinks,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
 