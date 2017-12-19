<?php

namespace App\classes;

interface PaymentStrategy {
    public function  pay(int $order_id);
    public function TransferMoney(float $amount);
}
