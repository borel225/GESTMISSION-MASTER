<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParametrePerdiem extends Model
{
    use HasFactory;
    protected $fillable = ['type_mission_id', 'categorie_agent_id','montant'];

public function typeMission()
{
    return $this->belongsTo(TypeMission::class, 'type_mission_id');
}

// Modèle PamaretrePerdiem.php
public function categorieAgent()
{
    return $this->belongsTo(CategorieAgent::class, 'categorie_agent_id');
}
}
