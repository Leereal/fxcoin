<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvestmentResource extends JsonResource
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
            'description'=> $this->description, 
            'transaction_code'=> $this->transaction_code,
            'payment_method'=> $this->payment_method->name,  
            'expected_profit'=> $this->expected_profit,
            'package'=> $this->package->name,
            'due_date'=> $this->due_date,
            'pop'=> $this->pop,            
            'firstname'=> $this->user->name,
            'surname'=> $this->user->surname,
            'comments'=> $this->comments,
            'ipAddress'=> $this->ipAddress,  
            'referral_bonus_amount'=> $this->referral_bonus->amount ?? 'No bonus'                   
        ];
    }
}
