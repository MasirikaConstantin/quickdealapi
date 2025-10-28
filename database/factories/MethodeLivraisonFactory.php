<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MethodeLivraisonFactory extends Factory
{
    protected $model = \App\Models\MethodeLivraison::class;

    public function definition()
    {
        $nom = $this->faker->word();

        return [
            'nom' => ucfirst($nom),
            'description' => $this->faker->sentence(15),
            'icone' => $this->faker->imageUrl(50, 50, 'transport'),
            'image' => $this->faker->imageUrl(300, 200, 'transport'),
            'est_active' => $this->faker->boolean(90),
            'ref' => $this->faker->uuid(),
        ];
    }
}
