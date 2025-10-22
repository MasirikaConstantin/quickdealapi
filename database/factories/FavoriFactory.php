<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Produit;

class FavoriFactory extends Factory
{
    protected $model = \App\Models\Favori::class;

    public function definition()
    {
        $userIds = User::pluck('id')->toArray();
        $produitIds = Produit::pluck('id')->toArray();

        return [
            'user_id' => $this->faker->randomElement($userIds),
            'produit_id' => $this->faker->randomElement($produitIds),
            'ref' => $this->faker->uuid(),
        ];
    }
}
