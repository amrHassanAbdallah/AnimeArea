@extends('layouts.front')

@section('page')
    <div class="container-fluid">
        <div class="row bg-border-color medium-padding120">
            <div class="container">
                <div class="row">

                    <div class="col-lg-12">

                        <div class="cart">

                            <h1 class="cart-title">In Your Shopping Cart: <span class="c-primary"> {{$NOP}} items</span></h1>

                        </div>

                        <div  class="cart-main">

                            <table class="shop_table cart">
                                <thead class="cart-product-wrap-title-main">
                                <tr>
                                    <th class="product-remove">&nbsp;</th>
                                    <th class="product-thumbnail">description</th>
                                    <th class="product-quantity">product url</th>
                                    <th class="product-subtotal">Total</th>
                                    <th class="product-subtotal">decorator</th>
                                </tr>
                                </thead>
                                <tbody>
                            @if($items)
                                @foreach($items as $item)
                                <tr class="cart_item">

                                    {!!Form::open(['action'=>['CustomerController@remove','id'=>$item->id],'method'=>'delete'])  !!}
                                    <td class="product-remove">
                                        <button style="background-color: transparent;" type="submit" {{--href="{{route('cart.remove',$item->id)}}"--}} class="product-del remove" title="Remove this item">
                                            <i class="seoicon-delete-bold"></i>

                                        </button>
{{--
                                        {{Form::hidden('_method','DELETE')}}
--}}

                                    </td>
                                    {!! Form::close() !!}

                                    <td class="product-thumbnail">

                                        <div class="cart-product__item">

                                            <div class="cart-product-content">
                                                <p class="cart-author">{{$item->description}}</p>
{{--
                                                <h5 class="cart-product-title">Search Marketing</h5>
--}}
                                            </div>
                                        </div>
                                    </td>

                                   {{-- <td class="product-price">
                                        <h5 class="price amount">$58.00</h5>
                                    </td>--}}

                                    <td class="product-quantity">

                                        <a  style="padding: 15px;" href="{{route('product.single',$item->product_id)}}">Product info
                                            {{-- <img src="../public/app/img/cart-product4.png" alt="product" class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image">--}}
                                        </a>

                                    </td>

                                    <td class="product-subtotal">
                                        <h5 class="total amount">${{$item->price}}</h5>
                                    </td>
                                    <td>
                                 {{--       {!!Form::open(['action'=>['CustomerController@addDecorator','id'=>$item->id,'option'=>1],'method'=>'post'])  !!}
                                        <button class="btn-xs btn-default " style="margin-bottom: 10px">add color</button>
                                        {!! Form::close() !!}

                                        {!!Form::open(['action'=>['CustomerController@addDecorator','id'=>$item->id,'option'=>2],'method'=>'post'])  !!}
                                        <button class="btn-xs btn-default" style="margin-bottom: 10px">add name</button>
                                        {!! Form::close() !!}--}}

                                        {!!Form::open(['action'=>['CustomerController@addDecorator','id'=>$item->id,'option'=>3],'method'=>'post'])  !!}
                                        <button class="btn-xs btn-default">add bag</button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>



@endforeach


                                <tr>
                                    @if($NOP)
                                  {{--  <td colspan="5" class="actions">


<div class="row">
    <div class="col-lg-4">
        <div class="coupon">
            --}}{{-- <h8 style="color: red">**Note**:  this products takes 4-6 days to deliver .</h8>
             <br>
             <h8 style="color: green">**Note**:  if you want to receive it after  2-4 days click     "Add premium delivery" button .</h8>--}}{{--
            <h8 style="color: green">**Note**:  if you want to add some custom such as      .</h8>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="btn btn-medium btn--dark btn-hover-shadow btn-holder">

            <span class="semicircle">

            </span>
        </div>

        <div class="btn btn-medium btn--dark btn-hover-shadow btn-holder">
            <span class="text">Add premium delivery </span>
            <span class="semicircle"></span>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="btn btn-medium btn--dark btn-hover-shadow btn-holder">
            <span class="text">Add premium delivery </span>
            <span class="semicircle"></span>
        </div>  <div class="btn btn-medium btn--dark btn-hover-shadow btn-holder">
            <span class="text">Add premium delivery </span>
            <span class="semicircle"></span>
        </div>

    </div>

</div>


                                    </td>--}}
                                        @endif
                                </tr>
                                @endif

                                </tbody>
                            </table>


                        </div>
                        @if($NOP)
                        <div class="cart-total">
                            <h3 class="cart-total-title">Cart Totals</h3>
                            <h5 class="cart-total-total">Total: <span class="price">{{$totall_price}}</span></h5>
                            <a href="{{route('checkout')}}" class="btn btn-medium btn--light-green btn-hover-shadow">
                                <span class="text">Checkout</span>
                                <span class="semicircle"></span>
                            </a>
                        </div>
                            @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
    @endsection