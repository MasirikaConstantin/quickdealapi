<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'prenom' => $this->whenHas('prenom', $this->resource->prenom),
            'email' => $this->whenHas('email', $this->resource->email),
            'role' => $this->whenHas('role', $this->resource->role),
            'ref' => $this->whenHas('ref', $this->resource->ref),
            'full_name' => $this->whenHas('full_name', $this->resource->full_name),
            'created_at' => $this->whenHas('created_at', $this->resource->created_at),
            'updated_at' => $this->whenHas('updated_at', $this->resource->updated_at),
        ];
    }
}
