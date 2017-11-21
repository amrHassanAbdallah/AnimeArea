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
                        Edit
                    </th>
                    <th>
                        Delete
                    </th>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$category->name}}</td>
                            <td><a href="{{route('category.edit',$category->id)}}" class="btn btn-xs btn-default">Edit</a></td>
                            <td>

                                {!! Form::open(['action' =>['CategoriesController@destroy',$category->id],'method'=>'DELETE']) !!}
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