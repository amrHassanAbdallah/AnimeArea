@extends('layouts.front')

@section('page')
    <div class="container">
        <div class="row medium-padding120">
            <div class="product-details">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                    <div class="product-details-thumb">
                        <div class="swiper-container" data-effect="fade">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                                <!-- Slides -->
                                <div class="product-details-img-wrap swiper-slide">
                                    <img src="{{asset($product->image)}}" alt="product" data-swiper-parallax="-10">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-6 col-lg-offset-1 col-md-6 col-md-offset-1 col-sm-6 col-sm-offset-1 col-xs-12 col-xs-offset-0">
                    <div class="product-details-info">
                        <div class="product-details-info-price">${{$product->price}}</div>
                        <h3 class="product-details-info-title" style="<?php if(!$product->available){echo "color:red";} ?>">{{$product->name}}</h3>
                        <?php if(!$product->available){

                        ?>
                        <p class="product-details-info-text " style="color: red">

                            **Please note** : this product is no longer available but we can make sure to get a similar product if you clicked add to cart .
                        </p>
                        <?php
                        }
                        ?>
                        <p class="product-details-info-text">

                            {{$product->description}}
                        </p>
                        {!! Form::open(['action' =>['CustomerController@store','id'=>$product->id],'method'=>'post' ,'class'=>'form-group']) !!}
                        <div class="quantity">
                            <a href="#" class="quantity-minus">-</a>
                            <input title="Qty" name="Qty" class="email input-text qty text" type="text" value="1">
                            <a href="#" class="quantity-plus">+</a>
                        </div>

                        <button type="submit"  class="btn btn-medium btn--primary">
                            <span class="text">Add to Cart</span>
                            <i class="seoicon-commerce"></i>
                        </button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection