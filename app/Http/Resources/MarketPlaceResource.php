<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MarketPlaceResource extends JsonResource
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
            'balance'=> $this->balance, 
            'transaction_code'=> $this->transaction_code,
            'payment_method'=> $this->payment_detail->payment_method->name,  
            'account_number'=> $this->payment_detail->account_number,
            'reason'=> $this->reason,
            'firstname'=> $this->user->name,
            //'surname'=> $this->user->surname,
            'comments'=> $this->comments,
            'ipAddress'=> $this->ipAddress,                    
        ];
    }
}
