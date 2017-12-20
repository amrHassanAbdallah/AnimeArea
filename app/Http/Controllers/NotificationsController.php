<?php

namespace App\Http\Controllers;

use App\Notification;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function single($id)
    {
        $notification = Notification::find($id);
        if(!$notification){
            return redirect()->back()->with("error","the refrenced topic isn't there anymore ");
        }
        if(!$notification->saw){
            $notification->saw = 1;
            $notification->save();
        }
       if($notification->type === "order" ){
           $order = Order::find((int)$notification->content);
           if(!$order){
               return redirect()->back()->with("error","the refrenced topic isn't there anymore ");
           }
           return view('notifications.order')->with(['order'=>$order,'customer'=>$order->getUser()]);
       }

        return view('notifications.single')->with('notification',$notification);
    }


    public function all()
    {
        return view('notifications.index')->with('Notifications',Auth::user()->Notification);
    }
}
