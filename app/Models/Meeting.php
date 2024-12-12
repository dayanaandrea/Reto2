<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    public function teacher()
    {
        return $this->hasMany(User::class, 'teacher_id');
    }

    public function student()
    {
        return $this->hasMany(User::class, 'student_id');
    }
}
