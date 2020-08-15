<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReferralBonus extends Model
{
    use SoftDeletes;

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
