<?php
/**
 * Created by PhpStorm.
 * User: amr
 * Date: 12/18/17
 * Time: 1:03 PM
 */

namespace App\classes;


class Tax implements ProductService
{
    protected $Order;
    protected $percent ;

    public function __construct(ProductService $car,$number = 10)
    {
        $this->Order = $car;
        $this->percent = $number;
    }

    public function getCost()
    {
        return $this->Order->getCost() + ($this->Order->getCost()*$this->percent)/100;
    }
    public function getDescription()
    {
        return $this->Order->getDescription()." ,  ".$this->percent."% taxes : Tax";
    }

    public function setQNTY($number)
    {
        $this->percent = $number;
    }
}