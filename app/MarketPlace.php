<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarketPlace extends Model
{
    //PendingPayment Relationship
    public function pending_payments()
    {
        return $this->hasMany('App\PendingPayment');
    }

    //Payment Detail Relationship
    public function payment_detail()
    {
        return $this->belongsTo('App\PaymentDetail');
    }

    //User Detail Relationship
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
