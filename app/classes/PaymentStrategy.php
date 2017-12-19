<?php

namespace App\classes;

use App\User;

interface PaymentStrategy {
    public function  pay(int $order_id);
    public function withdraw(User $user);
}
