<?php
/**
 * Created by PhpStorm.
 * User: amr
 * Date: 11/15/17
 * Time: 6:24 AM
 */

namespace App\classes;


class NormalProduct implements ProductService
{


    public function getCost()
    {
        return 20;
    }

    public function getDescription()
    {
        return "Book about hacking .";
    }

}