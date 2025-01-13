<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = ['code', 'name','hours', 'course', 'user_id', 'cycle_id']; 
    public function cycle()
    {
        return $this->belongsTo(Cycle::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function enrollments(){
        return $this->hasMany(Enrollment::class);
    }
}
