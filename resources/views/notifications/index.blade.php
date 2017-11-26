@extends('layouts.app')
@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                Notifications
            </div>
            <div class="panel-body">
               <ul class="list-group">
                   @foreach($Notifications as $notification)
                       <li class="list-group-item">at <h7 class="text-justify text-success">{{$notification->created_at->diffForHumans()}}  </h7>{{$notification->content}}</li>
                       @endforeach
               </ul>
            </div>
        </div>
    </div>
@endsection