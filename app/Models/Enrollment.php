<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = ['date', 'user_id', 'module_id']; 
    //Este clase modelo en un futuro podría borrarse(OPCIONAL) 
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }
}
