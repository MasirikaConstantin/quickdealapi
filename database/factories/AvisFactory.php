<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Produit;
use App\Models\Commande;

class AvisFactory extends Factory
{
    protected $model = \App\Models\Avis::class;

    public function definition()
    {
        $userIds = User::pluck('id')->toArray();
        $produitIds = Produit::pluck('id')->toArray();
        $commandeIds = Commande::pluck('id')->toArray();

        return [
            'user_id' => $this->faker->randomElement($userIds),
            'produit_id' => $this->faker->randomElement($produitIds),
            'commande_id' => $this->faker->randomElement($commandeIds),
            'note' => $this->faker->numberBetween(1, 5),
            'commentaire' => $this->faker->boolean(70) ? $this->faker->sentence(10) : null,
            'images' => $this->faker->boolean(30) ? json_encode([$this->faker->imageUrl(200, 200)]) : null,
            'est_approuve' => $this->faker->boolean(80),
            'ref' => $this->faker->uuid(),
        ];
    }
}
