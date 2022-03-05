<div class="side-cart">
    <div class="side-cart-innar">

        <button class="btn side-cart-close-btn"><i class="fas fa-times"></i></button>

        <div class="header">
            <h2>Your Cart</h2>
            @if(count(\Cart::content())>0)
                <form action="{{ route('cart.clear') }}" method="POST">
                    {{ csrf_field() }}
            <button class="btn">Empty</button>
                </form>
            @endif
        </div>


        <div class="in-cart">

            <div class="alert alert-warning alert-dismissible fade show coupon_alert" role="alert" style="display: none">
             <p id="message"></p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            @if(session()->has('success_msg'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('success_msg') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif
            @if(session()->has('alert_msg'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session()->get('alert_msg') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif
            @if(count($errors) > 0)
                @foreach($errors0>all() as $error)
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ $error }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                @endforeach
            @endif
            @if(\Cart::count()>0)
                <h5>{{ \Cart::count()}} Product(s) In Your Cart</h5><br>
            @else
                <h4>No Product(s) In Your Cart</h4><br>
                <div class="footeer-cart">
                    <div class="close-div">
                        <button class="btn close-btn">Continue Shopping</button>
                    </div>
                </div>

            @endif
            @foreach(\Cart::content()  as $item)

                <div class="product">
                    <div class="d-flex justify-center align-center">
                        <div class="product-img">
                            @if(isset($item->options->toArray()['image']))
                            <img src="{{$item->options->toArray()['image']}}" class="rounded-circle" alt="" width="63px" height="63px ">
                            @else
                            <img src="{{ $item->id['image_url'] }}" class="rounded-circle" alt="" width="63px" height="63px ">
                                @endif
                        </div>
                        <div class="product-info">
                            <h4>{{ $item->id['name'] }}</h4>
                            <div class="d-flex justify-content-between">
                                @if(isset($item->options->toArray()['size']))
                                <span class="size">{{$item->options->toArray()['size'] }}</span>
                                <span class="price">{{ $item->options->toArray()['price_size'] }} $</span>

                                    @elseif( isset($item->options->toArray()['pizza_size'][0]))
                                    <span class="size">{{ $item->options->toArray()['pizza_size'][0]['name'] }}</span>
                                    <span class="price">{{ $item->options->toArray()['pizza_size'][0]['price'] }} $</span>
                                    @else

                                    <span class="price">{{  $item->id['price'] }} $</span>
                                    @endif
                            </div>

                            @if(isset($item->options->toArray()['extras']))
                                @foreach($item->options->toArray()['extras']  as $extras)
                                    <div class="d-flex justify-content-between">
                                        <span class="size">{{ $extras['name'] ?? ''}}</span>
                                        <span class="price">{{$extras['price'] ?? ''}} $</span>
                                    </div>
                                @endforeach
                            @endif

                            @if(isset($item->options->toArray()['types']))
                                @foreach($item->options->toArray()['types'] as $extras)
                                    <div class="d-flex justify-content-between">
                                        <span class="size">{{ $extras['name'] }}</span>
                                        <span class="price">{{ $extras['price'] }} $</span>
                                    </div>
                                @endforeach
                            @endif
                            @if(isset($item->options->toArray()['instructions']))
                            <div class="d-flex justify-content-between">
                                <span class="size">Hint:</span>
                                <span class="price">{{$item->options->toArray()['instructions']}}</span>
                            </div>
                            @endif
                       </div>
                   </div>
                   <div class="d-flex justify-center align-center">

                       <div class="product-count">
                           <form action="{{ route('cart.update') }}" method="POST">
                               {{ csrf_field() }}
                               <div class="quantity">
                                   <input type="hidden" value="{{$item->rowId}}" id="id" name="id">
                                   <input type="button" value="-" class="btn minus">
                                   <input step="1" min="1" max="" value="{{ $item->qty }}"  id="quantity" name="quantity"  class="form-control text-center" size="4"
                                          inputmode="">
                                   <input type="button" value="+" class="btn plus">
                               </div>

                           <div class="d-flex justify-content-center align-items-center">
                               {{--@if( $item->options)--}}
                               <span class="total-price">{{ $item->qty * $item->price}}$</span>

                                   {{--@elseif($item->attributes->types)--}}
                                       {{--<span class="total-price"> {{ $item->qty * $item->price}}$</span>--}}
                                   {{--@else--}}
                                   {{--<span class="total-price"> {{ $item->qty * $item->price}}$</span>--}}
                               {{--@endif--}}
                               <div class="product-close">
                                   <button class="btn"><i class="fas fa-edit"></i></button>
                               </div>
                           </div>

                           </form>
                       </div>

                       <div class="product-close">

                           <form action="{{ route('cart.remove') }}" method="POST">
                               {{ csrf_field() }}
                               <input type="hidden" value="{{ $item->rowId }}" id="id" name="id">
                               <button class="btn"><i class="fas fa-times"></i></button>
                           </form>
                       </div>
                   </div>
               </div>
           @endforeach
       </div>
       @if(count(\Cart::content())>0)
            <div class="footeer-cart">
                @if(!empty(session()->get('couponAmount')))
                <div class="d-flex justify-content-start align-items-center">

                    <div class="padding">
                        <span class="label">Subtotal:</span>
                        <span class="price">{{\Cart::total()}}$</span>
                    </div>
                    <div class="padding padding-2">
                        <span class="label">Total:</span>
                        <span class="price total">{{session()->get('couponAmount')}}$</span>
                    </div>
                </div>
                @else
                    <div class="d-flex justify-content-start align-items-center">
                        <div class="padding padding-2">
                            <span class="label">Total:</span>
                            <span class="price total">{{\Cart::total()}}$</span>
                        </div>
                    </div>

                    @endif
                <div class="coupon">
                    {{--<form class="form-inline" id="applyCoupon"  action="" method="post">--}}
                    <form class="form-inline" id="applyCoupon"  action="" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" name="coupon_code" class="form-control" placeholder="Coupon Code">
                        </div>
                        <button type="submit" id="submit_applyCoupon" class="btn">APPLY</button>
                    </form>
                    <a href="{{route('cart.checkout')}}">CHECKOUT</a>
                </div>
                <div class="close-div">
                    <button class="btn close-btn">Continue Shopping</button>
                </div>
            </div>

       @endif
   </div>
</div>
