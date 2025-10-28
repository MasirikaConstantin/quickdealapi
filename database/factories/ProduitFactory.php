<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Categorie;
use App\Models\User;

class ProduitFactory extends Factory
{
    protected $model = \App\Models\Produit::class;

    public function definition()
    {
        $categorieIds = Categorie::pluck('id')->toArray();
        $userIds = User::pluck('id')->toArray();

        return [
            'titre' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(2),
            'prix' => $this->faker->randomFloat(2, 10, 500),
            'prix_original' => $this->faker->randomFloat(2, 500, 1000),
            'quantite' => $this->faker->numberBetween(1, 50),
            'categorie_id' => $this->faker->randomElement($categorieIds),
            'user_id' => $this->faker->randomElement($userIds),
            'etat' => $this->faker->randomElement(['neuf', 'comme_neuf', 'bon', 'correct']),
            //'images' => json_encode([$this->faker->imageUrl(400, 400), $this->faker->imageUrl(400, 400)]),
            'poids' => $this->faker->randomFloat(2, 0.1, 5),
            'dimensions' => json_encode([
                'longueur' => $this->faker->randomFloat(2, 10, 100),
                'largeur' => $this->faker->randomFloat(2, 10, 100),
                'hauteur' => $this->faker->randomFloat(2, 5, 50),
            ]),
            'est_publie' => $this->faker->boolean(80),
            'est_en_vedette' => $this->faker->boolean(20),
            'nombre_vues' => $this->faker->numberBetween(0, 1000),
            'note' => $this->faker->randomFloat(2, 0, 5),
            'nombre_avis' => $this->faker->numberBetween(0, 100),
            'ref' => $this->faker->uuid(),
        ];
    }
}
