<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BonusResource extends JsonResource
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
            'description'=> $this->description, 
            'date'=> $this->created_at,  
            'username'=> $this->user->name,                             
        ];
    }
}
