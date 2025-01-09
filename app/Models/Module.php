<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = ['code', 'name','hours', 'course' , 'cycle_id']; 
    public function cycle()
    {
        return $this->belongsTo(Cycle::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
