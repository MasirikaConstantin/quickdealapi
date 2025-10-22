<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class PanierFactory extends Factory
{
    protected $model = \App\Models\Panier::class;

    public function definition()
    {
        $userIds = User::pluck('id')->toArray();

        return [
            'user_id' => $this->faker->randomElement($userIds),
            'montant_total' => $this->faker->randomFloat(2, 0, 1000),
            'nombre_articles' => $this->faker->numberBetween(1, 10),
            'ref' => $this->faker->uuid(),
        ];
    }
}
