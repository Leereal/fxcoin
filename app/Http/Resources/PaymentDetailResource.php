<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentDetailResource extends JsonResource
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
            'account_number'=> $this->account_number, 
            'ipAddress'=> $this->ipAddress,  
            'first_name'=> $this->user->name,
            'surname'=> $this->user->surname,           
            'payment_method'=> $this->payment_method->name, 
            'payment_method_avatar'=> url('/')."/images/".$this->payment_method->avatar,              
        ];
    }
}
