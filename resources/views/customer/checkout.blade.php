@extends('layouts.front')
@section('page')
    <div class="container-fluid">
        <div class="row medium-padding120 bg-border-color">
            <div class="container">

                <div class="row">

                    <div class="col-lg-12">
                        <div class="order">
                            <h2 class="h1 order-title text-center">Your Order</h2>
                            <form action="#" method="post" class="cart-main">
                                <table class="shop_table cart">
                                    <thead class="cart-product-wrap-title-main">
                                    <tr>
                                        <th class="product-thumbnail">Order description</th>


                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr class="cart_item">

                                        <td class="product-thumbnail">

                                            <div class="cart-product__item">
                                                <div class="cart-product-content">
                                                    <h5 class="cart-product-title">{{$order->description}}</h5>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>


                                    <tr class="cart_item subtotal">

                                        <td class="product-thumbnail">


                                            <div class="cart-product-content">
                                                <h5 class="cart-product-title">	Subtotal:</h5>
                                            </div>


                                        </td>

                                        <td class="product-quantity">

                                        </td>

                                        <td class="product-subtotal">
                                            <h5 class="total amount">${{$order->price}}</h5>
                                        </td>
                                    </tr>

                                    <tr class="cart_item total">

                                        <td class="product-thumbnail">


                                            <div class="cart-product-content">
                                                <h5 class="cart-product-title">Total:</h5>
                                            </div>


                                        </td>

                                        <td class="product-quantity">

                                        </td>

                                        <td class="product-subtotal">
                                            <h5 class="total amount">${{$order->price}}</h5>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>

                                <div class="cheque">

                                    <div class="logos">
                                        <a href="#" class="logos-item">
                                            <img src="../public/app/img/visa.png" alt="Visa">
                                        </a>
                                        <a href="#" class="logos-item">
                                            <img src="../public/app/img/mastercard.png" alt="MasterCard">
                                        </a>
                                        <a href="#" class="logos-item">
                                            <img src="../public/app/img/discover.png" alt="DISCOVER">
                                        </a>
                                        <a href="#" class="logos-item">
                                            <img src="../public/app/img/amex.png" alt="Amex">
                                        </a>

                                        <span style="float: right;">
								<form action="/your-server-side-code" method="POST">
									  <script
                                              src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                              data-key="pk_test_6pRNASCoBOKtIshFeQd4XMUh"
                                              data-amount="999"
                                              data-name="Stripe.com"
                                              data-description="Widget"
                                              data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                                              data-locale="auto"
                                              data-zip-code="true">
									  </script>
								</form>
							</span>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @endsection