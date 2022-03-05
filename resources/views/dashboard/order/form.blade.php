@extends('dashboard_layout.main')
@push('style')
    <style>

    </style>
    <link rel="stylesheet" type="text/css" href="{{asset('admin-layout/app-assets/css/pages/app-ecommerce-shop.css')}}">

@endpush
@section('content')

<div class="ecommerce-application">



            <div class="content-body">
                <form action="#" class="icons-tab-steps checkout-tab-steps wizard-circle">
                    <!-- Checkout Place order starts -->

                    <fieldset class="checkout-step-1 px-0">
                        <section id="place-order" class="list-view product-checkout">
                            <div class="checkout-items">
                                <div class="card ecommerce-card">
                                    <div class="card" style="padding: 20px">

                                        <div class="card-body">
                                            <div class="price-details">
                                                <h4>Person Order Details</h4>
                                            </div>
                                            <div class="item-name">
                                                <h6> Full Name :  <span> {{$user->first_name}} {{$user->last_name}} </span></h6>
                                                <span></span>
                                                <p class="item-company"> <span class="company-name"></span></p>
                                                <p class="stock-status-in"> </p>
                                            </div>
                                            <div class="item-quantity">
                                                <p class="quantity-title">Phone : <span  style="color:#28C76F;"> {{$user->phone}}</span></p>
                                            </div>

                                            <div class="item-quantity">
                                                <p class="quantity-title">Email : <span  style="color:#7367F0;"> {{$user->email}}</span> </p>
                                            </div>

                                            @if( $user->city_id)
                                                <div class="item-quantity">
                                                    <p class="quantity-title">City  : <span  style="color:#28C76F;"> {{$user->cities?$user->cities->name:''}} </span></p>
                                                </div>
                                                <div class="item-quantity">
                                                    <p class="quantity-title">ZipCode  : <span  style="color:#7367F0;;"> {{$user->zip_code}} </span></p>
                                                </div>
                                                <div class="item-quantity">
                                                    <p class="quantity-title">Address 1  : <span  style="color:#28C76F;"> {{$user->address_1}} </span></p>
                                                </div>
                                                @if( $user->address_2)
                                                    <div class="item-quantity">
                                                        <p class="quantity-title">Address 2  : <span  style="color:#7367F0;"> {{$user->address_2}} </span></p>
                                                    </div>
                                                @endif
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <h6>  <span> His /Her Orders :</span></h6>

                            @foreach($orders as $order)
                                <div class="card ecommerce-card">
                                    <div class="card-content" style="padding: 20px">
                                        <div class="item-img text-center">
                                            <a href="">
                                                @if($order->products->image != null)
                                                <img src="{{$order->products->image_url}}" alt="img-placeholder" style="height: 100px; width: 100%; border-radius:50%">
                                                  @else
                                                <img src="{{asset('front-asset/assets/images/pizza-build.png')}}" alt="img-placeholder" style="height: 200px; width: 200px; border-radius:50%">

                                                @endif
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <div class="item-name">
                                                <a href="">{{$order->products->name}}</a>
                                                <span></span>
                                                <p class="item-company"> <span class="company-name"></span></p>
                                                <p class="stock-status-in"> </p>
                                            </div>
                                            <div class="item-quantity">
                                                <p class="quantity-title">Quantity : <span  style="color:#28C76F;"> {{$order->quantity}} Item</span></p>
                                            </div>
                                            @if( $order->OrderSpecialPizzaSize)
                                                @foreach( $order->OrderSpecialPizzaSize as $special)
                                                    <div class="item-quantity">
                                                        <p class="quantity-title">Size : <span  style="color:#7367F0;"> {{$special->size}}</span> </p>
                                                        <p class="quantity-title">Size Price : <span  style="color:#7367F0;"> {{$special->price}}</span> </p>
                                                    </div>


                                                @endforeach

                                                @endif
                                            @if( $order->OrderSpecialPizzaTypes)
                                                {{--<h4>Ingredients</h4>--}}
                                                @foreach( $order->OrderSpecialPizzaTypes as $special)
                                            <div class="item-quantity">
                                                <p class="quantity-title">{{$special->name}}  : <span  style="color:#28C76F;"> {{$special->price}} $</span></p>
                                            </div>
                                                @endforeach
                                                @endif
                                            @if( $order->OrderPizzaSize)
                                                @foreach( $order->OrderPizzaSize as $pizza_size)
                                                    <div class="item-quantity">
                                                        <p class="quantity-title">Size : <span  style="color:#7367F0;"> {{$pizza_size->size}}</span> </p>
                                                        <p class="quantity-title">Size Price : <span  style="color:#7367F0;"> {{$pizza_size->price}}</span> </p>
                                                    </div>


                                                @endforeach

                                            @endif
                                            @if( $order->OrderPizzaExtras)
                                                {{--<h4>Extras</h4>--}}
                                                @foreach( $order->OrderPizzaExtras as $pizza_extras)
                                                    <div class="item-quantity">
                                                        <p class="quantity-title">{{$pizza_extras->name}}  : <span  style="color:#28C76F;"> {{$pizza_extras->price}} $</span></p>
                                                    </div>
                                                @endforeach
                                            @endif
                                            @if($order->instructions)
                                            <p style="color:#28C76F;">Note:</p>
                                            <p>{{$order->instructions}}</p>
                                                @endif
                                        </div>


                                        <div class="item-options text-center">
                                            <div class="item-wrapper">
                                                <div class="item-rating">
                                                    {{--<div class="badge badge-primary badge-md">--}}
                                                        {{--4 <i class="feather icon-star ml-25"></i>--}}
                                                    {{--</div>--}}
                                                </div>
                                                <div class="item-cost">
                                                    <h6 class="item-price">
                                                        {{ $order->quantity * $order->order_price}}$
                                                    </h6>

                                                    <p class="shipping">
                                                        Total Price
                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                @endforeach
                            </div>
                            <div class="checkout-options">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body">

                                            <div class="price-details">
                                                <p>Price Details</p>
                                            </div>
                                            <div class="detail">
                                                <div class="detail-title">
                                                   Order  Total
                                                </div>
                                                <div class="detail-amt">
                                                    {{--{{ $orders->sum('total_price') }}--}}
                                                    {{ $invoice->order_price }}$
                                                </div>
                                            </div>
                                            @if($invoice->coupon_code != null)
                                            <div class="detail">
                                                <div class="detail-title">
                                                    Coupon Name
                                                </div>
                                                <div class="detail-amt discount-amt">
                                                    {{ $invoice->coupon_code }}
                                                </div>
                                            </div>

                                            <div class="detail">
                                                <div class="detail-title">
                                                    Coupon Discount
                                                </div>
                                                <div class="detail-amt discount-amt">
                                                    @if($coupon_value-> amount_type == 'fixed')
                                                    {{$coupon_value->amount}}
                                                        @else
                                                        {{$coupon_value->amount}}%
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="detail">
                                                <div class="detail-title">
                                                    Coupon Type Discount
                                                </div>
                                                <div class="detail-amt discount-amt">
                                                    @if($coupon_value->amount_type == 'fixed')
                                                        Fixed
                                                    @else
                                                       Percent
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="detail">
                                                <div class="detail-title">
                                                     Total After Coupon Discount
                                                </div>
                                                <div class="detail-amt">

                                                    @if($invoice-> coupon_price != null)
                                                        {{ $invoice->coupon_price }} $
                                                    @else
                                                       0 $
                                                    @endif
                                                </div>
                                            </div>
                                            @endif
                                            <div class="detail">
                                                <div class="detail-title">
                                                    Need  Delivery
                                                </div>
                                                <div class="detail-amt emi-details">
                                                    @if($invoice-> is_delivery)
                                                        Yes
                                                        @else
                                                    No
                                                        @endif

                                                </div>
                                            </div>
                                            <div class="detail">
                                                <div class="detail-title">
                                                    Delivery Cost
                                                </div>
                                                <div class="detail-amt discount-amt">
                                                    @if($invoice-> is_delivery)
                                                        {{$setting->delivery_cost}} $
                                                    @else
                                                        No  Delivery Cost
                                                    @endif

                                                </div>

                                            </div>
                                            <div class="detail">
                                                <div class="detail-title">
                                                    Tips Cost
                                                </div>
                                                <div class="detail-amt discount-amt">
                                                    @if($invoice-> tips)
                                                        {{$invoice->tips}}
                                                    @else
                                                        No  Tips
                                                    @endif

                                                </div>

                                            </div>
                                            <div class="detail">
                                                <div class="detail-title">
                                                    Tax
                                                </div>
                                                <div class="detail-amt discount-amt">

                                                        {{$setting->tax}}%
                                                </div>

                                            </div>
                                            <hr>
                                            <div class="detail">
                                                <div class="detail-title detail-total">Total</div>
                                                <div class="detail-amt total-amt">
                                                   {{$invoice->total}} $
                                                </div>
                                            </div>
                                            {{--<div class="btn btn-primary btn-block place-order">PLACE ORDER</div>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </fieldset>
                    <!-- Checkout Place order Ends -->


                </form>

            </div>


</div>

    @push('script')
        <script src="{{asset('admin-layout/app-assets/js/scripts/pages/app-ecommerce-shop.js')}}"></script>

    @endpush

@stop