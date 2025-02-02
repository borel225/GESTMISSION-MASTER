<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;
use PhpParser\Node\Stmt\TryCatch;

class Mission extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle',
        'objectif',
        'interet',
        'tdr',
        'date_depart',
        'date_retour',
        'observation',
        'destination_arrivee_id',
        'destination_depart_id',
    ];
      public function ordresMission()
    {
        return $this->hasMany(OrdreMission::class, 'mission_id');
    }

    public function agents()
    {
        return $this->belongsToMany(Agent::class, 'ordre_missions', 'mission_id', 'agent_id');
    }

    public function destinationArrivee()
    {
        return $this->belongsTo(Lieu::class, 'destination_arrivee_id');
    }
    public function destinationDepart()
    {
        return $this->belongsTo(Lieu::class, 'destination_depart_id');
    }


            public static function boot()
        {
            parent::boot();

            static::saving(function ($model) {
                if ($model->destination_arrivee_id === $model->destination_depart_id) {
                    throw ValidationException::withMessages([
                        'destination' => 'Destination de départ et Destination arrivée ne peuvent pas être identiques.',
                    ]);
                }
            });
        }

}

