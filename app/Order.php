<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function retailer()
    {
        return $this->belongsTo('App\Retailer');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function address()
    {
        return $this->belongsTo('App\Address');
    }

    public function details()
    {
        return $this->belongsToMany('App\Item', 'item_order', 'order_id', 'item_id')->withPivot('modify')->withTimestamps();
    }

    public function status()
    {
        return $this->belongsTo('App\OrderStatus', 'status_id');
    }
}
