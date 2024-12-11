<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'id_estudiante');
    }

    public function modulo()
    {
        return $this->hasMany(Oferta::class, 'id_modulo');
    }
}
