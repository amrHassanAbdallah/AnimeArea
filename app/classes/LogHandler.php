<?php
/**
 * Created by PhpStorm.
 * User: amr
 * Date: 11/16/17
 * Time: 1:55 PM
 */

namespace App\classes;


class LogHandler implements Observer
{
    public function handle()
    {
        var_dump('this log handler');
    }
}