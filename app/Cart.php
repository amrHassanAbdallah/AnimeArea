<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
       ''
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    /*public function User()
    {
        return $this->belongsTo('App\User');
    }*/
}
