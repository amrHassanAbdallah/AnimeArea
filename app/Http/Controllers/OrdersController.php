<?php

namespace App\Http\Controllers;

use App\classes\Checkout;
use App\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        return view("orders.index")->with(["orders"=>Order::all()]);
    }

    public function single($id)
    {
        return view("orders.single")->with(["order"=>Order::find($id)]);
    }
    public function state($order_id)
    {
        //send notification to user , chaange order state , change delevery state
        $Order = Order::find($order_id);
        $Order->state = 0;
        $Order->shipment_state = "In progress";
        $Order->save();
        $login = new Checkout();
        $login->attach([new \App\classes\OrderConfirmationNotifier($Order->id)]);
        $login->fire();
        return redirect()->back()->with("success","Order state have been changed ");

    }
}
