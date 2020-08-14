<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\PendingPaymentResource;

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
            'payment_method_avatar'=> url('/')."/images/".$this->payment_detail->payment_method->avatar,
            'payment_method_id'=> $this->payment_detail->payment_method->id, 
            'account_number'=> $this->payment_detail->account_number,
            'reason'=> $this->reason,
            'firstname'=> $this->user->name,
            'cellphone'=> $this->user->cellphone,
            'country'=> $this->user->country->name,
            'surname'=> $this->user->surname,
            'comments'=> $this->comments,
            'ipAddress'=> $this->ipAddress,    
            'pending_payments' => PendingPaymentResource::collection($this->pending_payments)

        ];
    }
}
