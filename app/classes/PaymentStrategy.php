<?php

namespace App\classes;

interface PaymentStrategy {
    public function  pay(float $amount);
    public function TransferMoney(float $amount);
}
