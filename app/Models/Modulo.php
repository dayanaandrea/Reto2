<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    protected $fillable = ['codigo', 'nombre', 'horas', 'curso', 'id_ciclo'];

    public function ciclo()
    {
        return $this->belongsTo(Ciclo::class, 'id_ciclo');
    }

    public function ofertas()
    {
        return $this->hasMany(Oferta::class, 'id_modulo');
    }
}
