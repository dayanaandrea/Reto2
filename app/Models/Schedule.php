<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class schedules extends Model
{
    protected $fillable = ['user_id', 'module_id', 'day', 'hour']; 
    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function module()
    {
        return $this->belongsToMany(Module::class);
    }
}