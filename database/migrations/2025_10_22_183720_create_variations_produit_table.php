<?php

use App\Models\Produit;
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
        Schema::create('variations_produit', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Produit::class)->constrained()->cascadeOnDelete();
            $table->string('type'); // 'taille', 'couleur', 'matiere'
            $table->string('valeur'); // 'XL', 'Rouge', 'Coton'
            $table->decimal('ajout_prix', 10, 2)->default(0);
            $table->integer('stock')->default(0);
            $table->uuid("ref")->unique();
            $table->string('sku')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variations_produit');
    }
};
