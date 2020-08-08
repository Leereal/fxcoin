<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReferralBonus extends Model
{
    //Investment Relationship
    public function investment()
    {
        return $this->belongsTo('App\Investment');
    }

    //User Relationship
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    // //Referred User Relationship
    // public function referred_user()
    // {
    //     return $this->belongsTo('App\User');
    // }
}
