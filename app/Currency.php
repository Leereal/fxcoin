<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    use SoftDeletes;
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
