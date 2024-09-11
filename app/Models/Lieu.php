<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lieu extends Model
{
    use HasFactory;
    protected $fillable = ['libelle','parent_id','type_lieu'];

    public function missionsArr()
    {
        return $this->hasMany(Mission::class, 'destination_arrivee_id');
    }

    public function missionsDep()
    {
        return $this->hasMany(Mission::class, 'destination_depart_id');
    }
}
