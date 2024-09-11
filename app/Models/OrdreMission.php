<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdreMission extends Model
{
    use HasFactory;
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


}
