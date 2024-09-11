<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieAgent extends Model
{
    use HasFactory;
    protected $table = 'categorie_agent';
    protected $fillable = ['libelle'];

    public function agents()
    {
        return $this->hasMany(Agent::class, 'categorie_agent_id');
    }
    public function parametrePerdiems()
    {
        return $this->hasMany(ParametrePerdiem::class, 'categorie_agent_id');
    }



}
