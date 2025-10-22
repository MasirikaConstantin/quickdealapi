<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class CommandeFactory extends Factory
{
    protected $model = \App\Models\Commande::class;

    public function definition()
    {
        $userIds = User::pluck('id')->toArray();
        $statuts = ['en_attente', 'confirmee', 'en_traitement', 'expediee', 'livree', 'annulee'];
        $statutsPaiement = ['en_attente', 'payee', 'echouee', 'remboursee'];

        $sous_total = $this->faker->randomFloat(2, 50, 1000);
        $frais_livraison = $this->faker->randomFloat(2, 5, 50);
        $montant_taxe = $sous_total * 0.18; // exemple 18% taxe
        $montant_total = $sous_total + $frais_livraison + $montant_taxe;

        return [
            'numero_commande' => strtoupper($this->faker->unique()->bothify('CMD###??')),
            'user_id' => $this->faker->randomElement($userIds),
            'sous_total' => $sous_total,
            'montant_taxe' => $montant_taxe,
            'frais_livraison' => $frais_livraison,
            'montant_total' => $montant_total,
            'statut' => $this->faker->randomElement($statuts),
            'statut_paiement' => $this->faker->randomElement($statutsPaiement),
            'methode_paiement' => $this->faker->randomElement(['Carte bancaire', 'Paypal', 'Espèces']),
            'adresse_livraison' => $this->faker->address(),
            'adresse_facturation' => $this->faker->address(),
            'numero_suivi' => $this->faker->boolean(70) ? strtoupper($this->faker->bothify('TRK######')) : null,
            'annulee_le' => $this->faker->boolean(10) ? now() : null,
            'livree_le' => $this->faker->boolean(50) ? now() : null,
            'ref' => $this->faker->uuid(),
        ];
    }
}
