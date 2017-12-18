<?php

namespace App\Http\Controllers;

use App\Cart;
use App\classes\backbag;
use App\classes\BestProductVoteSingleton;
use App\classes\CheckoutNotifier;
use App\classes\LogHandler;
use App\classes\Checkout;
use App\classes\Subject;
use App\item;
use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    protected $observers = [];
    public function __construct()
    {
        $this->middleware('customer');
    }

    public function cart()
    {


        return view('customer.cart')->with(['NOP' => $this->getNumberOFProductsWithInTheCart(), 'items' => $this->GetAllItems(),'totall_price'=>$this->TotallPrice()]);
    }

    public function store(Request $request, $id)
    {


        $this->validate($request, [
            'Qty' => 'required|max:2|min:1',

        ]);
        if((int)$request->Qty > 15){
            return redirect()->back()->with(['error' => 'Sorry , we do not allow more than 15 products ,you can add 15 each time till you get what you want or let other people have their chance too . ', 'NOP' => $this->getNumberOFProductsWithInTheCart()]);
        }
        if((int)$request->Qty === 0){
            return redirect()->back()->with(['success' => 'Nice, Try buddy  what about adding product next time ! ', 'NOP' => $this->getNumberOFProductsWithInTheCart()]);
        }
        $cart = $this->NewCart(Auth::user()->cart);
        $order = $cart->orders;
        $order = $this->SetOrder($order, $cart);
        $state = $this->NewItem($id, $order, $request->Qty);
/*        $order->description = $this->AllDescription() ;
        $order->price = $this->TotallPrice();
        $order->save();*/

        if ($state) {
            return redirect()->back()->with(['success' => 'new item(s)!', 'NOP' => $this->getNumberOFProductsWithInTheCart()]);

        } else {
            return redirect()->back()->with(['error' => 'could not add a new item !', 'NOP' => $this->getNumberOFProductsWithInTheCart()]);

        }

    }

    public function addDecorator($id,$option){
       if((int) $option >3){
           return redirect()->back()->with("error","no such thing here");
       }
        $item = item::find($id);
        $product = Product::find(item::find($id)->product_id);
        $product->setCost($product->price);
        $product->setDescription($product->description);
        $product->setCat($product->category->name);
        $product->setQTY($item->Quantity);
        $newCost = $item->price;
        $newDescription = $item->description;

        $backbag =   (new backbag($product,$item->Quantity));
        $newCost = $backbag->getCost();
        $newDescription = $backbag->getDescription();

      $item->price = $newCost;
      $item->description = $newDescription;
      $item->save();
  return redirect()->back()->with("success","all items now have a bag");

    }

    public function remove($id)
    {
        $item = item::find($id);
        $products_ids_Inside = unserialize($item->products_ids);
        foreach ($products_ids_Inside as $product_id){
            $product = Product::find($product_id);
            if($product){
                $product->available = 1;
                $product->save();
            }
        }
        $item->delete();

        return redirect()->back()->with("success","items deleted !.");
    }


    public function checkout()
    {

        $order = Order::where("state","=",1)->where("cart_id","=",Auth::user()->cart->id)->first();
        $order->description = $this->AllDescription();
        $order->price = $this->TotallPrice();
        $order->save();


        $checkOut = new Checkout();
        $checkOut->attach([new \App\classes\CheckoutNotifier()]);
        $checkOut->fire();


        return view('customer.checkout')->with(['NOP' => $this->getNumberOFProductsWithInTheCart(), 'items' => $this->GetAllItems(),'totall_price'=>$this->TotallPrice(),'order'=>$order]);
    }


    /**
     * @param $cart
     * * @return Order
     */
    public function NewCart($cart)
    {
        if (!isset($cart)) {
            $cart = new Cart;
            $cart->user_id = Auth::user()->id;
            return Auth::user()->cart()->save($cart);
        }


        return $cart;
    }

    /**
     * @param $order
     * @param $cart
     * @return Order
     */
    public function SetOrder($orders, $cart): Order
    {
        $order = $cart->orders()->orderByDesc('updated_at')->first();
        if (count($orders) == 0||$order->state == 0) {
            $order = $this->NewOrder($cart);
        }
        return $order;
    }

    /**
     * @param $cart
     * @return Order
     */
    public function NewOrder($cart): Order
    {
        $order = new Order;
        $order->cart_id = $cart->user_id;

        $cart->orders()->save($order);
        return $order;
    }

    /**
     * @param $id
     * @param $order
     * * @return boolean
     */
    public function NewItem($id, $order, $Qty)
    {
        $ctr = 0;

        $productsIds = array();
        $FirstProduct = Product::find($id);
        $product = Product::find($id);
        $AllproductsWithTheSameTag = Product::where('available', '=', 1)->where('code', '=', $product->code)->limit($Qty)->get();
        $ctr = $AllproductsWithTheSameTag->count();
        foreach ($AllproductsWithTheSameTag as $product) {
                /*  $item->products_ids */
                $productsIds[] = $product->id;

                $product->available = 0;
                $product->save();
                $ctr++;

        }
        if ($ctr > 0) {
            $item = new item;
            $BestProduct = BestProductVoteSingleton::getInstance();
//property_exists('BestProductVoteSingleton',"ProductCode") challenging part !!
            /*$BestProduct->__set("ProductCode",$product->code);
            $BestProduct->__set("counter",$ctr);
            $BestProduct->__set("lastUpdate",date('Y-m-d H:i:s'));
            $BestProduct->__set("category",$FirstProduct->category->name);*/
            $BestProduct->setAll(["ProductCode"=>$product->code,"counter"=>$ctr,"category"=>$FirstProduct->category->name]);


            $item->product_id = $FirstProduct->id;
            $item->products_ids = serialize($productsIds);
            $item->price = (double)$ctr * (double)$FirstProduct->price;
            $item->description = "" . $ctr . " of " . $FirstProduct->category->name . " / code :" . $FirstProduct->code;

            $item ->category = $FirstProduct->category->name;
            $item->Quantity = $ctr;

            $order->items()->save($item);
            return true;
        }


        return false;
    }

    protected function getNumberOFProductsWithInTheCart()
    {
        if(Auth::check() && Auth::user()->membership === "customer"&&null !== Auth::user()->cart &&null !==Auth::user()->cart->orders()->where("state","=","1")->first()) {
            return count(Auth::user()->cart->orders()->where("state","=","1")->first()->items);
        }
        return 0;
    }

    /**
     * @return mixed
     */
    public function GetAllItems()
    {
        return Auth::user()->cart->orders()->where("state","=","1")->first()->items;
    }
    public function TotallPrice(){
        $items = $this->GetAllItems();
        $totall_price =0.0;
        foreach ($items as  $item){
            $totall_price +=$item->price;
        }
        return  $totall_price;
    }

    public function AllDescription()
    {
        $items = $this->GetAllItems();
        $description ="";
        foreach ($items as  $item){
            $description .=$item->description;
        }
        return  $description;
    }


}
