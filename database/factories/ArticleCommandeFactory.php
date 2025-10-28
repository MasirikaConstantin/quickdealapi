<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Commande;
use App\Models\Produit;
use App\Models\VariationProduit;

class ArticleCommandeFactory extends Factory
{
    protected $model = \App\Models\ArticleCommande::class;

    public function definition()
    {
        $commandeIds = Commande::pluck('id')->toArray();
        $produitIds = Produit::pluck('id')->toArray();
        $variationIds = VariationProduit::pluck('id')->toArray();

        $produitId = $this->faker->randomElement($produitIds);
        $variationId = $this->faker->boolean(50) ? $this->faker->randomElement($variationIds) : null;
        $quantite = $this->faker->numberBetween(1, 5);
        $prix_unitaire = $this->faker->randomFloat(2, 10, 500);

        return [
            'commande_id' => $this->faker->randomElement($commandeIds),
            'produit_id' => $produitId,
            'variation_produit_id' => $variationId,
            'nom_produit' => 'Produit ' . $produitId,
            'prix_unitaire' => $prix_unitaire,
            'quantite' => $quantite,
            'prix_total' => $prix_unitaire * $quantite,
            'ref' => $this->faker->uuid(),
        ];
    }
}
