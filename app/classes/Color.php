<?php
/**
 * Created by PhpStorm.
 * User: amr
 * Date: 11/16/17
 * Time: 8:51 AM
 */

namespace App\classes;


class Color implements ProductService
{
    protected $carService;

    public function __construct(ProductService $car)
    {
        $this->carService = $car;
    }

    public function getCost()
    {
        return 33 + $this->carService->getCost();
    }
    public function getDescription()
    {
        return $this->carService->getDescription()." changing or adding specific color .";
    }
}