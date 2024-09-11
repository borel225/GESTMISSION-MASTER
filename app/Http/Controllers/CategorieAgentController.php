<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CategorieAgent;
use Illuminate\Http\Request;

class CategorieAgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = CategorieAgent::all();
        return view('categorie_agent.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('categorie_agent.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        if ($request->has('libelle')) {
            $existing = CategorieAgent::where('libelle', $request->input('libelle'))->first();
            if ($existing) {
                return redirect()->back()->withErrors(['libelle' => 'Cette entrée existe déjà dans la base de données.'])->withInput();
            }
        }

        $request->validate([
            'libelle' => 'required|string|max:255',
        ]);

        CategorieAgent::create($request->all());

        return redirect()->route('categorie_agent.index')->with('success', 'Catégorie d\'agent créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $categorie = CategorieAgent::findOrFail($id);
        return view('categorie_agent.show', compact('categorie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $categorie = CategorieAgent::findOrFail($id);
        return view('categorie_agent.edit', compact('categorie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $request->validate([
            'libelle' => 'required|string|unique|max:255',
        ]);

        $categorieAgent = CategorieAgent::findOrFail($id);
        $categorieAgent->update($request->all());

        return redirect()->route('categorie_agent.index')->with('success', 'Catégorie d\'agent modifiée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $categorie = CategorieAgent::findOrFail($id);
        $categorie->delete();
        return redirect()->route('categorie_agent.index')->with('success', 'Catégorie supprimée avec succès.');
    }
}
