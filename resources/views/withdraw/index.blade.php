@extends('layouts.app')
@section('content')


    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Complete your <span class="text-success">${{$wallet->amount}}</span> withdrawal with</div>
            <div class="panel-body">

                {!! Form::open(['action' =>['PaymentsController@withdraw',$wallet->id],'method'=>'POST' ,'class'=>'form-group']) !!}
             @include('Payment.SelectForm')
            </div>
                {{Form::submit('withdraw',['class'=>'form-control btn btn-success'])}}
                {!! Form::close() !!}


            </div>

        </div>

    </div>
@endsection