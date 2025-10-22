<?php

use App\Models\Panier;
use App\Models\Produit;
use App\Models\VariationProduit;
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
        Schema::create('article_paniers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Panier::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Produit::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(VariationProduit::class)->nullable()->constrained()->nullOnDelete();
            $table->integer('quantite')->default(1);
            $table->uuid("ref")->unique();
            $table->decimal('prix_unitaire', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paniers');
    }
};
