<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReferralBonusResource extends JsonResource
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
            'investment_amount'=> $this->investment->amount,  
            'referrer'=> $this->user->name,
            'referred_user'=> $this->referred_user->name,                 
        ];
    }
}
