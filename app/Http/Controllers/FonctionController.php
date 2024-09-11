<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Fonction;
use Illuminate\Http\Request;

class FonctionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $fonctions = Fonction::all();
        return view('fonctions.index', compact('fonctions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('fonctions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'libelle' => 'required|string|max:255',
        ]);

        Fonction::create([
            'libelle' => $request->input('libelle'),
        ]);

        return redirect()->route('fonctions.index')->with('success', 'Fonction créée avec succès.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $fonction = Fonction::findOrFail($id);
        return view('fonctions.show', compact('fonction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $fonction = Fonction::findOrFail($id);
        return view('fonctions.edit', compact('fonction'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'libelle' => 'required|string|max:255',
        ]);

        $fonction = Fonction::findOrFail($id);
        $fonction->update([
            'libelle' => $request->input('libelle'),
        ]);

        return redirect()->route('fonctions.index')->with('success', 'Fonction mise à jour avec succès.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $fonction = Fonction::findOrFail($id);
        $fonction->delete();

        return redirect()->route('fonctions.index')->with('success','Fonction supprimée avec succès.');

    }
}
