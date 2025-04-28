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
            'language-package' => $this->language_package,
            'lang_name' => $this->lang_name,
            'lang_type' => $this->lang_type,
            'admin' => new AdminResource($this->admin),
            'created_at' => $this->created_at,
        ];
    }
}
 