<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    public function retailer()
    {
        return $this->belongsTo('App\Retailer');
    }

    public function items()
    {
        return $this->belongsToMany('App\Item', 'ingredient_item', 'ingredient_id', 'item_id');
    }
}
