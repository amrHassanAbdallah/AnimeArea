<?php
/**
 * Created by PhpStorm.
 * User: amr
 * Date: 11/16/17
 * Time: 1:54 PM
 */

namespace App\classes;


use App\Notification;
use App\Order;
use Illuminate\Support\Facades\Auth;

class EmailNotifier implements Observer
{
    public function handle()
    {
     /*   $order = Order::where("state","=",1)->where("cart_id","=",Auth::user()->cart->id)->first();*/
        $Notification = new Notification;
        $Notification->content = "a new order there ";
        $Notification->user_id = 1;
        $Notification->save();

    }
}