<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Panier;
use App\Models\Produit;
use App\Models\VariationProduit;

class ArticlePanierFactory extends Factory
{
    protected $model = \App\Models\ArticlePanier::class;

    public function definition()
    {
        $panierIds = Panier::pluck('id')->toArray();
        $produitIds = Produit::pluck('id')->toArray();
        $variationIds = VariationProduit::pluck('id')->toArray();

        $produitId = $this->faker->randomElement($produitIds);
        $variationId = $this->faker->boolean(50) ? $this->faker->randomElement($variationIds) : null;
        $quantite = $this->faker->numberBetween(1, 5);
        $prix_unitaire = $this->faker->randomFloat(2, 10, 500);

        return [
            'panier_id' => $this->faker->randomElement($panierIds),
            'produit_id' => $produitId,
            'variation_produit_id' => $variationId,
            'quantite' => $quantite,
            'prix_unitaire' => $prix_unitaire,
            'ref' => $this->faker->uuid(),
        ];
    }
}
