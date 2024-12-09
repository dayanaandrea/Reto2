<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ciclo extends Model
{
    protected $fillable = ['codigo', 'nombre'];

    public function modulos()
    {
        return $this->hasMany(Modulo::class, 'id_ciclo');
    }

    public function ofertas()
    {
        return $this->hasMany(Oferta::class, 'id_ciclo');
    }
}
