<?php


namespace App\classes;


class BestBookVoteSingleton
{
    private static $instance = null;
    private  $counter ;
    private  $id ;
    private   $name;
    public static  function getInstance($productId)
    {
        if (null === self::$instance) {
            self::$instance = new BestBookVoteSingleton();
        }

        return self::$instance;
    }

    // prevent creating multiple instances due to "private" constructor
    private function __construct(){}

    // prevent the instance from being cloned
    private function __clone(){}

    // prevent from being unserialized
    private function __wakeup(){}

    public function Getvote(){
     return $this->counter;
    }
    public function GetId(){
        return $this->id;
    }

    public function IncreaseVote()
    {
       return ++$this->counter ;
    }
    public function DecreaseVote()
    {
        return --$this->counter ;
    }

    public function SetCounter($productId)
    {

        //get from the db and set counter to it
    }
}