<?php
/**
 * Created by PhpStorm.
 * User: amr
 * Date: 12/18/17
 * Time: 7:22 PM
 */

namespace App\classes;


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


    function pay(int $amount) {
        return(amount + " $ paid with credit/debit card");
    }
}