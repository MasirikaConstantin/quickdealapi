<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Produit;
use App\Models\User;

class ConversationFactory extends Factory
{
    protected $model = \App\Models\Conversation::class;

    public function definition()
    {
        $produitIds = Produit::pluck('id')->toArray();
        $userIds = User::pluck('id')->toArray();

        $acheteur = $this->faker->randomElement($userIds);
        $vendeur = $this->faker->randomElement($userIds);

        // S'assurer que ce n'est pas la même personne
        while ($vendeur === $acheteur) {
            $vendeur = $this->faker->randomElement($userIds);
        }

        return [
            'produit_id' => $this->faker->randomElement($produitIds),
            'acheteur_id' => $acheteur,
            'vendeur_id' => $vendeur,
            'dernier_message' => $this->faker->sentence(),
            'dernier_message_a' => $this->faker->dateTimeBetween('-30 days', 'now'),
            'acheteur_a_nouveau' => $this->faker->boolean(30),
            'vendeur_a_nouveau' => $this->faker->boolean(30),
        ];
    }
}
