<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class GenerateQuickDealModels extends Command
{
    protected $signature = 'quickdeal:models';
    protected $description = 'Génère tous les models pour QuickDeal avec leurs migrations, factories et controllers';

    public function handle()
    {
        $this->info('🚀 Génération des models QuickDeal...');

        $models = [
            // 1. Tables indépendantes
            //'User' => '-a',
            'Categorie' => '-a',
            'MethodeLivraison' => '-a',
            
            // 2. Tables qui dépendent de User et Categorie
            'Produit' => '-a', // Dépend de User et Categorie
            'VariationProduit' => '-a', // Dépend de Produit
            
            // 3. Tables de panier (dépendent de User et Produit)
            'Panier' => '-a', // Dépend de User
            'ArticlePanier' => '-a', // Dépend de Panier et Produit
            
            // 4. Tables de commandes (dépendent de User, Produit, MéthodeLivraison)
            'Commande' => '-a', // Dépend de User et MethodeLivraison
            'ArticleCommande' => '-a', // Dépend de Commande et Produit
            'Paiement' => '-a', // Dépend de Commande
            
            // 5. Tables sociales (dépendent de User, Produit, Commande)
            'Avis' => '-a', // Dépend de User, Produit, Commande
            'Favori' => '-a', // Dépend de User et Produit
            
            // 6. Tables de messagerie (dépendent de User et Produit)
            'Conversation' => '-a', // Dépend de User (acheteur/vendeur) et Produit
            'Message' => '-a', // Dépend de Conversation et User
            
            // 7. Tables de notifications (dépendent de User)
            'Notification' => '-a', // Dépend de User
        ];

        $this->info('📁 Création des models avec leurs fichiers...');
        
        $bar = $this->output->createProgressBar(count($models));
        $bar->start();

        foreach ($models as $model => $options) {
            $this->line("\nCréation: {$model}");
            Artisan::call("make:model {$model} {$options}");
            $bar->advance();
        }

        $bar->finish();
        
        $this->info("\n✅ Tous les models sont créés!");
        $this->info('🎉 Models générés: ' . implode(', ', array_keys($models)));
        
        return Command::SUCCESS;
    }
}