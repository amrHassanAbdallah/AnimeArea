<?php

namespace App;

use App\classes\ProductService;
use Illuminate\Database\Eloquent\Model;

class Order extends  Model implements ProductService
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
    public function getUser(){
        return User::find($this->Cart->User->id);
    }

    public function getCost()
    {
        return $this->price;
    }

    public function getDescription()
    {
        return $this->description;
    }
}
