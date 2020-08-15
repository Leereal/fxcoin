<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PendingPayment extends Model
{
    use SoftDeletes;

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

    /**
     * Get the payment owner.
     */
    public function paymentOwner()
    {
        return $this->hasOneThrough('App\User', 'App\MarketPlace');
    }


    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    protected $guarded = [];
}
