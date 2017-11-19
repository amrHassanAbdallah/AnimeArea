<?php
/**
 * Created by PhpStorm.
 * User: amr
 * Date: 11/16/17
 * Time: 1:37 PM
 */

namespace App\classes;


use Mockery\Exception;

class Loginnn implements Subject
{
    protected $observers = [];

    public function attach($observable)
    {
        if(is_array($observable)){
            echo "true";
            return $this->attachObservers($observable);
        }
        $this->observers[] = $observable;
        return $this;
        
    }

    public function detach($index)
    {
        unset($this->observers[$index]);
    }

    public function notify()
    {
        foreach ($this->observers as $observer){
    $observer->handle();
    }
    }
    public function handle()
    {
        var_dump("this is some shit .");
    }

    /**
     * @param $observable
     */
    private function attachObservers($observable)
    {
        foreach ($observable as $observer) {
            if (!$observer instanceof Observer) {
                throw new Exception;
            }
            $this->attach($observer);
        }
    }

    /**
     * @return array
     */
    public function fire()
    {
        $this->notify();
    }
}