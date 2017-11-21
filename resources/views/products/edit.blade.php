@extends('layouts.app')
@section('content')


    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Edit : {{$product->name}}</div>
            <div class="panel-body">

                {!! Form::open(['action' =>['ProductsController@update',$product->id],'method'=>'PUT' ,'class'=>'form-group','enctype'=>'multipart/form-data']) !!}
                <div class="form-group">
                    {{Form::label('name','name')}}
                    {{Form::text('name',$product->name,['class'=>'form-control','placeholder'=>'name'])}}
                </div>
                <div class="form-group">
                    {{Form::label('code','code')}}
                    {{Form::text('code',$product->code,['class'=>'form-control','placeholder'=>'code'])}}
                </div>
                <div class="form-group">
                    {{Form::label('price','price')}}
                    {{Form::text('price',$product->price,['class'=>'form-control','placeholder'=>'price'])}}
                </div>
                <div class="form-group">
                    {{Form::label('description','description')}}
                    {{Form::textarea('description',$product->description,['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Description'])}}
                </div>

                <div class="form-group">

                    <select class="form-control" name="category" value="{{$product->category_id}}" >
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" @if($product->category_id ==$category->id) selected @endif>{{$category->name}}</option>
                        @endforeach
                    </select>

                </div>

                <div class="form-group">
                    <div class="form-control">

                        {{Form::file('image')}}
                    </div>
                </div>
                {{Form::submit('Update',['class'=>'form-control btn btn-success'])}}
                {!! Form::close() !!}


            </div>

        </div>

    </div>
@endsection