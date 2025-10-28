<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariationProduit extends Model
{
    /** @use HasFactory<\Database\Factories\VariationProduitFactory> */
    use HasFactory;
    protected $table = "variations_produit";
    protected $fillable = [
        "produit_id",
        "type",
        "valeur",
        "ajout_prix",
        "stock",
        "ref",
        "sku",
    ];
}
