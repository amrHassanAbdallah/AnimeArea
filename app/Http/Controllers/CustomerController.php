<?php

namespace App\Http\Controllers;

use App\Cart;
use App\item;
use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
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
        if ($state) {
            return redirect()->back()->with(['success' => 'new item(s)!', 'NOP' => $this->getNumberOFProductsWithInTheCart()]);

        } else {
            return redirect()->back()->with(['error' => 'could not add a new item !', 'NOP' => $this->getNumberOFProductsWithInTheCart()]);

        }

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
    public function SetOrder($order, $cart): Order
    {
        if (count($order) == 0/*||$cart->order->first()->state == 0*/) {
            $order = $this->NewOrder($cart);
        } else {
            $order = $cart->orders()->orderByDesc('updated_at')->first();
            if ($order->state === 0) {
                $order = $this->NewOrder($cart);
            }
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
        for ($i = 0; $i < $Qty; $i++) {
            if ($product && !$product->available) {
                $product = Product::where('available', '=', 1)->where('code', '=', $product->code)->first();
            }
            if ($product) {

                /*  $item->products_ids */
                $productsIds[] = $product->id;

                $product->available = 0;
                $product->save();
                $ctr++;
            }
        }
        if ($ctr > 0) {
            $item = new item;
            $item->product_id = $FirstProduct->id;
            $item->products_ids = serialize($productsIds);
            $item->price = (double)$ctr * (double)$FirstProduct->price;
            $item->description = "" . $ctr . " of " . $FirstProduct->category->name . " / code :" . $FirstProduct->code;

            $order->items()->save($item);
            return true;
        }


        return false;
    }

    protected function getNumberOFProductsWithInTheCart()
    {
        if(Auth::check() && Auth::user()->membership === "customer"&&null !== Auth::user()->cart &&null !==Auth::user()->cart->orders) {
            return count(Auth::user()->cart->orders()->first()->items);
        }
        return 0;
    }

    /**
     * @return mixed
     */
    public function GetAllItems()
    {
        return Auth::user()->cart->orders()->first()->items;
    }
    public function TotallPrice(){
        $items = $this->GetAllItems();
        $totall_price =0.0;
        foreach ($items as  $item){
            $totall_price +=$item->price;
        }
        return  $totall_price;
    }
}
