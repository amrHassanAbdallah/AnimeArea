<?php

namespace App;

use App\classes\ProductService;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements ProductService
{
    protected $description;
    protected $price;
    protected $qty = 1;
    protected $cat;
    protected  $fillable = ['name','price','image','description','Seller_id'];

    public function seller()
    {
        return $this->belongsTo('app\User');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

   /* public function image($image)
    {
        return '/storage/cover_images/'.$image;
    }*/
public function getDescription()
    {
        return "x ".$this->qty." product(s) , category:".$this->cat;
    }
public function getCost()
    {
        return $this->qty*$this->price;
    }
public function setCost($cost){
        $this->price = $cost;
    }

    public function setDescription($desc)
    {
        $this->description = $desc;
    }

    public function setQTY($qty)
    {
        $this->qty = $qty;
    }
    public function setCat($cat){
    $this->cat = $cat;
    }
}
