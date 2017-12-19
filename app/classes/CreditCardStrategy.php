<?php
/**
 * Created by PhpStorm.
 * User: amr
 * Date: 12/18/17
 * Time: 7:22 PM
 */

namespace App\classes;


use App\Order;
use App\Payment;
use App\Wallet;
use Illuminate\Support\Facades\Auth;

class CreditCardStrategy implements PaymentStrategy
{
    private  $name;
    private  $cardNumber;
    private  $cvv;
    private  $dateOfExpiry;

    public function __construct(string $nm, string $ccNum, string $cvv, string $expiryDate) {
        $this->name = $nm;
        $this->cardNumber = $ccNum;
        $this->cvv = $cvv;
        $this->dateOfExpiry = $expiryDate;
    }


    function pay(float $amount) {
        $SellerWallet = Wallet::where("user_id","=",1)->first();
        if(!$SellerWallet){
            $SellerWallet = new Wallet();
            $SellerWallet->user_id = 1;
            $SellerWallet->payment = 0.0;
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

    public function TransferMoney(float $amount)
    {
        // TODO: Implement TransferMoney() method.
    }
}