<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class TypeMission extends Model
{
    use HasFactory;
    protected $table = 'type_de_missions';

    protected $fillable = ['libelle'];

    public function parametrePerdiems()
    {
        return $this->hasMany(ParametrePerdiem::class, 'type_mission_id');
    }


}


