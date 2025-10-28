<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Produit;
use Illuminate\Support\Str;

class VariationProduitFactory extends Factory
{
    protected $model = \App\Models\VariationProduit::class;

    public function definition()
    {
        $produitIds = Produit::pluck('id')->toArray();
        $types = ['taille', 'couleur', 'matiere'];

        $type = $this->faker->randomElement($types);
        $valeurs = [
            'taille' => ['S', 'M', 'L', 'XL'],
            'couleur' => ['Rouge', 'Bleu', 'Vert', 'Noir'],
            'matiere' => ['Coton', 'Polyester', 'Laine', 'Lin'],
        ];

        return [
            'produit_id' => $this->faker->randomElement($produitIds),
            'type' => $type,
            'valeur' => $this->faker->randomElement($valeurs[$type]),
            'ajout_prix' => $this->faker->randomFloat(2, 0, 50),
            'stock' => $this->faker->numberBetween(0, 100),
            'ref' => $this->faker->uuid(),
            'sku' => strtoupper(Str::random(8)),
        ];
    }
}
