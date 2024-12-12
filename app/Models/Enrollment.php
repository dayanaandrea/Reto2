<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function modulo()
    {
        return $this->hasMany(Offer::class, 'module_id');
    }
}
