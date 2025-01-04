<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cycle extends Model
{
    protected $fillable = ['user_id', 'module_id', 'code' , 'name']; 
    public function modules()
    {
        return $this->hasMany(Module::class, 'cycle_id');
    }

    public function offers()
    {
        return $this->hasMany(Offer::class, 'offers_id');
    }
}
