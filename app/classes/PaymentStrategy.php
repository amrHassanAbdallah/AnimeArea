<?php
/**
 * Created by VSC.
 * User: Omar_Raafat
 * Date: 12/12/17
 * Time: 03:04 AM
 */
namespace App\classes;

interface PaymentStrategy {
    function pay(int $amount);
}
