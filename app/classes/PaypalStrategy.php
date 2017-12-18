<?php
/**
 * Created by PhpStorm.
 * User: amr
 * Date: 12/18/17
 * Time: 7:24 PM
 */

namespace App\classes;


use App\Wallet;

class PaypalStrategy implements PaymentStrategy {

    private  $emailId;
    private  $password;


    public function __construct(string $email,string $pwd)
    {
        $this->emailId=$email;
        $this->password=$pwd;
    }


    function pay(float $amount) {
        $SellerWallet = Wallet::where("user_id","=",1)->first();
        if(!$SellerWallet){
            $SellerWallet = new Wallet();
            $SellerWallet->user_id = 1;
            $SellerWallet->amount = 0.0;
        }
        if(1000000>(((float)$SellerWallet->amount)+$amount)){

            $SellerWallet->amount += $amount;
            return true;

        }

        return false;
    }

    public function TransferMoney(float $amount)
    {
        // TODO: Implement TransferMoney() method.
    }
}