<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function single($id)
    {
        $notification = Notification::find($id);
        if(!$notification->saw){
            $notification->saw = 1;
            $notification->save();
        }

        return view('notifications.single')->with('notification',Notification::find($id));
    }


    public function all()
    {
        return view('notifications.index')->with('Notifications',Auth::user()->Notification);
    }
}
