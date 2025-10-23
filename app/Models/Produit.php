<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    /** @use HasFactory<\Database\Factories\ProduitFactory> */
    use HasFactory;
    protected $fillable = [
        'titre',
        'description',
        'prix',
        'categorie_id',
        'user_id',
        'etat',
        'images',
        'poids',
        'dimensions',
        'est_publie',
        'est_en_vedette',
        'nombre_vues',
        'note',
        'nombre_avis',
        'ref',
    ];
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
