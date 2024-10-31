<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\OrdreMission;
use App\Models\Agent;
use Carbon\Carbon;



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
            ->where('statut','en attente')
            ->where(function($query) use ($agent) {
                $query     //Niveau 1 - L'agent lui-même  ->where('agent_id', $agent->id)
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
            })
             // Niveau 5 - Supérieur des supérieurs des supérieurs des supérieurs directs
             ->orWhereHas('agent', function($subQuery) use ($agent) {
                $subQuery->whereIn('superieur_id', function($innerQuery) use ($agent) {
                    $innerQuery->select('id')
                        ->from('agents')
                        ->whereIn('superieur_id', function($innerInnerQuery) use ($agent) {
                            $innerInnerQuery->select('id')
                                ->from('agents')
                                ->whereIn('superieur_id', function($innerInnerInnerQuery) use ($agent) {
                                    $innerInnerInnerQuery->select('id')
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
        $montantPerdiem = $ordreMission->perdiem;
        $montantCarburant = $ordreMission->carburant;
        $total = $montantPerdiem + $montantCarburant;

        return view('ordre_missions.demande', compact('ordreMission', 'user', 'agent', 'userLevel', 'total', 'userAgent'));
      }

        public function showNouvelleVue($id)
    {
        $ordreMission = OrdreMission::with(['mission', 'agent'])->findOrFail($id);
        $agent = Agent::find($ordreMission->agent_id);
        $user = Auth::user();
        $userAgent = Agent::where('matricule', $user->mappage)->first();
        $userLevel = $this->getUserLevel($userAgent, $agent);
        $montantPerdiem = $ordreMission->perdiem;
        $montantCarburant = $ordreMission->carburant;
        $total = $montantPerdiem + $montantCarburant;

        return view('ordre_missions.details', compact('ordreMission', 'user', 'agent', 'userLevel', 'total', 'userAgent'));
    }



      public function submitDemande(Request $request, $id)
      {

              $ordreMission = OrdreMission::findOrFail($id);
        $user = Auth::user();
        $userAgent = Agent::where('matricule', $user->mappage)->first();
        $agent = $ordreMission->agent;
        $userLevel = $this->getUserLevel($userAgent, $agent);

        if ($request->has('validation_agent')) {
            $ordreMission->validation_agent = true;

                // Valide automatiquement les niveaux supérieurs en fonction du rôle de l'utilisateur
                if ($userLevel == 'sup_hier') {
                    $ordreMission->validation_sup_hier = true;
                } elseif ($userLevel == 'da') {
                    $ordreMission->validation_sup_hier = true; // Valide Supérieur
                    $ordreMission->validation_da = true;       // Valide lui-même
                    // Nécessite la validation du DG
                } elseif ($userLevel == 'dd') {
                    $ordreMission->validation_sup_hier = true; // Valide Supérieur
                    $ordreMission->validation_da = true;       // Valide DA automatiquement
                    $ordreMission->validation_dd = true;       // Valide lui-même
                    // Nécessite la validation du DG
                }
            } elseif ($userLevel == 'sup_hier' && $request->has('validation_sup_hier')) {
                $ordreMission->validation_sup_hier = true;
            } elseif ($userLevel == 'da' && $request->has('validation_da')) {
                $ordreMission->validation_da = true;       // Valide lui-même
                // Nécessite la validation du DG
            } elseif ($userLevel == 'dd' && $request->has('validation_dd')) {
                $ordreMission->validation_dd = true;       // Valide lui-même
                // Nécessite la validation du DG
            } elseif($userLevel == 'dg' && $request->has('validation_dg')) {
                $ordreMission->validation_dg = true; // Valide uniquement si DG a validé
            }

                if ($ordreMission->validation_agent &&
                $ordreMission->validation_sup_hier &&
                $ordreMission->validation_da &&
                $ordreMission->validation_dd &&
                $ordreMission->validation_dg) // Ajout de la validation du DG
            {
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
          if ($userAgent->id == $agent->id)
            {
               if ($userAgent->fonction->libelle == 'Directeur Général') {
                        return 'dg';
              }elseif ($userAgent->fonction->libelle == 'Directeur Département') {
                  return 'dd';
              } elseif ($userAgent->fonction->libelle == 'Directeur Adjoint') {
                  return 'da';
              } elseif ($userAgent->fonction->libelle == 'Chef de service') {
                  return 'sup_hier';
              } else {
                  return 'agent';
              }
          } elseif ($userAgent->fonction->libelle == 'Chef de service') {
              return 'sup_hier';
          } elseif ($userAgent->fonction->libelle == 'Directeur Adjoint') {
              return 'da';
          } elseif ($userAgent->fonction->libelle == 'Directeur Département') {
              return 'dd';
          }elseif($userAgent->fonction->libelle == 'Directeur Général') {
            return 'dg';
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
                $ordreMission->perdiem = $montantPerdiem;
                $ordreMission->carburant = $montantCarburant ;

                // Calculer le total daans une variable


                $ordreMission->save();
            }

        public function evaluations()
        {
            // Affichez la liste des missions avec les commentaires des agents
            $missions = OrdreMission::with('mission')
            ->where('statut','demande validée')
            ->get();

            return view('ordre_missions.evaluations', compact('missions'));
        }

        public function evaluationsDFC()
        {
            $missionsValidees = OrdreMission::where('statutcc', 'Validé')->get();
            return view('ordre_missions.evalutionDFC', compact('missionsValidees'));
        }

        public function valider(Request $request)
        {
            // Récupérer les IDs des missions sélectionnées
            $validatedMissions = $request->input('missions');

            // Vérifie si des missions ont été sélectionnées
            if ($validatedMissions) {
                // Met à jour le champ statutcc dans la table ordre_mission
                OrdreMission::whereIn('id', $validatedMissions)->update(['statutcc' => 'Validé']);

                return redirect()->back()->with('success', 'Missions validées avec succès.');
            }

            return redirect()->back()->with('error', 'Aucune mission sélectionnée.');
        }

        public function validerdfc(Request $request)
        {
            // Récupérer les IDs des missions sélectionnées
            $validatedMissionsdfc = $request->input('missions');

            // Vérifie si des missions ont été sélectionnées
            if ($validatedMissionsdfc) {
                // Met à jour le champ statutcc dans la table ordre_mission
                OrdreMission::whereIn('id', $validatedMissionsdfc)->update(['statutdfc' => 'Validé']);

                return redirect()->back()->with('success', 'Missions validées avec succès.');
            }

            return redirect()->back()->with('error', 'Aucune mission sélectionnée.');
        }

        public function ordreMission()
        {
            $missionsValidees = OrdreMission::where('statutdfc', 'Validé')->get();
            return view('ordre_missions.ordreMission', compact('missionsValidees'));
        }





}
