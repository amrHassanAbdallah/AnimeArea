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
    Route::delete('/Orders/{id}', [
        'uses'=>'OrdersController@destroy',
        'as'=>'order.delete'
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

    Route::post('/pay/{id}',["uses"=>"PaymentsController@buy","as"=>"pay"]);
    Route::get('/payment/history',["uses"=>"PaymentsController@index","as"=>"payment.history"]);
    Route::get('/withdraw/{id}',["uses"=>"PaymentsController@withdraw","as"=>"withdraw"]);
    Route::post('/withdraw/{id}',function ($id,\Illuminate\Http\Request $request){
        dd($request);
    }
        );


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