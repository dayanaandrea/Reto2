<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class assignments extends Model
{
    protected $fillable = ['user_id', 'module_id']; 


    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function module()
    {
        return $this->belongsToMany(Module::class);
    }
}
