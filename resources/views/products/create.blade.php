@extends('layouts.app')
@section('content')


    <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">Create a new product</div>
        <div class="panel-body">

            {!! Form::open(['action' =>'ProductsController@store','method'=>'POST' ,'class'=>'form-group','enctype'=>'multipart/form-data']) !!}
            <div class="form-group">
                {{Form::label('name','name')}}
                {{Form::text('name',old('name'),['class'=>'form-control','placeholder'=>'name'])}}
            </div>
            <div class="form-group">
                {{Form::label('code','code')}}
                {{Form::text('code',old('code'),['class'=>'form-control','placeholder'=>'code'])}}
            </div>
            <div class="form-group">
                {{Form::label('price','price')}}
                {{Form::text('price',old('price'),['class'=>'form-control','placeholder'=>'price'])}}
            </div>
            <div class="form-group">
                {{Form::label('description','description')}}
                {{Form::textarea('description',old('description'),['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Description'])}}
            </div>
            <div class="form-group">

                    <select class="form-control" name="category" >
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                    </select>

            </div>
            <div class="form-group">
<div class="form-control">

    {{Form::file('image')}}
</div>
            </div>
            {{Form::submit('Create',['class'=>'form-control btn btn-success'])}}
            {!! Form::close() !!}


        </div>

    </div>

</div>
@endsection