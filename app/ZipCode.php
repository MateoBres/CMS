<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZipCode extends Model
{
    public function district()
    {
        return $this->belongsTo('App\ItalianDistrict', 'district_id');
    }
}
