@extends('layouts.app')
@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                Notifications
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    @foreach($orders as $order)
                        @if(($order->getUser())->id === Auth::user()->id || Auth::user()->membership == "Seller")
                        <li class="list-group-item">Order Id: <h7 class="text-capitalize text-danger">#{{$order->id}}</h7> created   at <h7 class="text-justify text-success">{{$order->created_at->diffForHumans()}}  </h7>


                            updated   at <h7 class="text-justify text-success">{{$order->updated_at->diffForHumans()}}  </h7>


  <a href="{{route('Orders.single',$order->id)}}"> order details >></a></li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection