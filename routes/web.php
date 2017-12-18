<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\classes\Checkout;

Route::get('/', [
        'uses' => 'FrontEndController@index',
        'as' => 'index'
    ]
);

Route::get('/product/{id}',
    [
        'uses' => 'FrontEndController@single',
        'as' => 'product.single'
    ]);


Route::get('/checkout',[
    'uses' =>'CustomerController@checkout',
    'as' =>'checkout'
]);
Route::post('/decorator/{id}/{option}',[
    'uses' =>'CustomerController@addDecorator',
    'as' =>'decorator'
]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*Route::resource('products', 'ProductsController')->middleware('admin');*/
/*Route::resource('/','FrontEndController');*/

Route::middleware(['auth', 'Seller'])->group(function () {
    Route::resource('products', 'ProductsController');
    Route::resource('category', 'CategoriesController');
    Route::post('/orderState/{id}',[
        'uses' =>'OrdersController@state',
        'as' =>'Order.confirmation'
    ]);
});

Route::middleware('auth')->group(function (){
    Route::get('/notification/{id}',[
        'uses' =>'NotificationsController@single',
        'as' => 'notification.single'
    ]);
    Route::get('/notification/',[
        'uses' =>'NotificationsController@all',
        'as' => 'notification'
    ]);
    Route::get('/Orders/',[
        'uses' =>'OrdersController@index',
        'as' => 'Orders.index'
    ]);
    Route::get('/Orders/{id}',[
        'uses' =>'OrdersController@single',
        'as' => 'Orders.single'
    ]);

    Route::post('/pay/{id}',function ($id,\Illuminate\Http\Request $request){
        if(!isset($request->PaymentWay)){
            return redirect()->back()->with("error","Payment gate way required !!");
        }
        if($request->PaymentWay == "paypal"){
            $PaymentStrategy = new \App\classes\PaypalStrategy(\Illuminate\Support\Facades\Auth::user()->email,"123456789");

        }elseif ($request->PaymentWay == "CreditCard"){
            $PaymentStrategy = new \App\classes\CreditCardStrategy(\Illuminate\Support\Facades\Auth::user()->name,"visa","1234","2017/9");

        }
        $order = \App\Order::find($id);

        $feedBackArray = ["success"=>"Your item(s) shall be delievered soon enough .",
            "error"=>"Please try again later ! ."];
        $state =  ($PaymentStrategy->pay((new \App\classes\Tax($order))->getCost()))?"success":"error";
        if($state === "success"){
            $order->is_paied = 1;
            $order->save();
            $checkOut = new Checkout();
            $checkOut->attach([new \App\classes\CheckoutNotifier()]);
            $checkOut->fire();

        }
        return redirect()->back()->with($state,$feedBackArray[$state]);
    })->name('pay');

});

Route::middleware([ 'customer'])->group(function () {
    Route::get('/cart', [
            'uses' => 'CustomerController@cart',
            'as' => 'cart'
        ]
    );
    Route::post('/cart/store/{id}', [
            'uses' => 'CustomerController@store',
            'as' => 'cart.store'
        ]
    );
    Route::delete('/cart/{id}/remove', [
            'uses' => 'CustomerController@remove',
            'as' => 'cart.remove'
        ]
    );
});