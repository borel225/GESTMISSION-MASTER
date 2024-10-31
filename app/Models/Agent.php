<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Agent extends Model
{
    use HasFactory;
    use Notifiable;


    protected $fillable = ['nom',
                           'prenom',
                           'email',
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



    public function categorieAgent ()
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

    public function subordonnes()
    {
        return $this->hasMany(Agent::class, 'superieur_id');
    }

    public function superieur()
    {
        return $this->belongsTo(Agent::class, 'superieur_id');
    }

    // Relation pour obtenir les subordonnés

    public function getSupHierachique()
    {
        return $this->superieur;
    }

    public function getDirecteurAdjoint()
    {
        return $this->superieur->superieur;
    }

    public function getDirecteurGeneral()
    {
        return $this->superieur->superieur->superieur;
    }

    public function getUserLevel()
    {
        $directeurGeneral = $this->getDirecteurGeneral();
        $directeurAdjoint = $this->getDirecteurAdjoint();
        $superieur = $this->superieur;

        if ($directeurGeneral && $directeurGeneral->id === $this->id) {
            return 'Directeur Général';
        } elseif ($directeurAdjoint && $directeurAdjoint->id === $this->id) {
            return 'Directeur Adjoint';
        } elseif ($superieur && $superieur->id === $this->id) {
            return 'Superieur';
        } else {
            return 'Agent';
        }
    }

        public function routeNotificationForMail()
    {
        return $this->email;
    }

}



