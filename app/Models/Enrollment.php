<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = ['date', 'course','student_id', 'module_id' , 'cycle_id']; 
    //Este clase modelo en un futuro podría borrarse(OPCIONAL) 
    public function user()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }

    public function cycle()
    {
        return $this->belongsTo(Cycle::class, 'cycle_id');
    }
}
