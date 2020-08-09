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
            'date_received'=> $this->created_at, 
            'investment_amount'=> $this->investment->amount,  
            'referrer'=> $this->user->name,
            'referral'=> $this->investment->user->username,
            'package'=> $this->investment->package->name                
        ];
    }
}
