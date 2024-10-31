<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Direction;

class DirectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $directions = Direction::All();
        return view('directions.index', compact('directions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $direction = new Direction();
        return view('directions.form', compact('direction'));

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

        Direction::create($request->all());
        return redirect()->route('directions.index')->with('success', 'Direction créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $direction = Direction::findOrFail($id);
        return view('directions.form', compact('direction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $direction = Direction::findOrFail($id);
        return view('directions.form', compact('direction'));
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

        $direction = Direction::findOrFail($id);
        $direction->update($request->all());
        return redirect()->route('directions.index')->with('success', 'Direction modifiée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $direction = Direction::findOrFail($id);
        $direction->delete();

        return redirect()->route('directions.index')->with('success', 'Direction supprimée avec succès.');
    }
}
