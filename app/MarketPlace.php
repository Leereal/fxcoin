<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MarketPlace extends Model
{
    use SoftDeletes;
    
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

    //Investment Relationship
    public function investment()
    {
        return $this->belongsTo('App\Investment');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
