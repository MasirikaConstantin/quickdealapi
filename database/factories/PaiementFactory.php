<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Commande;

class PaiementFactory extends Factory
{
    protected $model = \App\Models\Paiement::class;

    public function definition()
    {
        $userIds = User::pluck('id')->toArray();
        $commandeIds = Commande::pluck('id')->toArray();
        $statuts = ['en_attente', 'payee', 'echouee', 'remboursee'];

        return [
            'user_id' => $this->faker->randomElement($userIds),
            'commande_id' => $this->faker->randomElement($commandeIds),
            'statut' => $this->faker->randomElement($statuts),
        ];
    }
}
