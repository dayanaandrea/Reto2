<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ciclo extends Model
{
    protected $fillable = ['code', 'name'];

    public function modules()
    {
        return $this->hasMany(Module::class, 'cycle_id');
    }

    public function offers()
    {
        return $this->hasMany(Offer::class, 'cycle_id');
    }
}
