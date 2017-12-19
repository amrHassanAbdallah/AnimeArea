<?php


namespace App\classes;


class BestProductVoteSingleton
{
    private static $instance = null;
    private   $ProductCode;
    private  $counter = 0 ;
    private  $lastUpdate;
    private $category;
    private $vote = 0;


    public static  function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new BestProductVoteSingleton();
        }

        return self::$instance;
    }

    // prevent creating multiple instances due to "private" constructor
    private function __construct(){}

    // prevent the instance from being cloned
    private function __clone(){}

    // prevent from being unserialized
    private function __wakeup(){}

    /*public function __set($name, $value)
    {
       if(property_exists(self::getInstance(),$name)){
           $this->$name = $value;
           return true;
       }
       return false;
    }*/
    public function setAll(array $Values =[]){
        if(!isset($Values['counter'],$Values['ProductCode'],$Values['category'])){
            return false;
        }
        if($this->ProductCode){
            if($Values["ProductCode"] === $this->ProductCode){
                $this->counter +=(int)$Values["counter"];
                return true;
            }
        }
        $this->counter += $Values['counter'];
        $this->ProductCode = $Values['ProductCode'];
        $this->lastUpdate = date('Y-m-d H:i:s');
        $this->category = $Values['category'];

        return true;
    }
    public function __get($name)
    {

        if (property_exists(self::getInstance(),$name)) {
            return $this->$name ;
        }
        return null;
    }

    /**
     * @return mixed
     */
    public function getVote()
    {
        return $this->vote;
    }

    /**
     * @param int $vote
     */
    public function IncreaseVote()
    {
         return ++$this->vote ;
    }


}