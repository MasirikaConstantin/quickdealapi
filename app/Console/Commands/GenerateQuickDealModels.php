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
            'Categorie' => '-a',
            'Produit' => '-a', 
            'VariationProduit' => '-a',
            'Panier' => '-a',
            'ArticlePanier' => '-a',
            'Commande' => '-a',
            'ArticleCommande' => '-a',
            'Avis' => '-a',
            'Favori' => '-a',
            'Conversation' => '-a',
            'Message' => '-a',
            'Notification' => '-a',
            'Paiement' => '-a',
            'MethodeLivraison' => '-a'
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