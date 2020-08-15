<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Settings extends Model
{
    use SoftDeletes;
    protected $guarded = []; 

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function currency()
    {
        return $this->hasOne('App\Currency');
    }

}
