<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = ['cycle_id', 'module_id']; 
    public function cycle()
    {
        return $this->belongsToMany(Cycle::class, 'cycle_id');
    }

    public function module()
    {
        return $this->belongsToMany(Module::class, 'module_id');
    }
}
