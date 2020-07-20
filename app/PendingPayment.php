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

    //User Detail Relationship
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
