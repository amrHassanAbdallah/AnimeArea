<?php
/**
 * Created by PhpStorm.
 * User: amr
 * Date: 12/18/17
 * Time: 7:24 PM
 */

namespace App\classes;


class PaypalStrategy implements PaymentStrategy {

    private  $emailId;
    private  $password;


    public function __construct(string $email,string $pwd)
    {
        $this->emailId=$email;
        $this->password=$pwd;
    }


    function pay(int $amount) {
        return( $this->amount + " $ paid using Paypal.");
    }

}