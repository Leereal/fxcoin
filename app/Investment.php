<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    //Package Relationship
    public function package()
    {
        return $this->belongsTo('App\Packages');
    }

    //Payment Relationship
    public function payment_method()
    {
        return $this->belongsTo('App\PaymentMethod');
    }

    //Referral Bonus Relationship
    public function referral_bonus()
    {
        return $this->hasOne('App\ReferralBonus');
    }

    //User Relationship
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    //MarketPlace Relationship
    public function market_places()
    {
        return $this->hasMany('App\MarketPlace');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    
}
