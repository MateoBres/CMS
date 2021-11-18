<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function retailers() {
        return $this->belongsToMany('App\Retailer');
    }
}
