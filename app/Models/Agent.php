<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;


    protected $fillable = ['nom',
                           'prenom',
                           'matricule',
                           'service_id',
                           'fonction_id',
                           'categorie_agent_id',
                           'superieur_id',];



    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function fonction()
    {
        return $this->belongsTo(Fonction::class, 'fonction_id');
    }

    public function categogieAgent()
    {
        return $this->belongsTo(CategorieAgent::class, 'categorie_agent_id');
    }

    public function ordresMission()
    {
        return $this->hasMany(OrdreMission::class, 'agent_id');
    }

    public function missions()
    {
        return $this->belongsToMany(Mission::class, 'ordre_missions', 'agent_id', 'mission_id');
    }

    public function superieur()
    {
        return $this->belongsTo(Agent::class, 'superieur_id');
    }

    // Relation pour obtenir les subordonnés
    public function subordonnes()
    {
        return $this->hasMany(Agent::class, 'superieur_id');
    }



}



