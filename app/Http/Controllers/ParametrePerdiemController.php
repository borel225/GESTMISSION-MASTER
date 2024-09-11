<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ParametrePerdiem;
use App\Models\CategorieAgent;
use App\Models\TypeMission;

class ParametrePerdiemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $parametrePerdiem = ParametrePerdiem::all();
        return view('parametre_perdiems.index', compact('parametrePerdiem'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $typesMissions = TypeMission::all();
        $categories = CategorieAgent::all();
        return view('parametre_perdiems.create', compact('typesMissions', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'type_mission_id' => 'required|integer',
            'categorie_agent_id' => 'required|integer',
            'montant' => 'required|numeric|between:0,99999999.99',
        ]);

        ParametrePerdiem::create($request->all());

        return redirect()->route('parametre_perdiems.index')->with('success', 'Paramètre perduem créé avec succès.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $parametrePerdiem = ParametrePerdiem::findOrFail($id);
        $typesMissions = TypeMission::all();
        return view('parametre_perdiems.show', compact('parametrePerdiem','typesMissions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $parametrePerdiem = ParametrePerdiem::findOrFail($id);
        $typesMissions = TypeMission::all();
        $categories = CategorieAgent::all();
        return view('parametre_perdiems.edit', compact('parametrePerdiem', 'typesMissions', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'type_mission_id' => 'required|integer',
            'categorie_agent_id' => 'required|integer',
            'montant' => 'required|numeric|between:0,99999999.99',
        ]);

        $parametrePerdiem = ParametrePerdiem::findOrFail($id);
        $parametrePerdiem->update($request->all());

        return redirect()->route('parametre_perdiems.index')->with('success', 'Paramètre perduem modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $parametrePerdiem = ParametrePerdiem::findOrFail($id);
        $parametrePerdiem->delete();

        return redirect()->route('parametre_perdiems.index')->with('success', 'Paramètre perduem supprimé avec succès.');
    }


}
