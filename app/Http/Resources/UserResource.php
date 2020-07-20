<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\RoleResource;

use App\Http\Resources\ReferralResource;

class UserResource extends JsonResource
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
            'firstname'=> $this->name,
            'surname'=> $this->surname,
            'username'=> $this->username,
            'email'=> $this->email,
            'cellphone'=> $this->cellphone, 
            'country'=> $this->country->name,
            'ipAddress'=> $this->ipAddress,
            'roles' => RoleResource::collection($this->roles)->map->only('name') ,
            'referrals' => UserResource::collection($this->referrals)->map->only('name','surname')
        ];
    }
}
