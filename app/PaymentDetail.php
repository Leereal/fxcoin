<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    //Payment Method Relationship
    public function payment_method()
    {
        return $this->belongsTo('App\PaymentMethod');
    }

    //Withdrawal Relationship
    public function withdrawals()
    {
        return $this->hasMany('App\Withdrawal');
    }

    //MarketPlace Relationship
    public function market_place()
    {
        return $this->hasOne('App\MarketPlace');
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
}
