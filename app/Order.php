<?php

namespace App;

use App\classes\ProductService;
use Illuminate\Database\Eloquent\Model;

class Order extends  Model implements ProductService
{
    protected  $fillable = ['cart_id'];
    public function Cart()
    {
        return $this->belongsTo('App\Cart');
    }
    public function Items()
    {
        return $this->hasMany(item::class);
    }
    public function getUser(){
        return User::find($this->Cart->User->id);
    }

    public function getCost()
    {
        return $this->price;
    }

    public function getDescription()
    {
        return $this->description;
    }
    public static function UpdateOrderPaidState($orderId){
        $order = Order::find($orderId);
        $order->is_paid = 1;
        return $order->save();
    }

    public static function GetOrderAmountWithTaxs($orderId)
    {
        $price = Order::find($orderId)->price;
        return ($price)?$price:0.00;
    }

    public static function DeletingOrderWithItsItems($order_id)
    {
        $order = Order::find($order_id);
        $items = $order->Items;
        self::ResetTheProductAvailabilty($items);
       $order->delete();
       return redirect('/home')->with("success","Order deleted");
    }
    private static function ResetTheProductAvailabilty($items)
    {
        foreach ($items as $item) {
            $products_ids_Inside = unserialize($item->products_ids);
            foreach ($products_ids_Inside as $product_id) {
                $product = Product::find($product_id);
                if ($product) {
                    $product->available = 1;
                    $product->save();
                }
            }
            $item->delete();
        }
    }
}
