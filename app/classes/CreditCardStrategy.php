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
use App\User;
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


    public function pay(int $order_id) {
        $SellerWallet = Wallet::where("user_id","=",Auth::user()->id)->first();
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


    public function withdraw(User $user)
    {
        $wallet = $user->Wallet;

        if($wallet && (float)$wallet->amount  > 0){
            $transfered = $wallet->amount;
            $wallet->amount = 0.0;
            $wallet->save();
            return $wallet->amount;

        }
        return false;
    }
}