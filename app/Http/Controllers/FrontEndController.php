<?php

namespace App\Http\Controllers;

use App\classes\LogHandler;
use App\classes\Loginnn;
use App\Listeners\EmailNotifier;
use App\Product;
use App\User;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontEndController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(/*Dispatcher $dispatcher*/)
    {
        $NOP = 0;
        if(Auth::check() && Auth::user()->membership === "customer"&&null !== Auth::user()->cart &&null !==Auth::user()->cart->orders){
            $NOP = count(Auth::user()->cart->orders()->first()->items);
        }
        /*$dispatcher->fire('UserHasLoggedIn');*/
/*        $login = new Loginnn();
        $login->attach([new \App\classes\EmailNotifier(),new LogHandler()]);
        $login->fire();*/
        return view('index',['Products'=>Product::where('available','=','1')->paginate(3),'NOP'=>$NOP]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function single($id)
    {
        $product = Product::find($id);
        $NOP = 0;
        if(Auth::check() && Auth::user()->membership === "customer"&&null !== Auth::user()->cart &&null !==Auth::user()->cart->orders){              
            $NOP = count(Auth::user()->cart->orders()->first()->items);
        }
        return view('single')->with(['product'=>$product,'NOP'=>$NOP]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
