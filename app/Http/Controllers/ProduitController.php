<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProduitRequest;
use App\Http\Requests\UpdateProduitRequest;
use App\Http\Resources\ProduitRessource;
use App\Models\Produit;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Inertia\Inertia;
use Illuminate\Support\Str;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Produit::query();
        $search = $request->input('search');
        if ($search) {
            $query->where('titre', 'like', "%" . $search . "%")->orWhere('description', 'like', "%" . $search . "%")->orWhere('etat', 'like', "%" . $search . "%");
        }
        
        return Inertia::render('Produits/Index',[
            'produits'=> ProduitRessource::collection(
                $query->paginate(12)->withQueryString()
            ),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render("Produits/Create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProduitRequest $request)
    {
        try{
            $validated = $request->validated();
            }catch(Exception $e){
                dd($e->getMessage());
            }
            $user = Produit::create($request->validated());
            $this->handleFormRequest($request, $user->ref);
            return redirect()->route('produits.index')->with('success', 'Utilisateur créé avec succès');
    }


private function handleFormRequest(Request $request, string $userRef)
{
    $produit = Produit::where('ref', $userRef)->firstOrFail();
    $images = $request->validated("images");

    if ($images && $images instanceof UploadedFile) {
        $produit->addMedia($images)
            ->usingFileName(Str::random(40) . '.' . $images->getClientOriginalExtension())
            ->toMediaCollection('images');
    }
}


    /**
     * Display the specified resource.
     */
    public function show(string $produit)
    {
        $produit = Produit::where('ref', $produit)->first();
        return Inertia::render('Produits/Show',[
            "produit"=> new ProduitRessource($produit)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $produit)
    {
        $produit = Produit::where('ref', $produit)->first();
        return Inertia::render('Produits/Edit',[
            "produit"=>$produit
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProduitRequest $request, string $produit)
    {
        try{
            $validated = $request->validated();
            }catch(Exception $e){
                dd($e->getMessage());
            }
            $produit = Produit::where('ref', $produit)->first();
            unset($validated['images']);
            $produit->update($validated);
            $this->handleFormRequest($request, $produit->ref);
            return redirect()->route('produits.index')->with('success', 'Produit modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produit $produit)
    {
        $produit->delete();
        return redirect()->route('produits.index')->with('success', 'Utilisateur supprimé avec succès');

    }
}
