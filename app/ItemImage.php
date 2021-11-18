<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemImage extends Model
{
    public function retailer()
    {
        return $this->belongsTo('App\Retailer');
    }

    public function item()
    {
        return $this->belongsTo('App\Item');
    }
}
