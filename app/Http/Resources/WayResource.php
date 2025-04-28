<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WayResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
                    'id' => $this->idway,
                    'name' => $this->name, // حسب الجدول
                    'city' => new CityResource($this->city), 
                    'horizontal'=>$this->horizontal,
                    'vertical'=>$this->vertical,
                    'address'=>$this->address,
                    'way_add'=>$this->way_add,
                    'created_at' => $this->created_at,
        ];
    }
}
