<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\OrdreMission;
use App\Models\Agent;
use App\Models\User;



class OdreMissionController extends Controller
{
    //
    public function index()
    {
          $user = Auth::user();

            if ($this->userIsAgent($user))
            {
                $agent = Agent::where('matricule', $user->mappage)->first();
                $missions = OrdreMission::with('mission')
                ->where('agent_id', $agent->id)
                ->get();
            }
            else
            {
                return redirect()->route('home')->with('error', 'Vous n\'avez pas les permissions nécessaires.');
            }

            return view('ordre_missions.index', compact('missions'));
    }

    public function validation()
    {
        $user = Auth::user();
        if ($this->userIsAgent($user))
        {
            $agent = Agent::where('matricule', $user->mappage)->first();
                $missions = OrdreMission::with('mission')
                ->orWhereHas('agent', function($query) use ($agent) {
                    $query->where('superieur_id', $agent->id);
                }) ->where('validation_agent', true)
                ->get();
        }
        else
        {
            return redirect()->route('home')->with('error', 'Vous n\'avez pas les permissions nécessaires.');
        }

        return view('ordre_missions.validations', compact('missions'));
    }

    private function userIsAgent($user)
    {
        // Vérifiez si le champ 'mappage' de l'utilisateur correspond à un matricule d'agent
        return Agent::where('matricule', $user->mappage)->exists();
    }

      // Afficher le formulaire de demande
      public function showDemandeForm($id)
      {
          $ordreMission = OrdreMission::with(['mission', 'agent'])->findOrFail($id);
          $agent = Agent::find($ordreMission->agent_id);
          $user = Auth::user();
          return view('ordre_missions.demande', compact('ordreMission', 'user','agent'));
      }

      public function submitDemande(Request $request, $id)
      {

                $ordreMission = OrdreMission::findOrFail($id);

            // Mettre à jour les validations
            $ordreMission->validation_agent = $request->has('validation_agent') ? true : false;
            $ordreMission->validation_sup_hier = $request->has('validation_sup_hier') ? true : false;
            $ordreMission->validation_da = $request->has('validation_da') ? true : false;
            $ordreMission->validation_dd = $request->has('validation_dd') ? true : false;

            // Déterminer le statut de la demande
            if ($ordreMission->validation_agent && $ordreMission->validation_sup_hier && $ordreMission->validation_da && $ordreMission->validation_dd) {
                $ordreMission->statut = 'demande validée';
            } else {
                $ordreMission->statut = 'en attente';
            }

            $ordreMission->save();

            return redirect()->route('ordre_missions.index')->with('success', 'Demande soumise avec succès.');
      }

}
