<?php
/**
 * Created by PhpStorm.
 * User: amr
 * Date: 12/18/17
 * Time: 7:24 PM
 */

namespace App\classes;


use App\Order;
use App\Payment;
use App\Wallet;
use Illuminate\Support\Facades\Auth;

class PaypalStrategy implements PaymentStrategy {

    private  $emailId;
    private  $password;


    public function __construct(string $email,string $pwd)
    {
        $this->emailId=$email;
        $this->password=$pwd;
    }


    public function pay(int $order_id) {
        $SellerWallet = Wallet::where("user_id","=",1)->first();
        if(!$SellerWallet){
            $SellerWallet = new Wallet();
            $SellerWallet->user_id = 1;
            $SellerWallet->amount = 0.0;
        }

        $amount = Order::GetOrderAmountWithTaxs($order_id);
        $state = Payment::create([
            'amount'=>$amount,
            'description'=>"payment for order #".$order_id,
            'order_id'=>$order_id,
            'customer_id'=>Auth::user()->id,
            'user_id'=>1
            ]);
        if($state){

            Order::UpdateOrderPaidState($order_id);
        }

        return $state;
    }

    /*public function ActivatePayment($order_id)
    {
        if(1000000>(((float)$SellerWallet->amount)+$amount)){

            $SellerWallet->amount += $amount;
            $SellerWallet->save()
            return true;

        }
    }*/

    public function TransferMoney(float $amount)
    {
        // TODO: Implement TransferMoney() method.
    }
}