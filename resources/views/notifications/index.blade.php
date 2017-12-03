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
                       <li class="list-group-item">at <h7 class="text-justify text-success">{{$notification->created_at->diffForHumans()}}  </h7>

                           <h7 class="text-justify text-success">{{($notification->saw)?'an old':'a new'}}</h7>



                           {{$notification->type}}     <a href="{{route('notification.single',$notification->id)}}">read more >></a></li>
                       @endforeach
               </ul>
            </div>
        </div>
    </div>
@endsection