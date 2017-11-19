<?php
/**
 * Created by PhpStorm.
 * User: amr
 * Date: 11/16/17
 * Time: 1:47 PM
 */

namespace App\classes;


interface Subject
{
    public function attach($observable);
    public function detach($index);
    public function notify();
}