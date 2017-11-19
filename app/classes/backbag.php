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
    protected $carService;

    public function __construct(ProductService $car)
    {
        $this->carService = $car;
    }

    public function getCost()
    {
        return 19 + $this->carService->getCost();
    }
    public function getDescription()
    {
        return $this->carService->getDescription()." , this is a bag for laptop";
    }
}