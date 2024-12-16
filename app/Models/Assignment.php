<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    public function teacher()
    {
        return $this->belongsToMany(User::class);
    }

    public function module()
    {
        return $this->belongsToMany(Module::class);
    }
}
