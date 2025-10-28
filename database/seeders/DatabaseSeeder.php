<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Créer 10 utilisateurs
        \App\Models\User::factory()->count(10)->create();

        // Créer 5 catégories
        \App\Models\Categorie::factory()->count(5)->create();

        // Créer 3 méthodes de livraison
        \App\Models\MethodeLivraison::factory()->count(3)->create();


        \App\Models\Produit::factory(120)->create();
        \App\Models\VariationProduit::factory(40)->create();
        //\App\Models\Panier::factory(10)->create();
        //\App\Models\ArticlePanier::factory(30)->create();
        //\App\Models\Commande::factory(15)->create();


        //\App\Models\Paiement::factory(15)->create();
        //\App\Models\ArticleCommande::factory(40)->create();
        //\App\Models\Avis::factory(30)->create();
        //\App\Models\Favori::factory(20)->create();
        //\App\Models\Conversation::factory(25)->create();
        //\App\Models\Message::factory(50)->create();
        //\App\Models\Notification::factory(30)->create();


    }
}
