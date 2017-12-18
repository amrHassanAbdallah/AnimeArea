<?php
/**
 * Created by PhpStorm.
 * User: amr
 * Date: 12/18/17
 * Time: 7:22 PM
 */

namespace App\classes;


use App\Wallet;

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
        if(1000000>($SellerWallet->amount+$amount)){
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