@extends('front_layout.main')
@push('style')
    <style>
    </style>
@endpush
@section('content')
    <section class="checkout-section">
        <div class="container">
            <form id="orderForm" name="orderForm" class="" action="" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="border-box height">
                            <h2>Credit Card Information</h2>
                            <form >
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
                                    <input type="text" class="form-control" placeholder="Card Number">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="MM / YYYY">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Security Code">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button  id="submit" class="btn">Confirm Order</button>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="#" class="btn back">Back</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="order-box border-box height">
                            <h2>Credit Card Information</h2>

                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item w-50 pr-15" role="presentation">
                                    <a class="nav-link order border-box w-100 active" id="pills-delivery-tab" data-toggle="pill" href="#pills-delivery"
                                       role="tab" aria-controls="pills-delivery" aria-selected="true">
                                        <div class="order-img">
                                            <img src="{{asset('front-asset/assets/images/delivery.png')}}" alt="" class="img-fluid">
                                        </div>
                                        <span>Delivery</span>
                                        <span class="delivery-cost">3$ delivery cost</span>
                                        <input type="radio" id="order_type1" name="is_delivery" checked
                                               class="" value="1" hidden>
                                    </a>
                                </li>
                                <li class="nav-item w-50 pl-15" role="presentation">
                                    <a class="nav-link order border-box w-100" id="pills-take-tab" data-toggle="pill" href="#pills-take"
                                       role="tab" aria-controls="pills-take" aria-selected="false">
                                        <div class="order-img">
                                            <img src="{{asset('front-asset/assets/images/take-away.png')}}" alt="" class="img-fluid">
                                        </div>
                                        <span>Take Away</span>
                                        <input type="radio" id="order_type2" name="is_delivery"
                                               class="" value="0" hidden>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-delivery" role="tabpanel"
                                     aria-labelledby="pills-delivery-tab">
                                    <!-- <form> -->
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control" placeholder="First Name" name="firstname">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control" placeholder="Last Name" name="lastname">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control" placeholder="Phone Number" name="phones">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control" placeholder="Tips" name="tip">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <select class="form-control" id="exampleFormControlSelect1" name="state_id">
                                            <option disabled selected>Select State</option>
                                            @foreach($states as $state)
                                            <option value="{{$state->id}}">{{$state->name}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control" placeholder="Address" name="address_1">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6 mb-0">
                                            <select class="form-control" id="exampleFormControlSelect1">
                                            <option disabled selected>City</option>
                                            @foreach($cities as $city)
                                            <option value="{{$city->id}}">{{$city->name}}</option>
                                            @endforeach

                                            </select>
                                        </div>
                                        <div class="form-group col-md-6 mb-0">
                                            <input type="text" class="form-control" placeholder="ZIP Code" name="zip_code"
                                                   aria-describedby="zipHelp">
                                            <small id="zipHelp" class="form-text">Sorry, delivery is unable, Please
                                                Call Us on: 1800 400 400</small>
                                        </div>
                                    </div>
                                    <!-- </form> -->
                                </div>

                                <div class="tab-pane fade" id="pills-take" role="tabpanel"
                                     aria-labelledby="pills-take-tab">
                                    <!-- <form> -->
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
                                            <input type="text" class="form-control" placeholder="Phone Number" name="phone">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control" placeholder="Tips" name="tips">
                                        </div>
                                    </div>
                                    <!-- </form> -->
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script>
            $('.order').on('click', function(){
                $(this).find('input[type="radio"]').prop('checked', true);
                console.log($('input[name="is_delivery"]:checked').val());
            });

            $(document).ready(function() {

                // process the form

                $('#submit').click(function(event) {
                    var form = $('#orderForm');

                    $.ajax({
                        type        : 'POST',
                        url         : '{{route("cart.save_order")}}',
                        data        : form.serialize(),
                        dataType    : 'json',
                        encode          : true
                    }).done(function(data) {
                        Swal.fire(
                            'Good',
                            ' Your Message Send Successfully',
                            'success'
                        )
                        location.reload();
                    }).fail(function(data){
                        $(".test").empty();
                        $.each(data.responseJSON.errors, function( index, value ) {
                          //  $("input[name='"+index+"']" ).parent().append('<span class="test" style="color: red;">' + value + '</span>');
                          //  $("textarea[name='"+index+"']" ).parent().append('<span class="test" style="color: red;">' + value + '</span>');

                        });
                    });
                    event.preventDefault();
                });

            });
        </script>
    @endpush
@stop