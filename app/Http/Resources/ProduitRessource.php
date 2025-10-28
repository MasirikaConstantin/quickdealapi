<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
/**
 * @property Produit $resource
 */
class ProduitRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     *
     */
    
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->whenHas('id', $this->resource->id),
            'titre' => $this->whenHas('titre', $this->resource->titre),
            'description' => $this->whenHas('description', $this->resource->description),
            'prix' => $this->whenHas('prix', $this->resource->prix),
            'categorie_id' => $this->whenHas('categorie_id', $this->resource->categorie_id),
            'user_id' => $this->whenHas('user_id', $this->resource->user_id),
            'etat' => $this->whenHas('etat', $this->resource->etat),
            'images_thumb' => $this->whenHas('images', $this->resource->getFirstMediaUrl('image','thumb')),
            'images' => $this->whenHas('images', $this->resource->getFirstMediaUrl('image','medium')),
            'poids' => $this->whenHas('poids', $this->resource->poids),
            'dimensions' => $this->whenHas('dimensions', $this->resource->dimensions),
            'est_publie' => $this->whenHas('est_publie', $this->resource->est_publie),
            'est_en_vedette' => $this->whenHas('est_en_vedette', $this->resource->est_en_vedette),
            'nombre_vues' => $this->whenHas('nombre_vues', $this->resource->nombre_vues),
            'note' => $this->whenHas('note', $this->resource->note),
            'nombre_avis' => $this->whenHas('nombre_avis', $this->resource->nombre_avis),
            'ref' => $this->whenHas('ref', $this->resource->ref),
            'deleted_at' => $this->whenHas('deleted_at', $this->resource->deleted_at),
            'created_at' => $this->whenHas('created_at', $this->resource->created_at),
            'updated_at' => $this->whenHas('updated_at', $this->resource->updated_at),
            'categorie' =>  new CategorieResource($this->whenLoaded('categorie')),
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
