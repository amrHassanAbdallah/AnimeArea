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

class CheckoutNotifier implements Observer
{
    public function handle()
    {

        $order = Order::where("state","=",1)->where("cart_id","=",Auth::user()->cart->id)->first();
        $Notification = Notification::where("type","=","order")->where("user_id","=",1)->where("content","=",$order->id)->first();
        if($Notification  === null){
            $Notification = new Notification;
            $Notification->content = $order->id;
            /*"a user :".Auth::user()->name." , email:  ".Auth::user()->email." has placed an order  ,".$order->description;*/
            $Notification->user_id = 1;
            $Notification->save();
        }else{
            if($Notification->saw){
                $Notification->saw = 0;
                $Notification->save();
            }
        }


    }
}