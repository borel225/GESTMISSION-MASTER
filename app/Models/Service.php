<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['libelle','direction_id'];



    public function agents()
    {
        return $this->hasMany(Agent::class, 'service_id');
    }

    public function direction()
    {
        return $this->belongsTo(Direction::class);
    }

}

