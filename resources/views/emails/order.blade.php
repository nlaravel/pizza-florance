<!DOCTYPE html>
<html lang="en">
<?php
$setting=\App\Setting::find(1);
$orders=\App\Order::where('person_id',$data['id'])->with('people')
    ->with('products')->with('OrderSpecialPizzaSize')
    ->with('OrderSpecialPizzaTypes')
    ->with('OrderPizzaSize')
    ->with('OrderPizzaExtras')
    ->get();
$invoice=\App\Invoice::where('order_status','active')->with('people')->where('person_id',$data['id'])->first();
$coupon_value=\App\Coupon::where('coupon_code',$invoice->coupon_code)->first();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>

<body style="font-family: 'Poppins', sans-serif;">
{{--<header style="height: 179px; display: flex; justify-content: center; align-items: center;--}}
    {{--position: relative;">--}}

    {{--<div style="background-color: #d22a31; height: 5px; width: 100%;"></div>--}}
    {{--<div class="img" style=" text-align: center; position: absolute; top: 0;--}}
            {{--left: calc(50% - 92px);">--}}
        {{--<img src="{{asset('front-asset/assets/images/piza-logo.png')}}" alt="" width="184px" height="179px">--}}
    {{--</div>--}}
{{--</header>--}}
<header style="background: url({{asset('front-asset/assets/images/email.png')}}) center no-repeat; height: 160px;"></header>
<section style="padding: 0px;">

    <div style="text-align: center;">

        <h3 style=" display: inline-block;
                font-size: 24px;
                font-weight: bold;
                color: #fff;
                background-color: #d22a31;
                border-radius: 50px;
                padding: 5px 30px;">Invoice</h3>

    </div>

    <div style="width: 100%; margin-top: 50px;">

        <div style="display: inline-block; width: 100%;">
            <label style="margin-bottom: 0px;
                font-size: 18px;
                color: #909090;
                width: 150px;
                display: inline-block;">Dear Customer:</label>
            <span style="font-size: 16px;
                color: #2a3c4d;
                font-weight: 600;">{{$data['first_name']}} {{$data['last_name']}}</span>
        </div>

        <div style="display: inline-block; width: 100%;">
            <label style="margin-bottom: 0px;
                font-size: 18px;
                color: #909090;
                width: 150px;
                display: inline-block;">Invoice No:</label>
            <span style="font-size: 16px;
                color: #2a3c4d;
                font-weight: 600;">#{{$invoice->id}}</span>
        </div>
        @if($data['zip_code'])
        <div style="display: inline-block; width: 100%;">
            <label style="margin-bottom: 0px;
                font-size: 18px;
                color: #909090;
                width: 150px;
                display: inline-block;">Zip Code:</label>
            <span style="font-size: 16px;
                color: #2a3c4d;
                font-weight: 600;">{{$data['zip_code']}}</span>
        </div>
     @endif
        <div style="display: inline-block; width: 100%;">
            <label style="margin-bottom: 0px;
                font-size: 18px;
                color: #909090;
                width: 150px;
                display: inline-block;">Date:</label>
            <span style="font-size: 16px;
                color: #2a3c4d;
                font-weight: 600;">{{\Carbon\Carbon::now()->format('d-m-Y')}}</span>
        </div>

    </div>

    <div style="overflow: auto;">
        <table style="width: 100%; margin-top: 30px; border-spacing: 0px;">
            <thead style="background-color: #2a3c4d; color: #fff; font-size: 14px; font-weight: 600;
                text-align: left;">
            <tr>
                <th style="padding: 15px;">#</th>
                <th style="padding: 15px;">Item Name</th>
                <th style="padding: 15px;">Item Price</th>
                <th style="padding: 15px;">Quantity</th>
                <th style="padding: 15px;">Amount</th>
            </tr>
            </thead>
            <tbody style="font-weight: 600; font-size: 16px; color: #2a3c4d;">
            @foreach($orders as $index=>$order)
            <tr>
                <td style="padding: 15px; border-bottom: 1px solid #e3e3e3;">{{$index + 1}}</td>
                <td style="padding: 15px; border-bottom: 1px solid #e3e3e3;">{{$order->products->name}}
                    @if( $order->OrderSpecialPizzaSize)
                        @foreach( $order->OrderSpecialPizzaSize as $special)
                    <span style="display: block; color: #a3a3a3; font-size: 12px; font-weight: normal;
                                    padding-left: 25px;">{{$special->size}} : {{$special->price}} </span>
                        @endforeach
                    @endif
                    @if( $order->OrderSpecialPizzaTypes)
                        @foreach( $order->OrderSpecialPizzaTypes as $special)
                            <span style="display: block; color: #a3a3a3; font-size: 12px; font-weight: normal;
                                    padding-left: 25px;">{{$special->name}} :{{$special->price}} </span>
                        @endforeach
                    @endif
                    @if( $order->OrderPizzaSize)
                        @foreach( $order->OrderPizzaSize as $pizza_size)
                            <span style="display: block; color: #a3a3a3; font-size: 12px; font-weight: normal;
                                    padding-left: 25px;">{{$pizza_size->size}} :{{$pizza_size->price}} </span>
                        @endforeach
                    @endif
                    @if( $order->OrderPizzaExtras)
                        @foreach( $order->OrderPizzaExtras as $pizza_extras)
                            <span style="display: block; color: #a3a3a3; font-size: 12px; font-weight: normal;
                                    padding-left: 25px;">{{$pizza_extras->name}} :{{$pizza_extras->price}} </span>
                        @endforeach
                    @endif
                    @if($order->instructions)
                    <span style="display: block; color: #a3a3a3; font-size: 10px; font-weight: normal;
                                    padding-left: 25px;">Note:{{$order->instructions}}</span>
                    @endif
                </td>
                <td style="padding: 15px; border-bottom: 1px solid #e3e3e3;">{{$order->order_price}}</td>
                <td style="padding: 15px; border-bottom: 1px solid #e3e3e3;">{{$order->quantity}}</td>
                <td style="padding: 15px; border-bottom: 1px solid #e3e3e3; font-weight: bold; color: #d22a31;">  {{ $order->quantity * $order->order_price}}
                </td>
            </tr>
          @endforeach

            <tr>
                <td style="padding: 10px;"></td>
                <td style="padding: 10px;"></td>
                <td style="padding: 10px;"></td>
                <td style="padding: 10px; font-size: 14px;">SubTotal</td>
                <td style="padding: 10px; font-weight: bold; color: #d22a31;">{{ $invoice->order_price }}</td>
            </tr>
            <tr>
                <td style="padding: 10px;"></td>
                <td style="padding: 10px;"></td>
                <td style="padding: 10px;"></td>
                <td style="padding: 10px; font-size: 14px;">tips</td>
                <td style="padding: 10px; font-weight: bold; color: #d22a31;">
                    @if($invoice-> tips)
                        {{$invoice->tips}}
                    @else
                        No  Tips
                    @endif</td>
            </tr>
            <tr>
                <td style="padding: 10px;"></td>
                <td style="padding: 10px;"></td>
                <td style="padding: 10px;"></td>
                <td style="padding: 10px; font-size: 14px;">Delivery</td>
                <td style="padding: 10px; font-weight: bold; color: #d22a31;">
                    @if($invoice-> is_delivery)
                        {{$setting->delivery_cost}} $
                    @else
                        No  Delivery Cost
                    @endif</td>
            </tr>
            <tr>
                <td style="padding: 10px;"></td>
                <td style="padding: 10px;"></td>
                <td style="padding: 10px;"></td>
                <td style="padding: 10px; font-size: 14px;">Tax</td>
                <td style="padding: 10px; font-weight: bold; color: #d22a31;">{{$setting->tax}}%</td>
            </tr>

            </tbody>
            <tfoot style="background-color: #e0e0e0;">
            <tr>
                <td style="padding: 10px;"></td>
                <td style="padding: 10px;"></td>
                <td style="padding: 10px;"></td>
                <td style="padding: 10px; font-size: 14px; color: #5d5d5d;">Total Amount</td>
                <td style="padding: 10px; font-size: 18px; font-weight: bold; color: #d22a31;">  {{$invoice->total}}$</td>
            </tr>
            </tfoot>
        </table>
    </div>

    {{--<div style="display: flex; justify-content: flex-start; align-items: baseline; margin: 25px 0px;">--}}
        {{--<span style="display: block; color: #909090; font-size: 18px; padding-right: 25px;">Note:</span>--}}
        {{--<p style="display: block; color: #2a3c4d; font-size: 14px; margin: 0px; text-align: justify;">{{$message}}</p>--}}
    {{--</div>--}}

</section>

<footer style="padding: 15px 0px; border-top: 1px solid #e3e3e3; margin-top: 50px;">
    <div style="display: table; width: 100%;">

        <div style="display: inline-block; width: 100%;">
            <img src="{{asset('front-asset/assets/images/phone.png')}}" alt="" style="padding-right: 25px;">

            <span style="color: #313f4c; font-size: 14px; font-weight: bold;">{{$setting->mobile_1}}</span>
            <span style="color: #313f4c; font-size: 14px; font-weight: bold; display: inline-block; padding-left: 40px;">{{$setting->email}}</span>
        </div>

        <div style="display: inline-block; width: 100%;">
            <img src="{{asset('front-asset/assets/images/location.png')}}" alt="" style="padding-right: 25px;">

            <span style="color: #313f4c; font-size: 14px; font-weight: bold;">{{$setting->address_1}}</span>
        </div>

    </div>
</footer>

</body>

</html>