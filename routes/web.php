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