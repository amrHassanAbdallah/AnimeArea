<?php

namespace App\Http\Controllers;

use App\classes\Checkout;
use App\classes\OrderDeletedNotifier;
use App\classes\PaymentAboutTransNotifier;
use App\classes\PaymentTransNotifier;
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
    public function state($order_id,Request $request)
    {
        //send notification to user , chaange order state , change delevery state
        $Order = Order::find($order_id);
        $Order->state = 0;
        $Order->shipment_state = ($request->shipment_state)?$request->shipment_state:"In progress";
        $login = new Checkout();
        if($request->shipment_state === "In progress"){
            $login->attach(new PaymentAboutTransNotifier($order_id));
        }
        if($request->shipment_state === "Delivered"){
            $login->attach(new PaymentTransNotifier($order_id));
            PaymentsController::ActivatePayment($order_id);
        }
        $Order->save();
        $login->attach([new \App\classes\OrderConfirmationNotifier($Order->id)]);
        $login->fire();
        return redirect()->back()->with("success","Order state have been changed ");

    }

    public function destroy($order_id)
    {
        $order = Order::find($order_id);
        PaymentsController::DeActivatePayment($order_id);
        $login = new Checkout();
        $login->attach(new OrderDeletedNotifier($order_id),new PaymentTransNotifier($order_id));
        $login->fire();
        Order::DeletingOrderWithItsItems($order->id);
        return redirect('/home')->with('success','order deleted !');
    }
}
