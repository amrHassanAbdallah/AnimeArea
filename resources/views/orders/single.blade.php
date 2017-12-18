@extends('layouts.app')
@section('content')


    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Order details</div>
            <div class="panel-body">
                <table class="table">
                    <thead>
{{--                    <th>
                        User name
                    </th>--}}
                    <th>
                        Description
                    </th>
<th>active</th>
<th>Shipment state</th>
                    {{--  <th>
                          Delete
                      </th>--}}
                    </thead>
                    <tbody>

                    <tr>
                        <td>{{$order->description}}</td>
                        <td>{{$order->state}}</td>
                        <td>{{$order->shipment_state}}</td>

                        {{--   <td>

                               {!! Form::open(['action' =>['ProductsController@destroy',$product->id],'method'=>'DELETE']) !!}
                               {{Form::submit('Delete',['class'=>'btn btn-xs btn-danger'])}}
                               {!! Form::close() !!}
                           </td>--}}

                    </tr>



                    </tbody>
                </table>
                @if($order->state&& Auth::user()->membership === "Seller" )
                    <div class="text-center">
                        {!! Form::open(['action' =>['OrdersController@state',$order->id],'method'=>'POST']) !!}

                        {{Form::submit('Ship Now',['class'=>'form-control btn  btn-success'])}}
                        {!! Form::close() !!}

                    </div>
                @endif
                @if(!$order->state && Auth::user()->membership === "Seller" &&($order->shipment_state === "In progress" || $order->shipment_state === "On Hold"))
                    <div class="text-center">
                        {!! Form::open(['action' =>['OrdersController@state',$order->id],'method'=>'POST']) !!}
                        <select  name="shipment_state"  class="form-control form-group">
                            <option value="In progress" @if($order->shipment_state === "In progress")selected @endif>In progress</option>
                            <option value="On Hold" @if($order->shipment_state === "On Hold")selected @endif>On Hold</option>
                            <option value="Delivered" @if($order->shipment_state === "Delivered")selected @endif>Delivered</option>
                        </select>
                        {{Form::submit('Update',['class'=>'form-control btn  btn-success'])}}
                        {!! Form::close() !!}

                    </div>
                @endif

            </div>

        </div>

    </div>
@endsection