@extends('layouts.front')

@section('page')
    <div class="container">
        <div class="row pt120">
            <div class="books-grid">
                @if(count($Products) >0)
                <div class="row mb30">
                    @foreach($Products as $product)
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="books-item">
                            <div class="books-item-thumb">
                                <img src="{{asset($product->image)}}" alt="book">
                                <div class="new">New</div>
                                <div class="sale">Sale</div>
                                <div class="overlay overlay-books"></div>
                            </div>

                            <div class="books-item-info">
                                <a href="{{route('product.single',['id'=>$product->id])}}">
                                    <h5 class="books-title">{{$product->name}}</h5>

                                </a>

                                <div class="books-price">${{$product->price}}</div>
                            </div>

                           {{-- <a href="19_cart.html" class="btn btn-small btn--dark add">
                                <span class="text">Add to Cart</span>
                                <i class="seoicon-commerce"></i>
                            </a>--}}

                        </div>
                    </div>
                        @endforeach
                </div>

                <div class="row pb120">
                    <div class="col-lg-12"> {{ $Products->links() }}
                    </div>
                    <div class="col-lg-12">


                    </div>

                </div>
                @else
                    <h3 class="text-center">Stay toned new products will be added soon .</h3>
                @endif
            </div>
        </div>
    </div>
    @endsection