<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WithdrawalResource extends JsonResource
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
            'created'=> $this->created_at, 
            'amount'=> $this->amount, 
            'transaction_code'=> $this->transaction_code,
            'payment_method'=> $this->payment_detail->payment_method->name,  
            'account_number'=> $this->payment_detail->account_number,
            'reason'=> $this->reason,
            'firstname'=> $this->user->name,
            'surname'=> $this->user->surname,
            'comments'=> $this->comments,
            'ipAddress'=> $this->ipAddress,   
            'status'=> $this->status,                 
        ];
    }
}
