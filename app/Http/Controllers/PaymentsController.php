<?php

namespace App\Http\Controllers;

use App\classes\Checkout;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentsController extends Controller
{
    public function buy($id, Request $request)
    {
        if(!isset($request->PaymentWay)){
            return redirect()->back()->with("error","Payment gate way required !!");
        }
        if($request->PaymentWay == "paypal"){
            $PaymentStrategy = new \App\classes\PaypalStrategy(\Illuminate\Support\Facades\Auth::user()->email,"123456789");

        }elseif ($request->PaymentWay == "CreditCard"){
            $PaymentStrategy = new \App\classes\CreditCardStrategy(\Illuminate\Support\Facades\Auth::user()->name,"visa","1234","2017/9");

        }
        $order = \App\Order::find($id);

        $feedBackArray = ["success"=>"Your item(s) shall be delievered soon enough .",
            "error"=>"Please try again later ! ."];
        $state =  ($PaymentStrategy->pay((new \App\classes\Tax($order))->getCost()))?"success":"error";
        if($state === "success"){
            $order->is_paid = 1;
            $order->save();
            $checkOut = new Checkout();
            $checkOut->attach([new \App\classes\CheckoutNotifier()]);
            $checkOut->fire();

        }
        return redirect("/")->with($state,$feedBackArray[$state]);
    }

    public function index()
    {
        return view("Payment.index")->with("payments",Payment::where("user_id","=",Auth::user()->id)->get());
    }
}
