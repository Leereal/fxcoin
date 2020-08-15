<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bonus extends Model
{
    use SoftDeletes;
    //User Relationship
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
