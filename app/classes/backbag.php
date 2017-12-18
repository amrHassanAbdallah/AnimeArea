<?php
/**
 * Created by PhpStorm.
 * User: amr
 * Date: 11/15/17
 * Time: 6:30 AM
 */

namespace App\classes;


class backbag implements ProductService
{
    protected $Product;
    protected $quantity ;

    public function __construct(ProductService $car,$number = 1)
    {
        $this->Product = $car;
        $this->quantity = $number;
    }

    public function getCost()
    {
        return $this->quantity*19 + $this->Product->getCost();
    }
    public function getDescription()
    {
        return $this->Product->getDescription()." , x ".$this->quantity." bag : Hero";
    }

    public function setQNTY($number)
    {
        $this->quantity = $number;
    }
}