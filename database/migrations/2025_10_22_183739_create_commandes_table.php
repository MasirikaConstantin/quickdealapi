<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->string('numero_commande')->unique();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->decimal('sous_total', 10, 2);
            $table->decimal('montant_taxe', 10, 2)->default(0);
            $table->decimal('frais_livraison', 10, 2)->default(0);
            $table->decimal('montant_total', 10, 2);
            $table->enum('statut', ['en_attente', 'confirmee', 'en_traitement', 'expediee', 'livree', 'annulee'])->default('en_attente');
            $table->enum('statut_paiement', ['en_attente', 'payee', 'echouee', 'remboursee'])->default('en_attente');
            $table->string('methode_paiement')->nullable();
            $table->text('adresse_livraison');
            $table->text('adresse_facturation')->nullable();
            $table->string('numero_suivi')->nullable();
            $table->timestamp('annulee_le')->nullable();
            $table->timestamp('livree_le')->nullable();
            $table->uuid("ref")->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
