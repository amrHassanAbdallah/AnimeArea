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
use App\Payment;

class PaymentAboutTransNotifier implements Observer
{
    protected  $Order_id;
    public function __construct($order_id)
    {
        $this->Order_id = $order_id;
    }

    public function handle()
    {
        $order = Payment::where("order_id","=",$this->Order_id)->first();

        $Notification = new Notification;
        $Notification->user_id = 1;
        $Notification->type = "payment Info";
        $Notification->content =  "you will get  $ {$order->amount} as soon as  order # {$order->id} shipment delivered . ";

        $Notification->save();

    }
}