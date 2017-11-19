@extends('layouts.app')
@section('content')
<div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">
            products
        </div>
        <div class="panel-body">
            <table class="table">
                <thead>
                <th>
                    name
                </th>
                <th>
                    Price
                </th>
                <th>
                    Edit
                </th>
                <th>
                    Delete
                </th>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{$product->name}}</td>
                            <td>{{$product->price}}</td>
                            <td><a href="{{route('products.edit',$product->id)}}" class="btn btn-xs btn-default">Edit</a></td>
                       <td>

                           {!! Form::open(['action' =>['ProductsController@destroy',$product->id],'method'=>'DELETE']) !!}
                           {{Form::submit('Delete',['class'=>'btn btn-xs btn-danger'])}}
                           {!! Form::close() !!}
                       </td>

                        </tr>

                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
    @endsection