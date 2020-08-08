<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PendingPayment extends Model
{
    //MarketPlace Detail Relationship
    public function market_place()
    {
        return $this->belongsTo('App\MarketPlace');
    }
    //Package Detail Relationship
    public function package()
    {
        return $this->belongsTo('App\Packages');
    }
    //PaymentMethod Detail Relationship
    public function payment_method()
    {
        return $this->belongsTo('App\PaymentMethod');
    }   
    //User Detail Relationship
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    protected $guarded = [];
}
