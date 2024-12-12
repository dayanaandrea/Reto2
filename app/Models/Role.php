<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    // Un rol lo pueden tener asignador varios usuarios
    public function users(): HasMany {
        return $this->hasMany(User::class);
    }
}