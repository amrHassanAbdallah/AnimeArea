<!DOCTYPE html>
<html lang="en">
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>AnimeArea - Shop</title>

    <link rel="stylesheet" type="text/css" href="{{asset('app/css/fonts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app/css/crumina-fonts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app/css/normalize.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app/css/grid.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app/css/styles.css')}}">


    <!--Plugins styles-->

    <link rel="stylesheet" type="text/css" href="{{asset('app/css/jquery.mCustomScrollbar.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app/css/swiper.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app/css/primary-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app/css/magnific-popup.css')}}">

    <!--Styles for RTL-->

    <!--<link rel="stylesheet" type="text/css" href="css/rtl.css')}}">-->

    <!--External fonts-->

    <link href='https://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
    <style>
        .alert{
            color: white;
            padding: 80px;
            text-align: center;
        }
        .alert-danger{
            background: red;
        }
        .alert-success{
            background: green;
        }
        .btn-holder{
            margin-bottom: 10px;
        }
    </style>
</head>


<body class=" ">

<header class="header" id="site-header">

    <div class="container">

        <div class="header-content-wrapper">

            <ul class="nav-add">
                &nbsp;@if(Auth::check() && Auth::user()->membership === "customer")
                <li style="margin-right: 10px">
                    <a href="{{route('index')}}" >
                        <i ></i>

                            <span>Home</span>

                    </a>

                </li>
                @endif

                @if(Auth::check())
                    <li style="margin-right: 10px">
                        <a href="{{route('home')}}" >
                            <i ></i>

                            <span>Dashboard</span>

                        </a>

                    </li>
                    @endif

                @guest
                    <li style="margin-right: 10px">
                        <a href="{{route('login')}}" >
                            <i ></i>

                                <span>login</span>

                        </a>

                    </li>
                    <li style="margin-right: 10px">
                        <a href="{{route('register')}}" >
                            <i ></i>

                            <span>register</span>

                        </a>

                    </li>
                    @endguest


                <li class="cart">

                    <a href="#" class="js-cart-animate">
                        <i class="seoicon-basket"></i>
                        &nbsp;@if(Auth::check() && Auth::user()->membership === "customer")
                            <span class="cart-count"><?php echo $NOP ?></span>
                        @endif
                    </a>

                    <div class="cart-popup-wrap">
                        <div class="popup-cart">
                            &nbsp;@if($NOP>0)
                                <h4 class="title-cart">{{$NOP}} in the cart!</h4>
                                <a href="{{route('cart')}}">
                                <div class="btn btn-small btn--dark">
                                   <span class="text">Check out</span>
                                </div>
                                </a>
                            @else
                                <h4 class="title-cart">No products in the cart!</h4>

                                <p class="subtitle">Please make your choice.</p>
                                <div class="btn btn-small btn--dark">
                                    <span class="text">view all catalog</span>
                                </div>
                            @endif

                        </div>
                    </div>

                </li>

            </ul>
        </div>

    </div>

</header>