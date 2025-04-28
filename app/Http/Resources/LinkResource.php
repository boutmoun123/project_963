<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LinkResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->idlinks,
            'link_name' => $this->link_name, // حسب الجدول
            'link_http' => $this->link_http,
            'language' => new LanguageResource($this->language),
            'admin' => new AdminResource($this->admin),
            'media' => new MediaResource($this->media),
            'social' => new SocialResource($this->social),
            'created_at' => $this->created_at,
        ];
    }
}
 