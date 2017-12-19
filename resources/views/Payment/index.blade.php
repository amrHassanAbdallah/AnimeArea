@extends('layouts.app')
@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                Payment History
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                    <th>
                      amount
                    </th>
                    <th>
                        description
                    </th>
                    <th>
                        since
                    </th>
                    <th>
                        Order details
                    </th>



                    </thead>
                    <tbody>
                    @foreach($payments   as $payment)
                        <tr>
                            <td>{{$payment->amount}}</td>
                            <td>{{$payment->description}}</td>
                            <td>{{$payment->created_at->diffForHumans()}}</td>
                            <td><a href="{{route("Orders.single",$payment->order_id)}}"> here</a></td>


                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection