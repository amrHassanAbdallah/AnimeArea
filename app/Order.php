<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected  $fillable = ['cart_id'];
    public function Cart()
    {
        return $this->belongsTo('App\Cart');
    }
    public function Items()
    {
        return $this->hasMany(item::class);
    }
}
