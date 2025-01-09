<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cycle extends Model
{
    protected $fillable = ['code', 'name'];
    
    public function modules()
    {
        return $this->hasMany(Module::class);
    }
}
