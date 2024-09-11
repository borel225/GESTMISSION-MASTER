<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Fonction;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $services = Service::all();
        return view('services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('services.create');
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

        Service::create([
            'libelle' => $request->input('libelle'),
        ]);

        return redirect()->route('services.index')->with('success', 'Fonction créée avec succès.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $service = Service::findOrFail($id);
        return view('services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $service = Service::findOrFail($id);
        return view('services.edit', compact('service'));
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

        $service = Service::findOrFail($id);
        $service->update([
            'libelle' => $request->input('libelle'),
        ]);

        return redirect()->route('services.index')->with('success', 'Fonction mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('services.index')->with('success', 'service supprimée avec succès.');


    }
}
