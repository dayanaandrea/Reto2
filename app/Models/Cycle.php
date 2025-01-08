<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cycle extends Model
{
    protected $fillable = ['user_id', 'module_id', 'code' , 'name']; 
    public function modules()
{
    return $this->belongsToMany(Module::class, 'offers');
}
}
