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
            'placed_by'=> $this->market_place->user->name,//$this->market_place->user->surname ,
            'account_to_pay'=> $this->market_place->payment_detail->account_number,
            'method_to_pay'=> $this->market_place->payment_detail->payment_method->name,
            'due_by'=> $this->expiration_time,
            'firstname'=> $this->user->name,
            //'surname'=> $this->user->surname,
            'comments'=> $this->comments,
            'ipAddress'=> $this->ipAddress,                    
        ];
    }
}
