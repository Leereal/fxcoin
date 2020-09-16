<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PendingPaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id'=> $this->id,
            'amount'=> $this->amount, 
            'transaction_code'=> $this->transaction_code,
            'market_place_date'=> $this->market_place->created_at,            
            'placed_by'=> $this->market_place->user->name." ".$this->market_place->user->surname ,
            'cellphone'=> $this->market_place->user->cellphone,
            'account_to_pay'=> $this->market_place->payment_detail->account_number,
            'currency'=> $this->market_place->user->currency->symbol,
            'account_holder'=> $this->market_place->payment_detail->account_holder,
            'account_type'=> $this->market_place->payment_detail->account_type,
            'branch'=> $this->market_place->payment_detail->branch,
            'method_to_pay'=> $this->market_place->payment_detail->payment_method->name,
            'offer_time'=> $this->created_at,
            'due_by'=> $this->expiration_time,
            'firstname'=> $this->user->name,
            'surname'=> $this->user->surname,
            'comment'=> $this->comment,
            'ipAddress'=> $this->ipAddress,
            'payment_method'=> $this->payment_method->name, 
            'payment_method_avatar'=>$this->payment_method->avatar, 
            'package'=> $this->package->name,      
            'status'=> $this->status, 
            'pop'=> url('/')."/images/".$this->pop,                
        ];
    }
}
