<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->iduser,
            // 'name' => $this->name, // حسب الجدول
            // 'email' => $this->email, // حسب الجدول
            'language' => new LanguageResource($this->language),
            'social' => new SocialResource($this->social),
            'place' => new PlaceResource($this->place),
            'city' => new CityResource($this->city),
            'service' => new ServiceResource($this->service),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
