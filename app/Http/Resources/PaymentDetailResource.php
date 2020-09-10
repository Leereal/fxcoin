<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

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
            'branch'=> $this->branch, 
            'account_number'=> $this->account_number, 
            'account_type'=> $this->account_type, 
            'account_holder'=> $this->account_holder, 
            'ipAddress'=> $this->ipAddress,  
            'first_name'=> $this->user->name,
            'surname'=> $this->user->surname,           
            'payment_method'=> $this->payment_method->name, 
            'currency'=> $this->payment_method->currency->name, 
             // 'payment_method_avatar'=> url('/')."/images/".$this->payment_method->avatar,     
             'payment_method_avatar'=>asset('images/'.$this->payment_method->avatar) 
         
        ];
    }
}
