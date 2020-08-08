<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    //Country Relationship
    public function countries()
    {
        return $this->hasMany('App\Country');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
