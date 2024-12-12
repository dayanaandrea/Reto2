<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    protected $fillable = ['code', 'name', 'hours', 'course', 'cycle_id'];

    public function ciclo()
    {
        return $this->belongsTo(Ciclo::class, 'cycle_id');
    }

    //REVISAR 

    public function ofertas()
    {
        return $this->hasMany(Oferta::class, 'id_modulo');
    }
}
