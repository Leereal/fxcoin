<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
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
