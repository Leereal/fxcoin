<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes;
    //User Relationship
    public function users()
    {
        return $this->hasMany('App\User');
    }

    //Currency Relationship
    public function currencies()
    {
        return $this->hasMany('App\Currency');
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
