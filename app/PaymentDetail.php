<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentDetail extends Model
{
    use SoftDeletes;
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
