<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    use SoftDeletes;
    //Country Relationship
    public function countries()
    {
        return $this->hasMany('App\Country');
    }

    public function payment_methods()
    {
        return $this->hasMany('App\PaymentMethod');
    }

    //User Relationship
    public function users()
    {
        return $this->hasMany('App\User');
    }


    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
