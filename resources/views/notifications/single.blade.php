@extends('layouts.app')
@section('content')


    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Notification</div>
            <div class="panel-body">
                <p class="text-info text-center">{{$notification->content}}</p>

            </div>

        </div>

    </div>
@endsection