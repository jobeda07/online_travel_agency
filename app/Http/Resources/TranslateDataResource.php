<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TranslateDataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
           // "id" => $this->id,
            "key" => $this->key ?? '',
            "lang_code" => $this->lang_code ?? '',
            "description" => $this->description ?? '',
        ];
    }
}
