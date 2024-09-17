<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdreMission extends Model
{
    use HasFactory;
    protected $dates = ['date_depart', 'date_retour'];
    protected $fillable = ['mission_id',
                           'agent_id',
                           'date_debut',
                           'date_fin',
                           'perdiem',
                           'validation_agent',
                           'validation_sup_hier',
                           'validation_da',
                           'validation_dd',
                           'carburant',
                            'distance'];


     public function agent()
    {
        return $this->belongsTo(Agent::class, 'agent_id');
    }

    public function mission()
    {
        return $this->belongsTo(Mission::class, 'mission_id');
    }

    public function typeMission()
    {
        return $this->belongsTo(TypeMission::class);
    }

    public function getParametrePerdiem()
    {
        return ParametrePerdiem::where('type_mission_id', $this->type_mission_id)
            ->where('categorie_agent_id', $this->agent->categorie_agent_id)
            ->first();
    }


}
