<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = ['user_id', 'module_id']; 

    public function teacher()
    {
        return $this->belongsToMany(User::class);
    }

    public function module()
    {
        return $this->belongsToMany(Module::class);
    }
}
