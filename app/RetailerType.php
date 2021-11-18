<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RetailerType extends Model
{
    public function retailers()
    {
        return $this->hasMany('App\Retailer');
    }
}
