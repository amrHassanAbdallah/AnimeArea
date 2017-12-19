<?php

namespace App\Http\Controllers;

use App\classes\Checkout;
use App\classes\CheckoutNotifier;
use App\Notification;
use App\Order;
use App\Payment;
use App\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentsController extends Controller
{
    public function buy($id, Request $request)
    {
        if (!isset($request->PaymentWay)) {
            return redirect()->back()->with("error", "Payment gate way required !!");
        }
        if ($request->PaymentWay == "paypal") {
            $PaymentStrategy = new \App\classes\PaypalStrategy(\Illuminate\Support\Facades\Auth::user()->email, "123456789");

        } elseif ($request->PaymentWay == "CreditCard") {
            $PaymentStrategy = new \App\classes\CreditCardStrategy(\Illuminate\Support\Facades\Auth::user()->name, "visa", "1234", "2017/9");

        }
        $order = Order::orderBy('updated_at', 'desc')->where("state", "=", 1)->where("is_paid", "=", 1)->where("cart_id", "=", Auth::user()->cart->id)
            ->first();
        $feedBackArray = ["success" => "Your item(s) shall be delievered soon enough .",
            "error" => "Please try again later ! ."];
        $state = ($PaymentStrategy->pay($id)) ? "success" : "error";
        if ($state) {
            Checkout::Trigger();
        }

        return redirect("/")->with($state, $feedBackArray[$state]);
    }

    public function index()
    {
        return view("Payment.index")->with("payments", Payment::where("user_id", "=", Auth::user()->id)->get());
    }

    public static function ActivatePayment($order_id)
    {
        $SellerWallet = Wallet::where("user_id", "=", 1)->first();
        $payment = Payment::where("order_id", "=", $order_id)->first();
        $amount = $payment->amount;
        if (!$SellerWallet) {
            $SellerWallet = new Wallet();
            $SellerWallet->user_id = 1;
            $SellerWallet->payment = 0.0;
        }
        if (1000000 > (((float)$SellerWallet->amount) + $amount)) {

            $SellerWallet->amount += $amount;
            $SellerWallet->save();
            return true;

        }
        return false;
    }
}
