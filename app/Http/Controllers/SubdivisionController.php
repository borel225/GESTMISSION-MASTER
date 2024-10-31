<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Subdivision;
use Illuminate\Http\Request;

class SubdivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $subdivisions = Subdivision::with(['parent', 'chef'])->get();
        return view('subdivisions.index',compact('subdivisions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $agents = Agent::all();
        $subdivisions = Subdivision::all();
        return view('subdivisions.create', compact('agents','subdivisions'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'libelle' => 'required|string|max:255',
            'parend_id' => 'integer|nullable',
            'chef_id' => 'required|integer',
        ]);

        Subdivision::create([
            'libelle' => $request->input('libelle'),
            'parend_id' => $request->input('parend_id'),
            'chef_id' => $request->input('chef_id'),
        ]);

        return redirect()->route('subdivisions.index')->with('success','Subdivision créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $subdivision = Subdivision::with(['chef', 'agents'])->findOrFail($id);
        return view('subdivisions.show', compact('subdivision'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $subdivisions = Subdivision::all();
        $subdivision = Subdivision::findOrFail($id);
        $agents = Agent::all();
        return view('subdivisions.edit', compact('subdivision', 'agents','subdivisions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'libelle' => 'required|string|max:255',
            'parend_id' => 'integer|nullable',
            'chef_id' => 'required|integer',
        ]);

        $subdivision = Subdivision::findOrFail($id);
        $subdivision->update($request->all());

        return redirect()->route('subdivisions.index')->with('success','Subdivision modifiée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $subdivision = Subdivision::findOrFail($id);
        $subdivision->delete();

        return redirect()->route('subdivisions.index')->with('success', 'Subdivision supprimée avec succès.');
    }
}
