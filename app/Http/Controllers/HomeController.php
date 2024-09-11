<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ParametrePerdiem;
use App\Models\CategorieAgent;
use App\Models\TypeMission;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

     public function details()
    {
        $parametrePerdiem = ParametrePerdiem::all();
        $typesMissions = TypeMission::all();
        return view('parametre_perdiems.show', compact('parametrePerdiem','typesMissions'));
    }



    public function getCategories($typeMissionId)
    {
        // Récupère les catégories d'agents associées au type de mission
        $categories = CategorieAgent::whereIn('id', function($query) use ($typeMissionId) {
            $query->select('categorie_agent_id')
                ->from('parametre_perdiems')
                ->where('type_mission_id', $typeMissionId);
        })->get();

        return response()->json($categories);
    }

    public function getMontant($typeMissionId, $categorieAgentId)
    {
        // Récupère le montant per diem pour le type de mission et la catégorie d'agent spécifiés
        $parametre = ParametrePerdiem::where('type_mission_id', $typeMissionId)
                                    ->where('categorie_agent_id', $categorieAgentId)
                                    ->first();

        return response()->json(['montant' => $parametre ? $parametre->montant : 'Non défini']);
    }

}
