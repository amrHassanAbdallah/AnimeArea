<div class="col-md-4">

    @if(count($Notifications)>0)
        @foreach($Notifications as $notification)

            <div class="alert alert-{{($notification->type==="order")?"secondary":($notification->type==="shipment_state")?"warning":"success"}} text-center">  a new {{$notification->type}} there  <a href="{{route('notification.single',$notification->id)}}">read more >></a></div>
        @endforeach
        @else
        <div class="alert alert-info text-center">  No Notifications yet </div>
    @endif


</div>