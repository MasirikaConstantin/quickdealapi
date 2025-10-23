<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\UserController;
use App\Http\Controllers\API\V1\ProduitController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


// Routes publiques
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Routes protégées
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/logout-all', [AuthController::class, 'logoutAll']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::put('/profile', [AuthController::class, 'updateProfile']);
    Route::post('/refresh-token', [AuthController::class, 'refreshToken']);
});

Route::resource('users', UserController::class);

Route::prefix('produits')->group(function () {
    Route::get('/', [ProduitController::class, 'index']);
    Route::get('/{id}', [ProduitController::class, 'show']);
    Route::post('/', [ProduitController::class, 'store'])->middleware('auth:sanctum');
    Route::put('/{id}', [ProduitController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('/{id}', [ProduitController::class, 'destroy'])->middleware('auth:sanctum');
});