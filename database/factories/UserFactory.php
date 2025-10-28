<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = \App\Models\User::class;

    public function definition()
    {
        $roles = ['utilisateur', 'vendeur', 'admin'];

        return [
            'prenom' => $this->faker->firstName(),
            'nom' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'telephone' => $this->faker->phoneNumber(),
            'password' => Hash::make('password'), // mot de passe par défaut
            'role' => $this->faker->randomElement($roles),
            'bio' => $this->faker->sentence(10),
            //'avatar' => $this->faker->imageUrl(200, 200, 'people'),
            'adresse' => $this->faker->streetAddress(),
            'ville' => $this->faker->city(),
            'code_postal' => $this->faker->postcode(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'est_actif' => $this->faker->boolean(90), // 90% chance actif
            'note_vendeur' => $this->faker->randomFloat(2, 0, 5),
            'ventes_totales' => $this->faker->numberBetween(0, 1000),
            'ref' => $this->faker->uuid(),
            'remember_token' => Str::random(10),
        ];
    }
}
