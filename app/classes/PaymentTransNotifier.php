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
use Illuminate\Support\Facades\Auth;

class PaymentTransNotifier implements Observer
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
        $Notification->user_id = Auth::user()->id;
        $Notification->type = "payment Info";
        $Notification->content =  " Congrats  you have got  $ {$order->amount} due to   order # {$order->id} . ";

        $Notification->save();

    }
}