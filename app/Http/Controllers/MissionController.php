<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lieu;
use Illuminate\Http\Request;
use App\Models\Mission;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use App\Models\Agent;
use App\Models\TypeMission;


class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $missions = Mission::all();
        return view('missions.index', compact('missions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $typesMissions = TypeMission::all();
        $agents = Agent::all();
        $lieus = Lieu::all();
        return view('missions.create', compact('lieus','agents','typesMissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $validated = $request->validate([
            'libelle' => 'required|string|max:255',
            'objectif' => 'required|string|max:255',
            'date_depart' => 'required|date',
            'date_retour' => 'required|date',
            'interet' => 'required|string|max:255',
            'tdr' => 'nullable|file|mimes:jpeg,png,pdf,docx|max:2048',
            'destination_depart_id' => 'required|exists:lieus,id',
            'destination_arrivee_id' => 'required|exists:lieus,id',
            'observation' => 'nullable|string',
           'participants' => 'nullable|string',
           'distance' => 'nullable|numeric|min:0',
           'type_mission_id' => 'required|exists:type_de_missions,id'
        ]);

        // Traitement du fichier
        $tdrPath = null;
        if ($request->hasFile('tdr')) {
            $file = $request->file('tdr');
            $tdrPath = $file->store('tdrs', 'public'); // Enregistre dans le disque public
        }

        $mission = Mission::create($validated);

                // Traitement des participants
            if ($request->filled('participants')) {
                $agentIds = explode(',', $request->participants);

                // Préparation des données pour la table pivot
                $ordreMissionsData = [];
                foreach ($agentIds as $agentId) {
                    $ordreMissionsData[$agentId] = [
                        'distance' => $request->input('distance'),
                        'type_mission_id' => $request->input('type_mission_id'),
                    ];
                }

                // Ajouter les participants avec les nouvelles propriétés
                $mission->agents()->attach($ordreMissionsData);
            }

        return redirect()->route('missions.index')->with('success', 'Mission créée avec succès.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $mission = Mission::with(['destinationDepart', 'destinationArrivee'])->findOrFail($id);
        return view('missions.show', compact('mission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $typesMissions = TypeMission::all();
        $mission = Mission::findOrFail($id);
        $lieus = Lieu::all();
        $agents = Agent::all();
        return view('missions.edit', compact('mission', 'lieus','agents','typesMissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $validated = $request->validate([
            'libelle' => 'required|string|max:255',
            'objectif' => 'required|string|max:255',
            'date_depart' => 'required|date',
            'date_retour' => 'required|date',
            'interet' => 'required|string|max:255',
            'tdr' => 'nullable|file|mimes:jpeg,png,pdf,docx|max:2048',
            'destination_depart_id' => 'required|exists:lieus,id',
            'destination_arrivee_id' => 'required|exists:lieus,id',
            'observation' => 'nullable|string',
            'participants' => 'nullable|string',
            'distance' => 'nullable|numeric|min:0',
            'type_mission_id' => 'required|exists:type_de_missions,id',
        ]);

        $mission = Mission::findOrFail($id);

        if ($request->hasFile('tdr')) {
            // Supprimer le fichier TDR précédent s'il existe
            if ($mission->tdr) {
                Storage::disk('public')->delete($mission->tdr);
            }

            // Enregistrer le nouveau fichier TDR
            $file = $request->file('tdr');
            $tdrPath = $file->store('tdrs', 'public');
            $validated['tdr'] = $tdrPath;
        } else {
            // Conserver l'ancien fichier TDR si aucun nouveau fichier n'est fourni
            $validated['tdr'] = $mission->tdr;
        }

        // Mise à jour des attributs de la mission
        $mission->update($validated);

        if ($request->filled('participants')) {
            $agentIds = explode(',', $request->participants);
            $ordreMissionsData = [];
            foreach ($agentIds as $agentId) {
                $ordreMissionsData[$agentId] = [
                    'distance' => $request->input('distance'),
                    'type_mission_id' => $request->input('type_mission_id'),
                ];
            }

            $mission->agents()->sync($ordreMissionsData);

        }
        else
        {
            $mission->agents()->each(function ($agent) use ($request) {
                $agent->pivot->update([
                    'distance' => $request->input('distance'),
                    'type_mission_id' => $request->input('type_mission_id'),
                ]);
            });
        }

        return redirect()->route('missions.index')->with('success', 'Mission mise à jour avec succès.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
         // Supprimer le fichier s'il existe
         $mission = Mission::findOrFail($id);
         if ($mission->tdr && Storage::exists($mission->tdr)) {
            Storage::delete($mission->tdr);
         }

         $mission->delete();



        return redirect()->route('missions.index')->with('success', 'Mission supprimée avec succès !');
    }
}
