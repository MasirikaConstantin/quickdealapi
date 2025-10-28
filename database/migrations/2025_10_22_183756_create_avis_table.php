<?php

use App\Models\Commande;
use App\Models\Produit;
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
        Schema::create('avis', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Produit::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Commande::class)->constrained()->cascadeOnDelete();
            $table->integer('note'); // 1-5
            $table->text('commentaire')->nullable();
            $table->json('images')->nullable();
            $table->boolean('est_approuve')->default(false);
            $table->uuid("ref")->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avis');
    }
};
