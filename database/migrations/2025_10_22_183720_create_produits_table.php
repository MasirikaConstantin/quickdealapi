<?php

use App\Models\Categorie;
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
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description');
            $table->decimal('prix', 10, 2);
            $table->decimal('prix_original', 10, 2)->nullable();
            $table->integer('quantite')->default(1);
            $table->foreignIdFor(Categorie::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->enum('etat', ['neuf', 'comme_neuf', 'bon', 'correct'])->default('bon');
            $table->json('images')->nullable();
            $table->decimal('poids')->nullable();
            $table->json('dimensions')->nullable();
            $table->boolean('est_publie')->default(false);
            $table->boolean('est_en_vedette')->default(false);
            $table->integer('nombre_vues')->default(0);
            $table->decimal('note', 3, 2)->default(0);
            $table->integer('nombre_avis')->default(0);
            $table->uuid("ref")->unique();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
