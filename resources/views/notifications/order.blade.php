@extends('layouts.app')
@section('content')


    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Order details</div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                    <th>
                        User name
                    </th>
                    <th>
                        Description
                    </th>

                  {{--  <th>
                        Delete
                    </th>--}}
                    </thead>
                    <tbody>

                        <tr>
                            <td>{{$customer->name}}</td>
                            <td>{{$order->description}}</td>

                         {{--   <td>

                                {!! Form::open(['action' =>['ProductsController@destroy',$product->id],'method'=>'DELETE']) !!}
                                {{Form::submit('Delete',['class'=>'btn btn-xs btn-danger'])}}
                                {!! Form::close() !!}
                            </td>--}}

                        </tr>
                        {!! Form::open(['action' =>['OrderssController@state',$order->id],'method'=>'POST']) !!}
                        {{Form::submit('Ship Now',['class'=>'btn btn-xs btn-success'])}}
                        {!! Form::close() !!}


                    </tbody>
                </table>



            </div>

        </div>

    </div>
@endsection