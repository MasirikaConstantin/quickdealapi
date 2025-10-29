<?php

use App\Http\Controllers\ProduitController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});
Route::resource('produits', ProduitController::class);
Route::delete('/produits/{produit}/images/{media}', [ProduitController::class, 'deleteImage'])
    ->name('produits.images.delete');


require __DIR__.'/settings.php';
