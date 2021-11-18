<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function retailer()
    {
        return $this->belongsTo('App\Retailer');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Order', 'item_order', 'item_id', 'order_id')->withPivot('modify')->withTimestamps();
    }

    public function ingredients()
    {
        return $this->belongsToMany('App\Ingredient', 'ingredient_item', 'item_id', 'ingredient_id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'item_tag', 'item_id', 'tag_id');
    }

    public function images()
    {
        return $this->hasMany('App\ItemImage');
    }
}
