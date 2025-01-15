<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $fillable = ['date', 'time','status', 'user_id' , 'week']; 

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'participants', 'meeting_id', 'user_id');
    }

    public static function getStatusOptions()
    {
        return ['aceptada', 'rechazada', 'pendiente'];
    }
}
