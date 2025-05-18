<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LanguageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->idlanguages,
            'name' => $this->name,
            'code' => $this->code,
            'type' => $this->type,
            'admin_idadmin'=>$this->admin_idadmin,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
 