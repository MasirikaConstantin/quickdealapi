<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MethodeLivraison extends Model
{
    /** @use HasFactory<\Database\Factories\MethodeLivraisonFactory> */
    use HasFactory;
    protected $table = "methodes_livraison";
    protected $fillable = [
        "nom",
        "description",
        "icone",
        "image",
        "est_active",
        "ref",
    ];
    protected $casts = [
        "est_active" => "boolean",
    ];
}
