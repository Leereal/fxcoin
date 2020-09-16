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
            'created'=> $this->created_at,
            'amount'=> $this->amount,
            'balance'=> $this->balance,
            'description'=> $this->description, 
            'transaction_code'=> $this->transaction_code,
            'payment_method'=> $this->payment_method->name,  
            'expected_profit'=> $this->expected_profit,
            'package'=> $this->package->name,
            'period'=> $this->package->period,
            'category'=> $this->package->category,
            'due_date'=> $this->due_date,
            'pop'=> $this->pop,            
            'firstname'=> $this->user->name,
            'surname'=> $this->user->surname,
            'currency'=> $this->user->currency->symbol,
            'comments'=> $this->comments,
            'ipAddress'=> $this->ipAddress,
            'status'=> $this->status,  
            'description'=> $this->description,  
            'referral_bonus_amount'=> $this->referral_bonus->amount ?? 'No bonus'                   
        ];
    }
}
