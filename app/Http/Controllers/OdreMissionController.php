<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\OrdreMission;
use App\Models\Agent;
use App\Models\ParametrePerdiem;
use App\Models\TypeMission;



class OdreMissionController extends Controller
{
    //
    public function listMissionAgent()
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

    public function listMissionAvalider()
    {
        $user = Auth::user();
        if ($this->userIsAgent($user)) {
            $agent = Agent::where('matricule', $user->mappage)->first();
            $missions = OrdreMission::with('mission')
            ->where(function($query) use ($agent) {
                //Niveau 1 - L'agent lui-même
                $query->where('agent_id', $agent->id)
                //Niveau 2 - Supérieur directs de l'agent
                    ->orWhereHas('agent', function($subQuery) use ($agent) {
                        $subQuery->where('superieur_id', $agent->id);
                    })
                    //Niveau 3 - Supérieur des supérieurs directs
                    ->orWhereHas('agent', function($subQuery) use ($agent) {
                        $subQuery->whereIn('superieur_id', function($innerQuery) use ($agent) {
                            $innerQuery->select('id')
                                ->from('agents')
                                ->where('superieur_id', $agent->id);
                        });
                    })
                    //Niveau 4 - Supérieur des supérieurs des supérieurs directs
                    ->orWhereHas('agent', function($subQuery) use ($agent) {
                        $subQuery->whereIn('superieur_id', function($innerQuery) use ($agent) {
                            $innerQuery->select('id')
                                ->from('agents')
                                ->whereIn('superieur_id', function($innerInnerQuery) use ($agent) {
                                    $innerInnerQuery->select('id')
                                        ->from('agents')
                                        ->where('superieur_id', $agent->id);
                                });
                        });
                    });
            })->get();
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
            $userAgent = Agent::where('matricule', $user->mappage)->first();
            $userLevel = $this->getUserLevel($userAgent, $agent);
          return view('ordre_missions.demande', compact('ordreMission', 'user','agent','userLevel'));
      }

      public function submitDemande(Request $request, $id)
      {

                $ordreMission = OrdreMission::findOrFail($id);
                $user = Auth::user();
                $userAgent = Agent::where('matricule', $user->mappage)->first();
                $agent = $ordreMission->agent;
                $userLevel = $this->getUserLevel($userAgent, $agent);

                if ($userLevel == 'agent' && $request->has('validation_agent')) {
                    $ordreMission->validation_agent = true;
                } elseif ($userLevel == 'sup_hier' && $request->has('validation_sup_hier')) {
                    $ordreMission->validation_sup_hier = true;
                    if ($userAgent->id == $agent->id) {
                        $ordreMission->validation_agent = true;
                    }
                } elseif ($userLevel == 'da' && $request->has('validation_da')) {
                    $ordreMission->validation_da = true;
                    if ($userAgent->id == $agent->id) {
                        $ordreMission->validation_agent = true;
                        $ordreMission->validation_sup_hier = true;
                    }
                } elseif ($userLevel == 'dd' && $request->has('validation_dd')) {
                    $ordreMission->validation_dd = true;
                    if ($userAgent->id == $agent->id) {
                        $ordreMission->validation_agent = true;
                        $ordreMission->validation_sup_hier = true;
                        $ordreMission->validation_da = true;
                    }
                }


            // Déterminer le statut de la demande
            if ($ordreMission->validation_agent && $ordreMission->validation_sup_hier && $ordreMission->validation_da && $ordreMission->validation_dd) {
                $ordreMission->statut = 'demande validée';
                $this->calculateAndAddAmounts($ordreMission);
            } else {
                $ordreMission->statut = 'en attente';
            }

            $ordreMission->save();

            return redirect()->route('ordre_missions.index')->with('success', 'Demande soumise avec succès.');
      }

            private function getUserLevel($userAgent, $agent)
            {
                if ($userAgent->id == $agent->id) {
                    return 'agent';
                } elseif ($userAgent->id == $agent->superieur_id) {
                    return 'sup_hier';
                } elseif ($userAgent->fonction->libelle == 'Directeur Adjoint') {
                    return 'da';
                } elseif ($userAgent->fonction->libelle == 'Directeur Département') {
                    return 'dd';
                }
                return null;
            }

            private function calculateAndAddAmounts(OrdreMission $ordreMission)
            {
                $parametrePerdiem = $ordreMission->getParametrePerdiem();

                if (!$parametrePerdiem) {
                    // Gérer le cas où aucun paramètre n'est trouvé
                    throw new \Exception("Aucun paramètre de perdiem trouvé pour cette configuration.");
                }
                // Calculer le nombre de jours
                $dateDepart = Carbon::parse($ordreMission->mission->date_depart);
                $dateRetour = Carbon::parse($ordreMission->mission->date_retour);
                $nombreJours = $dateDepart->diffInDays($dateRetour) + 1;

                // Calculer le perdiem
                $montantPerdiem = $parametrePerdiem->montant * $nombreJours;

                // Calculer le carburant
                $montantCarburant = $ordreMission->distance * $nombreJours;

                // Ajouter les montants à l'ordre de mission
                $ordreMission->montant_perdiem = $montantPerdiem;
                $ordreMission->montant_carburant = $montantCarburant;
                $ordreMission->montant_total = $montantPerdiem + $montantCarburant;

                $ordreMission->save();
            }

}
