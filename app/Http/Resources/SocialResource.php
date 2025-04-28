<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SocialResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->idsocials,
            'social_name' => $this->social_name,
            'social_address' => $this->social_address,
            'language' => new LanguageResource($this->language),
            'admin' => new AdminResource($this->admin),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
 