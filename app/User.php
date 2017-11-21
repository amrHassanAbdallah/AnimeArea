<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends  Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Product_id', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function Notification()
    {
        return $this->hasMany(Notification::class);
    }
    public function products()
    {
        return $this->hasMany('App\Product');
    }
    public function Cart()
    {
        return $this->hasOne('App\Cart');
    }
}
