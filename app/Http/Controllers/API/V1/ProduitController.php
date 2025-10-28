<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProduitRequest;
use App\Http\Requests\UpdateProduitRequest;
use App\Http\Resources\ProduitRessource;
use App\Models\Produit;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produits = Produit::where('est_publie', true)
        ->select('id', 'titre', 'description', 'prix', 'categorie_id', 'user_id', 'etat', 'images', 'poids', 'dimensions', 'est_en_vedette', 'nombre_vues', 'note', 'nombre_avis', 'ref', 'created_at')
        ->with('categorie:id,nom,icone,ref', 'user:id,nom,prenom,ref')
        ->paginate(20);
        //return response()->json(($produits));
        return ProduitRessource::collection($produits);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProduitRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Produit $produit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produit $produit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProduitRequest $request, Produit $produit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produit $produit)
    {
        //
    }
}
