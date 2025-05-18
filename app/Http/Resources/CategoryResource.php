<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->idcategories,
            'cat_name' => $this->cat_name,
            'cat_type' => $this->cat_type,
            'cat_photo' => $this->cat_photo,
            'description' => $this->description,
            'languages_idlanguages' => $this->languages_idlanguages,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
 