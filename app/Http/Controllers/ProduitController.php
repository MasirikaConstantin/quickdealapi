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
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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

   
public function deleteImage(Request $request, $produitId, $mediaId)
{
    $produit = Produit::findOrFail($produitId);
    $media = $produit->media()->where('id', $mediaId)->first();

    if (!$media) {
        return back()->withErrors(['image' => 'Image introuvable ou ne correspond pas à ce produit.']);
    }

    $media->delete();

    return back()->with('success', 'Image supprimée avec succès.');
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
        $image = $request->file('images'); // <- une seule image envoyée
    
        if ($image instanceof UploadedFile) {
            // Vérifier la limite de 5 images max
            $existingCount = $produit->getMedia('images')->count();
            if ($existingCount >= 5) {
                return back()->withErrors([
                    'images' => 'Vous ne pouvez pas ajouter plus de 5 images pour ce produit.',
                ]);
            }
    
            // Ajouter l’image
            $produit->addMedia($image)
                ->usingFileName(Str::random(40) . '.' . $image->getClientOriginalExtension())
                ->toMediaCollection('images');
    
            return back()->with('success', 'Image ajoutée avec succès.');
        }
    
        return back()->withErrors(['images' => 'Aucune image reçue.']);
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
            try {
                $this->handleFormRequest($request, $produit->ref);
            return redirect()->route('produits.edit',[
                'produit'=>$produit->ref
            ])->with('success', 'Produit modifié avec succès');
            } catch (\Exception $e) {
                return redirect()->route('produits.edit',[
                    'produit'=>$produit->ref
                ])->with('error', $e->getMessage());
            }
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
