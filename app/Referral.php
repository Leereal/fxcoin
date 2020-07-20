<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    //User Relationship
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
