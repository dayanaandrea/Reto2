<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = ['cycle_id', 'module_id']; 
    public function cycle()
    {
        return $this->belongsTo(Cycle::class, 'cycle_id');
    }
    public function module()
    {
        return $this->belongsTo(Cycle::class, 'module_id');
    }

    
}
