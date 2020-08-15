<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class Withdrawal extends Model
{
    use SoftDeletes;
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

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

}
