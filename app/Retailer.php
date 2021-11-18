<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retailer extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function retailer_type()
    {
        return $this->belongsTo('App\RetailerType');
    }

    public function items()
    {
        return $this->hasMany('App\Item');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function ingredients()
    {
        return $this->hasMany('App\Ingredient');
    }

    public function address()
    {
        return $this->hasOne('App\Address');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category', 'category_retailer', 'retailer_id', 'category_id');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role', 'role_user_table', 'user_id', 'role_id');
    }

    public function groups() {
        return $this->belongsToMany('App\Group');
    }

    public function tags()
    {
        return $this->hasMany('App\Tag');
    }

    public function items_images()
    {
        return $this->hasMany('App\ItemImage');
    }
}
