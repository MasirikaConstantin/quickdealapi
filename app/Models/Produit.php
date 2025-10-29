<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Produit extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\ProduitFactory> */
    use HasFactory, InteractsWithMedia;
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

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit(Fit::Crop, 200, 200);
    }
}
