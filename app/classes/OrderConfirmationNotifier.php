<?php
/**
 * Created by PhpStorm.
 * User: amr
 * Date: 12/18/17
 * Time: 10:18 AM
 */

namespace App\classes;


use App\Notification;
use App\Order;

class OrderConfirmationNotifier implements Observer
{
    protected  $Order_id;
    public function __construct($order_id)
    {
      $this->Order_id = $order_id;
    }

    public function handle()
    {
        $order = Order::find($this->Order_id);
        $user = $order->getUser();

        $Notification = new Notification;
        $Notification->content = $order->id;
        /*"a user :".Auth::user()->name." , email:  ".Auth::user()->email." has placed an order  ,".$order->description;*/
        $Notification->user_id = $user->id;
        $Notification->type = "Shipment_state";
        $Notification->content =  "Your order #  <a href=\"{{route('Orders.single',$order->id)}}\"> {$order->id} </a> state has bee changed to {$order->shipment_state}";
        $Notification->save();

    }
}