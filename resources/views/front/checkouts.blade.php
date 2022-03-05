@extends('front_layout.main')
@push('style')
    <style>
    </style>
@endpush
@section('content')
    <section class="checkout-section">
        <div class="container">
            @if(session('success_msg'))
                <div class="alert alert-success fade in alert-dismissible show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true" style="font-size:20px">×</span>
                    </button>
                    {{ session('success_msg') }}
                </div>
            @endif
            @if(session('error_msg'))
                <div class="alert alert-danger fade in alert-dismissible show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true" style="font-size:20px">×</span>
                    </button>
                    {{ session('error_msg') }}
                </div>
            @endif
            <form id="orderForm" name="orderForm" class="" action="{{route('cart.save_order')}}" method="post">
                @csrf

                <ul class="progressbar">
                    <li class="active">
                        <div class="circle">1</div>
                        <span>Order Details</span>
                    </li>
                    <li>
                        <div class="circle">2</div>
                        <span>Order Summary</span>
                        <div class="progress" style="height: 1px;">
                            <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="25"
                                 aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </li>
                    <li>
                        <div class="circle">3</div>
                        <span>Checkout</span>
                        <div class="progress" style="height: 1px;">
                            <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="25"
                                 aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </li>
                </ul>

                <fieldset>
                    <div class="order-box border-box order-details">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="custom-control custom-radio custom-control-inline w-100">
                                    <input type="radio" id="delivery" name="is_delivery" class="custom-control-input" checked
                                       value="1" hidden>
                                    <label class="custom-control-label radio-customize w-100 mb-0" for="delivery">
                                        <div class="order">
                                            <div class="order-img">
                                                <img src="{{asset('front-asset/assets/images/delivery.png')}}" alt="" class="img-fluid">
                                            </div>
                                            <span>Delivery</span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="custom-control custom-radio custom-control-inline w-100">
                                    <input type="radio" id="pick_up" name="is_delivery" class="custom-control-input"
                                           value="0" hidden>
                                    <label class="custom-control-label radio-customize w-100 mb-0" for="pick_up">
                                        <div class="order">
                                            <div class="order-img">
                                                <img src="{{asset('front-asset/assets/images/take-away.png')}}" alt="" class="img-fluid">
                                            </div>
                                            <span>Pick Up</span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="Delivery-form">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" placeholder="First Name" name="first_name">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" placeholder="Last Name" name="last_name">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" placeholder="Email" name="email">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" placeholder="Phone Number" name="phone">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" placeholder="Address 1" name="address_1">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" placeholder="Address 2" name="address_2">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <select class="form-control" id="exampleFormControlSelect1" name="city_id">
                                        <option  value="0" disabled selected>City</option>
                                        @foreach($cities as $city)
                                            <option value="{{$city->id}}">{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" placeholder="ZIP Code" name="zip_code" id="zip_code"
                                           aria-describedby="zipHelp" disabled>
                                    <small id="zipHelp" class="form-text pl-4" style="display:none;">Sorry, delivery is unable, Please
                                        Call Us on: 1800 400 400</small>
                                    <span id="change_order" class="form-text pl-4"  style=" color:#fa4747;display:none;">Please Click Pick up to Place your  Order ..</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-6 custom-check-radio">
                                    <div class="tips-radio">
                                        <label>Add Tips</label>
                                        <div class="form-row">
                                            <div class="col-auto">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="tip_10" name="tips" value="10"
                                                           class="custom-control-input">
                                                    <label class="custom-control-label" for="tip_10">10%</label>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="tip_15" name="tips" value="15"
                                                           class="custom-control-input">
                                                    <label class="custom-control-label" for="tip_15">15%</label>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="tip_20" name="tips"
                                                           class="custom-control-input" value="20">
                                                    <label class="custom-control-label" for="tip_20">20%</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <p>Or</p>
                                        </div>
                                        <div class="col-auto">
                                            <input type="number" class="form-control" name="tips_delivery">
                                            <span>$</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pick-up-form" style="display: none;">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" placeholder="First Name" name="first_name_1">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" placeholder="Last Name" name="last_name_1">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" placeholder="Email" name="email_1">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" placeholder="Phone Number" name="phone_1">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-6 custom-check-radio">
                                    <div class="tips-radio">
                                        <label>Add Tips</label>
                                        <div class="form-row">
                                            <div class="col-auto">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="tip1_10" name="tips_1"
                                                           class="custom-control-input" value="10">
                                                    <label class="custom-control-label" for="tip1_10">10%</label>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="tip1_15" name="tips_1"
                                                           class="custom-control-input" value="15">
                                                    <label class="custom-control-label" for="tip1_15">15%</label>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="tip1_20" name="tips_1"
                                                           class="custom-control-input" value="20">
                                                    <label class="custom-control-label" for="tip1_20">20%</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <p>Or</p>
                                        </div>
                                        <div class="col-auto">
                                            <input type="number" class="form-control" name="tips_takeaway">
                                            <span>$</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-9"></div>
                            <div class="col-md-3">
                                <button type="button" id="next" class="btn next-step">Next</button>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="border-box order-summary">
                                @foreach(\Cart::content()  as $item)
                                    <div class="product">
                                        <div class="product-card">
                                            <div class="product-img">
                                                @if(isset($item->options->toArray()['image']))
                                                <img src="{{$item->options->toArray()['image']}}" alt="" class="img-fluid">
                                                @else
                                                <img src="{{$item->id['image_url']}}" alt="" class="img-fluid">
                                                    @endif
                                            </div>
                                            <div class="product-info w-100">
                                                <h4>{{ $item->id['name'] }}</h4>
                                                <div class="row">
                                                    <div class="col-lg-5">
                                                        <div class="d-flex justify-content-between">
                                                            @if(isset($item->options->toArray()['size']))
                                                                <span class="size">{{$item->options->toArray()['size'] }}</span>
                                                                <span class="price">{{ $item->options->toArray()['price_size'] }} $</span>

                                                            @elseif( isset($item->options->toArray()['pizza_size'][0]))
                                                                <span class="size">{{ $item->options->toArray()['pizza_size'][0]['name'] }}</span>
                                                                <span class="price">{{ $item->options->toArray()['pizza_size'][0]['price'] }} $</span>
                                                            @else

                                                                <span class="price">{{ $item->price }} $</span>
                                                            @endif
                                                        </div>
                                                        @if(isset($item->options->toArray()['extras']))
                                                            @foreach($item->options->toArray()['extras']  as $extras)
                                                                <div class="d-flex justify-content-between">
                                                                    <span class="size">{{ $extras['name']}}</span>
                                                                    <span class="price">{{$extras['price']}} $</span>
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
                                                    </div>
                                                    <div class="col-lg-2"></div>
                                                    <div class="col-lg-5">

                                                        <div class="d-flex justify-content-between">
                                                            <span class="size">Quantity</span>
                                                            <span class="price">{{$item->qty}}</span>
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            <span class="size">Unit price</span>

                                                                <span class="price"> {{ $item->price}}$</span>
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            <span class="size">total price</span>

                                                                <span class="price">{{ $item->qty * $item->price}}$</span>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if(isset($item->options->toArray()['instructions']))
                                        <div class="product-comment">
                                            <div class="row">
                                                <div class="col-12">
                                                    <p class="note">
                                                        <span>Note:</span>
                                                     {{$item->options->toArray()['instructions']}}

                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                            @endif
                                    </div>
                                    @endforeach

                            </div>
                        </div>
                        <div class="col-lg-6">


                                <div class="border-box">
                                        <div class="price-summary">
                                            <label>Subtotal</label>
                                            <span>{{\Cart::total()}}$</span>
                                        </div>
                                    @if(!empty(session()->get('couponAmount')))
                                    <div class="price-summary">
                                            <label>Coupon Discount</label>
                                            <span>{{\Cart::total() - session()->get('couponAmount') }} $</span>
                                        </div>
                                    @endif
                                        <div class="price-summary">
                                            <label>Delivery</label>
                                            <span  id="delivery_cost" class="free">$</span>
                                        </div>
                                        <div class="price-summary">
                                            <label>TIP</label>
                                            <span id="tips_takeaway">0</span>
                                        </div>
                                     <div class="price-summary">
                                            <label>Tax</label>
                                            <span id="tax">0</span>
                                        </div>

                                        <div class="price-summary total">
                                            <label>TOTAL</label>
                                            <span id="delivery_total">$</span>

                                        </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="button" class="btn back prev-step">previous</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button" id="next-step1" class="btn next-step">Next</button>
                                        </div>
                                    </div>
                                </div>


                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="border-box col-lg-6 mx-auto">
                        <div class="payment">
                            @foreach($payments as $payment)
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline{{$payment->id}}" name="payment_method"
                                           class="custom-control-input">
                                    <label class="custom-control-label radio-customize" for="customRadioInline{{$payment->id}}">
                                        <div class="payment-img">
                                            <img src="{{$payment->image_url}}" alt="" class="img-fluid">
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Card Number" name="card_number">
                        </div>
                        <div class="form-group">
                            <input type="month" class="form-control" placeholder="MM / YYYY" name="expired_date">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Security Code" name="security_card">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" class="btn back prev-step">previous</button>
                            </div>
                            <div class="col-md-6">
                                <button id="submit" class="btn">Checkout</button>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>

        </div>
    </section>

    @push('scripts')
        <script src="{{asset('front-asset/assets/js/jquery-3.4.1.min.js')}}"></script>
        <script src="{{asset('front-asset/assets/js/bootstrap.min.js')}}"></script>

        <script>

            $(document).ready(function () {
                let array =new Array();
                let ZipCode =new Array();


                $("#next").click(function (event) {
                    let tap_content=$("input[name='is_delivery']:checked").val();
                    let tips=$("input[name='tips_1']:checked").val();
                    var current_fs, next_fs, previous_fs; //fieldsets
                    var opacity;
                    var current = 1;
                    var steps = $("fieldset").length;
                    current_fs = $(this).closest('fieldset');
                    next_fs = $(this).closest('fieldset').next('fieldset');
                    if(tap_content ==0){

                        var form = $('#orderForm');

                        $.ajax({
                            type        : 'POST',
                            url         : '{{route("cart.pickup")}}',
                            data        : form.serialize(),
                            dataType    : 'json',
                            encode          : true
                        }).done(function(data) {
                            array.push(data);
                            $('#tips_takeaway').text(data.data.tips);
                            $('#delivery_cost').text(data.data.delivery_cost);
                            $('#delivery_total').text(data.data.total);
                            $('#tax').text(data.data.tax);

                            //Add Class Active
                            $(".progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

                            //show the next fieldset
                            next_fs.show();
                            $(".progressbar li").eq($("fieldset").index(next_fs)).find('.progress-bar').css('width', '100%')

                            //hide the current fieldset with style
                            current_fs.animate({ opacity: 0 }, {
                                step: function (now) {
                                    // for making fielset appear animation
                                    opacity = 1 - now;

                                    current_fs.css({
                                        'display': 'none',
                                        'position': 'relative'
                                    });
                                    next_fs.css({ 'opacity': opacity });
                                },
                                duration: 500
                            });

                        }).fail(function(data){
                            $(".test").empty();
                            $.each(data.responseJSON.errors, function( index, value ) {
                                  $("input[name='"+index+"']" ).parent().append('<span class="test" style="color: red;">' + value + '</span>');


                            });
                        });
                        event.preventDefault();
                        }
                        else{
                        var form = $('#orderForm');

                        $.ajax({
                            type        : 'POST',
                            url         : '{{route("cart.delivery")}}',
                            data        : form.serialize(),
                            dataType    : 'json',
                            encode          : true
                        }).done(function(data) {
                            array.push(data);
                            $('#tips_takeaway').text(data.data.tips);
                            $('#delivery_cost').text(data.data.delivery_cost);
                            $('#delivery_total').text(data.data.total);
                            $('#tax').text(data.data.tax);

                            //Add Class Active
                            $(".progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

                            //show the next fieldset
                            next_fs.show();
                            $(".progressbar li").eq($("fieldset").index(next_fs)).find('.progress-bar').css('width', '100%')

                            //hide the current fieldset with style
                            current_fs.animate({ opacity: 0 }, {
                                step: function (now) {
                                    // for making fielset appear animation
                                    opacity = 1 - now;

                                    current_fs.css({
                                        'display': 'none',
                                        'position': 'relative'
                                    });
                                    next_fs.css({ 'opacity': opacity });
                                },
                                duration: 500
                            });

                        }).fail(function(data){
                            $(".test").empty();
                            $.each(data.responseJSON.errors, function( index, value ) {
                                $("input[name='"+index+"']" ).parent().append('<span class="test" style="color: red;">' + value + '</span>');
                                $("select[name='"+index+"']" ).parent().append('<span class="test" style="color: red;">' + value + '</span>');


                            });
                        });
                        event.preventDefault();
                    }




                });


                $("#next-step1").click(function () {
                    var current_fs, next_fs, previous_fs; //fieldsets
                    var opacity;
                    var current = 1;
                    var steps = $("fieldset").length;
                    current_fs = $(this).closest('fieldset');
                    next_fs = $(this).closest('fieldset').next('fieldset')
                    //Add Class Active
                    $(".progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

                    //show the next fieldset
                    next_fs.show();
                    $(".progressbar li").eq($("fieldset").index(next_fs)).find('.progress-bar').css('width', '100%')

                    //hide the current fieldset with style
                    current_fs.animate({ opacity: 0 }, {
                        step: function (now) {
                            // for making fielset appear animation
                            opacity = 1 - now;

                            current_fs.css({
                                'display': 'none',
                                'position': 'relative'
                            });
                            next_fs.css({ 'opacity': opacity });
                        },
                        duration: 500
                    });
                });


                $(".prev-step").click(function () {

                    // current_fs = $(this).parent().parent().parent();
                    // previous_fs = $(this).parent().parent().parent().prev();
                    current_fs = $(this).closest('fieldset');
                    previous_fs = $(this).closest('fieldset').prev();

                    //Remove class active
                    $(".progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

                    //show the previous fieldset
                    previous_fs.show();
                    $(".progressbar li").eq($("fieldset").index(current_fs)).find('.progress-bar').css('width', '0%')

                    //hide the current fieldset with style
                    current_fs.animate({ opacity: 0 }, {
                        step: function (now) {
                            // for making fielset appear animation
                            opacity = 1 - now;

                            current_fs.css({
                                'display': 'none',
                                'position': 'relative'
                            });
                            previous_fs.css({ 'opacity': opacity });
                        },
                        duration: 500
                    });
                });


                $('#exampleFormControlSelect1').change(function () {
                    console.log($(this).val());
                    $.get("/getAllCityForZipCode/" + $(this).val(), function (data, status) {
                        ZipCode.push(data);

                        if ($("select[name='city_id']").val()!=null) {
                            $('#zip_code').attr('disabled',false);
                        }
//                        for (let i = 0; i < data.data.length; i++) {
//                            $('#state').append('<option value="' + data.data[i].id + '">' + data.data[i].name + '</option>');
//                        }


                    });
                });
                if ($('#zip_code').length > 0) {

                    var screenName = $("#zip_code").keyup(function () {

                        let value = $(this).val();

                       // return value;
                        console.log(value,ZipCode[0].data);
                        if (jQuery.inArray(value, ZipCode[0].data)  !== -1 ) {
                            $('#zipHelp').css('display', 'none');
                            $('#change_order').css('display', 'none');
                            $('#next').attr('disabled',false);

                            $("input[type='radio'][name='is_delivery']").on('click', function () {

                                console.log('hhh')
                                var delivery = $('#delivery').is(':checked');
                                var pick_up = $('#pick_up').is(':checked');
                                if (delivery == true) {
                                    $('.Delivery-form').css('display', 'block')
                                    $('.pick-up-form').css('display', 'none')
                                   // $('#next').attr('disabled',true);
                                }
                                if (pick_up == true) {
                                    $('.Delivery-form').css('display', 'none')
                                    $('.pick-up-form').css('display', 'block')
                                    $('#next').attr('disabled',false);
                                }
                            });
                        }else {
                            console.log('not in website')
                            $('#zipHelp').css('display', 'block');
                            $('#change_order').css('display', 'block');
                           let first_name= $("input[name='first_name']").val();
                           let last_name= $("input[name='last_name']").val();
                           let email= $("input[name='email']").val();
                           let phone= $("input[name='phone']").val();
                            $("input[name='first_name_1']").val(first_name);
                            $("input[name='last_name_1']").val(last_name);
                            $("input[name='phone_1']").val(phone);
                            $("input[name='email_1']").val(email);
                            $('#next').attr('disabled',true);

                            $("input[type='radio'][name='is_delivery']").on('click', function () {

                                console.log('hhh')
                                var delivery = $('#delivery').is(':checked');
                                var pick_up = $('#pick_up').is(':checked');
                                if (delivery == true) {
                                    $('.Delivery-form').css('display', 'block')
                                    $('.pick-up-form').css('display', 'none')
                                    $('#next').attr('disabled',true);
                                }
                                if (pick_up == true) {
                                    $('.Delivery-form').css('display', 'none')
                                    $('.pick-up-form').css('display', 'block')
                                    $('#next').attr('disabled',false);
                                }
                            });

                        }
                    })
                }

              //  console.log(ZipCode);
            });
        </script>

        <script>
            $(document).ready(function () {


                $("input[type='radio'][name='is_delivery']").on('click', function () {

                    console.log('hhh')
                    var delivery = $('#delivery').is(':checked');
                    var pick_up = $('#pick_up').is(':checked');
                    if (delivery == true) {
                        $('.Delivery-form').css('display', 'block')
                        $('.pick-up-form').css('display', 'none')
                    }
                    if (pick_up == true) {
                        $('.Delivery-form').css('display', 'none')
                        $('.pick-up-form').css('display', 'block')
                    }
                });


                    // process the form

                    {{--$('#submit').click(function(event) {--}}
                        {{--var form = $('#orderForm');--}}

                        {{--$.ajax({--}}
                            {{--type        : 'POST',--}}
                            {{--url         : '{{route("cart.save_order")}}',--}}
                            {{--data        : form.serialize(),--}}
                            {{--dataType    : 'json',--}}
                            {{--encode          : true--}}
                        {{--}).done(function(data) {--}}
                            {{--Swal.fire(--}}
                                {{--'Good',--}}
                                {{--' Your Message Send Successfully',--}}
                                {{--'success'--}}
                            {{--)--}}
                            {{--location.reload();--}}
                        {{--}).fail(function(data){--}}
                            {{--$(".test").empty();--}}
                            {{--$.each(data.responseJSON.errors, function( index, value ) {--}}
                                {{--//  $("input[name='"+index+"']" ).parent().append('<span class="test" style="color: red;">' + value + '</span>');--}}
                                {{--//  $("textarea[name='"+index+"']" ).parent().append('<span class="test" style="color: red;">' + value + '</span>');--}}

                            {{--});--}}
                        {{--});--}}
                        {{--event.preventDefault();--}}
                    {{--});--}}

                });

        </script>
    @endpush
    @stop