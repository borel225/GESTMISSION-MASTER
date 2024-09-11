<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TypeMission;

class TypeMissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $typesMissions = TypeMission::all();
        return view('type_missions.index', compact('typesMissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('type_missions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'libelle' => 'required|max:255',
        ]);

        TypeMission::create($request->all());

        return redirect()->route('type_missions.index')->with('success', 'Type de mission créé avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $typeMission = TypeMission::findOrFail($id);
        return view('type_missions.show', compact('typeMission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $typeMission = TypeMission::findOrFail($id);
        return view('type_missions.edit', compact('typeMission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'libelle' => 'required|max:255',
        ]);

        $typeMission = TypeMission::findOrFail($id);
        $typeMission->update($request->all());

        return redirect()->route('type_missions.index')->with('success', 'Type de mission modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $typeMission = TypeMission::findOrFail($id);
        $typeMission->delete();

        return redirect()->route('type_missions.index')->with('success', 'Type de mission supprimé avec succès');
    }
}
