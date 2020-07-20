<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
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
            'name'=> $this->name,
            'minimum'=> $this->minimum,
            'interest'=> $this->interest,
            'daily_interest'=> $this->daily_interest,  
            'period'=> $this->period             
        ];
    }
}
