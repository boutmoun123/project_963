<?php


namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->idmedia,
            'med_name' => $this->med_name, 
            'med_type' => $this->med_type,
            'med_content' => $this->med_content,// حسب الجدول
            'language' => new LanguageResource($this->language),
            'admin' => new AdminResource($this->admin),
            'created_at' => $this->created_at,
        ];
    }
} 
 