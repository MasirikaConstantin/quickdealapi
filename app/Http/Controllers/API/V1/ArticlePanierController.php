<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticlePanierRequest;
use App\Http\Requests\UpdateArticlePanierRequest;
use App\Models\ArticlePanier;

class ArticlePanierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreArticlePanierRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ArticlePanier $articlePanier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ArticlePanier $articlePanier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticlePanierRequest $request, ArticlePanier $articlePanier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ArticlePanier $articlePanier)
    {
        //
    }
}
