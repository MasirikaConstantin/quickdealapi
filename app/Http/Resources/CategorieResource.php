<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategorieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->whenHas('id', $this->resource->id),
            'nom' => $this->whenHas('nom', $this->resource->nom),
            'description' => $this->whenHas('description', $this->resource->description),
            'icone' => $this->whenHas('icone', $this->resource->icone),
            'image' => $this->whenHas('image', $this->resource->image),
            'est_active' => $this->whenHas('est_active', $this->resource->est_active),
            'ref' => $this->whenHas('ref', $this->resource->ref),
            'created_at' => $this->whenHas('created_at', $this->resource->created_at),
            'updated_at' => $this->whenHas('updated_at', $this->resource->updated_at),
        ];
    }
}
