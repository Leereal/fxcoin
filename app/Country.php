<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
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
}
