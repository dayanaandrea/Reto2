<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    protected $fillable = ['cycle_id', 'module_id'];

    public function cycle()
    {
        return $this->belongsTo(Cycle::class, 'cycle_id');
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }
}
