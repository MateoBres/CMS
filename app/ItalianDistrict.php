<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItalianDistrict extends Model
{
    public function zipcodes()
    {
        return $this->hasMany('App\ZipCode', 'district_id');
    }
}
