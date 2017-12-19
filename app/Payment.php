<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function Seller()
    {
        return $this->belongsTo('App\User',"id","user_id");
    }
    public function Customer()
    {
        return $this->belongsTo('App\User',"id","customer_id");
    }

    public static function create(array $data = [])
    {
        $Payment = new Payment();
        $Payment->amount = $data["amount"];
        $Payment->description = $data["description"];
        $Payment->order_id = $data["order_id"];
        $Payment->customer_id = $data["customer_id"];
        $Payment->user_id = 1;
        return $Payment->save();
    }
}
