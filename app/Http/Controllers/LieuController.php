<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lieu;
use Illuminate\Http\Request;

class LieuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $lieus = Lieu::all();
        return view('lieus.index',compact('lieus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $typelieu = [
            'pays',
            'villes'
        ];

        $lieus = Lieu::all();
        return view('lieus.create', compact('typelieu','lieus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'parent_id' => 'nullable|integer',
            'libelle' => 'required|string|max:255',
            'type_lieu' => 'required|string|in:pays,villes',
        ]);

        $data = $request->only(['libelle', 'parent_id', 'type_lieu']);

        Lieu::create($data);

        return redirect()->route('lieus.index')->with('success', 'Lieu créé avec succès.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $lieu = Lieu::findOrFail($id);
        return view('lieus.show', compact('lieu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $typelieu = [
            'pays',
            'villes'
        ];

        $lieu = Lieu::findOrFail($id);
        $lieus = Lieu::all();
        return view('lieus.edit', compact('lieu', 'typelieu', 'lieus'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'parent_id' => 'nullable|integer',
            'libelle' => 'required|string|max:255',
            'type_lieu' => 'required|string|in:pays,villes',
        ]);

        $data = $request->only(['libelle', 'parent_id', 'type_lieu']);

        $lieus = Lieu::findOrFail($id);
        $lieus->update($data);

        return redirect()->route('lieus.index')->with('success', 'Lieu créé avec succès.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $lieu = Lieu::findOrFail($id);
        $lieu->delete();

        return redirect()->route('lieus.index')->with('success', 'lieu supprimée avec succès.');
    }
}
