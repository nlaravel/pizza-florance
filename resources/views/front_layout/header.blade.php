<?php
$setting=\App\Setting::first();

?>
<section class="top-nav">
    <div class="container">
        <div class="innar-top-nav">
            <a href="{{route('front.index')}}" class="logo-side">
                <img src="{{$setting->logo_url}}" alt="" class="img-fluid">
            </a>
            <div class="item-side">
                <a  class="cart" onclick="openNav()">
                    <div class="d-flex justify-content-start align-items-center">
                        <div><i class="fas fa-shopping-basket"></i></div>
                        <div class="items-info">
                            <span class="items-number">{{ \Cart::count()}} Items</span>
                            <span class="items-price"> {{\Cart::total()}} $</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="right-side">
            <a onclick="openNav()" class=""><i class="fas fa-shopping-basket"></i></a>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link nav-link-special" href="{{route('front.build_your_pizza')}}">
                        <img src="{{asset('front-asset/assets/images/pizza-slice.png')}}" alt="" class="img-fluid mr-2">Build Your Pizza
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link hvr-underline-from-left {{ Route::currentRouteNamed( 'front.index' ) ?  'active' : '' }}" href="{{route('front.index')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link hvr-underline-from-left {{ Route::currentRouteNamed( 'front.contact_us' ) ?  'active' : '' }}" href="{{route('front.contact_us')}}">Contact us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link hvr-underline-from-left {{ Route::currentRouteNamed( 'product' ) ?  'active' : '' }}" href="{{route('product')}}">Order Now</a>
                </li>
                {{--<li class="nav-item">--}}
                    {{--<a class="nav-link hvr-underline-from-left" href="checkout.html">Payments</a>--}}
                {{--</li>--}}
                <li class="nav-item">
                    <a class="nav-link hvr-underline-from-left {{ Route::currentRouteNamed( 'front.terms_conditions' ) ?  'active' : '' }}" href="{{route('front.terms_conditions')}}">Terms &Conditions</a>
                </li>
            </ul>
        </div>
    </div>
</nav>