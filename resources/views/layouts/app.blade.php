<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{config('app.name','AnimeArea')}}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;@if(Auth::check() && Auth::user()->membership === "Seller")

{{--
                            <li><a href="{{ route('register') }}">Register</a></li>
--}}
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    Products <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('products.index') }}">View Products</a></li>
                                    <li><a href="{{ route('products.create') }}">Create Products</a></li>
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    Categories <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('category.index') }}">View Categories</a></li>
                                    <li><a href="{{ route('category.create') }}">Create Categories</a></li>
                                </ul>
                            </li>
                       @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="{{ Request::is('home') ? "active" : '' }}" ><a href="{{route('home')}}">dashboard</a></li>
                            <li class="{{ Request::is('notification') ? "active" : '' }}" ><a href="{{route('notification')}}">notifications</a></li>
                                <li class="{{ Request::is('Orders') ? "active" : '' }}" ><a href="{{route('Orders.index')}}">Orders</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>

                               {{-- &nbsp;@if(Auth::check() && Auth::user()->membership === "Seller")--}}
                                    <li class="dropdown" style="background-color: green;color: white;border-radius: 10px;">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"  style="color: white" role="button" aria-expanded="false" aria-haspopup="true">
                                            <?php $wallet = \App\Wallet::find(\Illuminate\Support\Facades\Auth::user()->id);
                                            $amount = (($wallet))?$wallet->amount:"0.00";
                                            ?>
                                            <span >$ {{(float)$amount}}</span>

                                            <span class="caret"></span>
                                        </a>

                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="{{ route('payment.history') }}">
                                                    Payment history
                                                </a>
                                                @if($amount > 0)
                                                <a href="{{ route('withdraw',$wallet->id) }}">
                                                    withdraw
                                                </a>
                                                    @endif

                                            </li>
                                        </ul>
                                    </li>
                                          {{--@endif--}}
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @include('inc.feedback')
        @yield('content')

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
    <script>
    CKEDITOR.replace( 'article-ckeditor' );
    </script>
</body>
</html>
