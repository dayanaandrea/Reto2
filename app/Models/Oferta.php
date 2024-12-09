<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    protected $fillable = ['id_ciclo', 'id_modulo'];

    public function ciclo()
    {
        return $this->belongsTo(Ciclo::class, 'id_ciclo');
    }

    public function modulo()
    {
        return $this->belongsTo(Modulo::class, 'id_modulo');
    }
}
