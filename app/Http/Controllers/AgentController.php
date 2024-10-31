<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Service;
use App\Models\Fonction;
use Illuminate\Http\Request;
use App\Models\CategorieAgent;
use Illuminate\Support\Facades\Auth;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        //
        $agents = Agent::with('superieur')->get();
        return view('agents.index', compact('agents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        //
        $userConnect = Auth::user();
        $agents = Agent::where('matricule', '!=',  $userConnect)->get();
        $categories = CategorieAgent::all();
        $services = Service::with('direction')->get();
        $fonctions = Fonction::all();
        return view('agents.create', compact('services', 'fonctions','categories','agents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'service_id' => 'required|integer',
            'fonction_id' => 'required|integer',
            'superieur_id' => 'nullable|integer',
            'categorie_agent_id' => 'required|integer',
            'direction_id' => 'required|exists:directions,id',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'matricule' => 'required|string|max:255',
            'email' => 'nullable|string',

        ]);

        Agent::create([
            'superieur_id' => $request->superieur_id,
            'direction_id' => $request->direction_id,
            'categorie_agent_id' => $request->categorie_agent_id,
            'service_id' => $request->service_id,
            'fonction_id' => $request->fonction_id,
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            'matricule' => $request->input('matricule'),
            'email' => $request->input('email'),
        ]);

        return redirect()->route('agents.index')->with('success', 'Agent créée avec succès.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $agent = Agent::findOrFail($id);
        return view('agents.show', compact('agent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $userConnect = Auth::user();
        $agents = Agent::where('matricule', '!=',  $userConnect)->get();
        $agent = Agent::findOrFail($id);
        $categories = CategorieAgent::all();
        $services = Service::all();
        $fonctions = Fonction::all();
        return view('agents.edit', compact('agent', 'services', 'fonctions','categories','agents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'service_id' => 'required|integer',
            'fonction_id' => 'required|integer',
            'superieur_id' => 'nullable|integer',
            'categorie_agent_id' => 'required|integer',
            'direction_id' => 'required|exists:directions,id',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'matricule' => 'required|string|max:255',
            'email' => 'nullable|string',
        ]);

        $agent = Agent::findOrFail($id);
        $agent->update([
            'superieur_id' => $request->superieur_id,
            'direction_id' => $request->direction_id,
            'categorie_agent_id' => $request->categorie_agent_id,
            'service_id' => $request->service_id,
            'fonction_id' => $request->fonction_id,
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            'matricule' => $request->input('matricule'),
            'email' => $request->input('email'),
        ]);

        return redirect()->route('agents.index')->with('success', 'Agent mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $agent = Agent::findOrFail($id);
        $agent->delete();

        return redirect()->route('agents.index')->with('success', 'Agent supprimée avec succès.');
    }
}
