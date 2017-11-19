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

                                </tr>
@endforeach


                                <tr>
                                    <td colspan="5" class="actions">

                                        <div class="coupon">
                                            <input name="coupon_code" class="email input-standard-grey" value="" placeholder="Coupon code" type="text">
                                            <div class="btn btn-medium btn--breez btn-hover-shadow">
                                                <span class="text">Apply Coupon</span>
                                                <span class="semicircle--right"></span>
                                            </div>
                                        </div>

                                        <div class="btn btn-medium btn--dark btn-hover-shadow">
                                            <span class="text">Apply Coupon</span>
                                            <span class="semicircle"></span>
                                        </div>

                                    </td>
                                </tr>
                                @endif

                                </tbody>
                            </table>


                        </div>

                        <div class="cart-total">
                            <h3 class="cart-total-title">Cart Totals</h3>
                            <h5 class="cart-total-total">Total: <span class="price">{{$totall_price}}</span></h5>
                            <a href="20_checkout.html" class="btn btn-medium btn--light-green btn-hover-shadow">
                                <span class="text">Checkout</span>
                                <span class="semicircle"></span>
                            </a>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    @endsection