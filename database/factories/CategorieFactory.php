<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategorieFactory extends Factory
{
    protected $model = \App\Models\Categorie::class;

    public function definition()
    {
        $nom = $this->faker->word();

        return [
            'nom' => ucfirst($nom),
            'description' => $this->faker->sentence(12),
            'icone' => $this->faker->imageUrl(50, 50, 'technics'),
            'image' => $this->faker->imageUrl(300, 200, 'technics'),
            'est_active' => $this->faker->boolean(90),
            'ref' => $this->faker->uuid(),
        ];
    }
}
