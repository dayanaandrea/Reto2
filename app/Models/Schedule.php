<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = ['module_id', 'day', 'hour']; 

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}

