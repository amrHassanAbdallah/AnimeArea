@extends('layouts.app')
@section('content')


    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Edit a  category</div>
            <div class="panel-body">

                {!! Form::open(['action' =>['CategoriesController@update','id'=>$category->id],'method'=>'PUT' ,'class'=>'form-group','enctype'=>'multipart/form-data']) !!}
                <div class="form-group">
                    {{Form::label('name','name')}}
                    {{Form::text('name',$category->name,['class'=>'form-control','placeholder'=>'name'])}}
                </div>

                {{Form::submit('Update',['class'=>'form-control btn btn-success'])}}
                {!! Form::close() !!}


            </div>

        </div>

    </div>
@endsection