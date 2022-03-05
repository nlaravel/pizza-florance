@extends('front_layout.main')
@push('style')
    <style>
    </style>
@endpush
@section('content')
    <section class="pizza-build-section">
        <div class="container">
            <form id="build_calzone_form" name="build_calzone_form" class="" action="" method="post">
                {{ csrf_field() }}

                <input type="hidden" value="{{asset('front-asset/assets/images/pizza-build.png')}}" id="img" name="img">
                <input type="hidden" value="0" id="price" name="price">
                <input type="hidden" value="Special Calzone" id="name" name="name">
                <input type="hidden" value="" id="details" name="details">
                <input type="hidden" value="" id="card_id" name="card_id">
                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="title">Size</h2>
                        <div class="size">
                            {{--<form class="form-inline">--}}
                            <div class="form-group vehicle-type">
                                <select class="form-control select-pizza_size"  id="size" name="size">
                                    <option disabled selected>Select Size</option>
                                    @foreach($sizes as $size)
                                        <option  value="{{$size->id}}" data-price="{{$size->price}}">{{$size->name}}</option>
                                    @endforeach
                                </select>
                                <div  id="error" style="text-align: center; " ></div>
                            </div>
                            {{--<button class="btn"  id="clear" type="reset">Clear</button>--}}
                            {{--</form>--}}
                            <span id="size_calzone_1"> </span>
                        </div>
                    </div>
                    <div class="col-6"></div>
                </div>

                <div class="row">
                    @foreach($types as $type)
                        <div class="col-lg-6">
                            <div class="border-box">
                                <h2 class="title">{{$type->name}} <span>*</span></h2>
                                <div class="row">
                                    @foreach($type->childs as $child)

                                        <div class="col-md-6">
                                            <div class="custom-control custom-checkbox">
                                                <input  disabled type="checkbox" class="custom-control-input " name="type[]"  value="{{$child->id}}" id="checkbox_type_{{$child->id}}" data-typecategory="{{$child->categoryParent->name}}" data-typeid="{{$child->id}}" data-nametype="{{$child->name}}" data-pricetype="{{$child->price}}" onClick="type_click(this)">
                                                <label class="custom-control-label checkbox-customize" for="checkbox_type_{{$child->id}}">
                                                    <p >{{$child->name}} <span  >{{$child->price}}$+</span></p>
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="col-lg-6">
                        <div class="border-box build-price">
                            <div class="d-flex justify-content-between align-items-center header">
                                <h2 class="title pb-0">1x Build Your Calzone</h2>
                                <div><span id="size_calzone_2"></span> <span class="dollar d-none">$</span></div>

                            </div>
                            <div class="choosen">
                                {{--<div class="d-flex justify-content-between align-items-center" id="test">--}}
                                {{--<span class="class2">Cheese Type - Mozarella</span>--}}
                                {{--<span class="class2">2.00 $</span>--}}
                                {{--</div>--}}

                            </div>
                            <div class="final-price">
                                <div class="d-flex justify-content-end align-items-center">
                                    {{--<span>Total:</span>--}}
                                    {{--<span class="total-price"> </span>--}}
                                </div>
                            </div>
                            <img class="pizza-build-img"   src="{{asset('front-asset/assets/images/pizza-build.png')}}" alt="" class="img-fluid">
                        </div>
                        <div class="row submit-row">
                            <div class="col-md-6">
                                <div class="quantity">
                                    <input type="button" value="-" class="btn minus">
                                    <input step="1" min="1" max="" value="1" class="form-control pizza-count text-center" size="4"  inputmode="" name="quantity">
                                    <input type="button" value="+" class="btn plus">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <a id="submit"  class="btn order-btn">Order Now</a>

                            </div>
                        </div>
                    </div>


                </div>
            </form>
        </div>
    </section>
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="{{asset('front-asset/assets/images/check.png')}}" alt="" class="img-gluid">
                    <p>The product has been added to the cart successfully</p>
                    <a href="{{route('front.index')}}">Done</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addInstructions_1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <p class="py-2">Leave instructions in this order</p>
                    <input type="text" id="instructions_1" class="form-control" name="instructions_1" >
                    <div class="text-center mt-2">
                        <button id="update" class="btn cart-btn" onclick="addDetailsToForm(this)">Add to Cart</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @push('scripts')

        <script>
            var CartID = '';
            $('.btn.plus').off().click(function (e) {
                var input = $(this).prev($('.quantity-input'));
                input.val(+input.val() + 1);
            });
            $('.btn.minus').off().click(function (e) {
                var input = $(this).next($('.quantity-input'));
                input.val(input.val() != "1" ? +input.val() - 1 : input.val());
            });

            $('.select-pizza_size').on('change', function() {

                document.getElementById("size_calzone_1").textContent= $(this).find(':selected').data('price')+'$';
                document.getElementById("size_calzone_2").textContent= $(this).find(':selected').data('price');
                $('.dollar').addClass('d-inline');
                $('input[type="checkbox"]').attr('disabled', false);
                let size_price=  $('#size_calzone_2').text();
                $("#price").val(size_price);
                type_click();


            });

            function type_click(e){
                //  console.log();

                let id= $(e).data('typeid')
                let typecategory= $(e).data('typecategory')
                let name= $(e).data('nametype')
                let price= $(e).data('pricetype')
                // console.log(size_calzone_2,name,price)

                if($('#checkbox_type_'+id).is(':checked')) {
                    // checked
                    $( '.choosen' ).append('<div  class="d-flex justify-content-between align-items-center"  id="row'+id+'">'+'<span >' +typecategory+ ' - ' +name + '</span>' +'<span class="box_price">' + price + '</span>'+'</div>');
                    let size_price=  $('#size_calzone_2').text().trim();
                    let toppigs = 0;
                    $(' .box_price').each(function(){

                        toppigs += parseFloat($(this).text()) ;
                        let subtotal=toppigs;
                        let size_price=parseFloat($('#size_calzone_2').text());
                        let total=(size_price+subtotal).toFixed(2);
                        console.log(total)
                        $("#price").val(total);

                        $(".total-price").empty();
                        $(".total").empty();
                        $('.final-price').append('<div class="d-flex justify-content-end align-items-center" id="row_1'+id+'">'+"<span class='total'>Total:</span>"+"<span class='total-price'>"+total+" $</span>"+"</div>");
                    });


                }else {
                    // unchecked
                    let size_price=  $('#size_calzone_2').text().trim();
                    $('#row'+id+'').remove();
                    $('#row_1'+id+'').remove();
                    $(".total-price").empty();
                    $(".total").empty();
                    let toppigs = 0;
                    $(' .box_price').each(function(){

                        toppigs += parseFloat($(this).text()) ;
                        let subtotal=toppigs;
                        let size_price=parseFloat($('#size_calzone_2').text());
                        let total=(size_price+subtotal).toFixed(2);
                        console.log(total)

                        $("#price").val(total);


                        $(".total-price").empty();
                        $(".total").empty();
                        $('.final-price').append('<div class="d-flex justify-content-end align-items-center" id="row_1'+id+'">'+"<span class='total'>Total:</span>"+"<span class='total-price'>"+total+" $</span>"+"</div>");
                    });


                }

            }



        </script>

        <script>
            $(document).ready(function() {
                $('#submit').click(function(event) {
                    var form = $('#build_calzone_form');

                    $.ajax({
                        type        : 'POST',
                        url         : '{{route("cart.add_calzone_special")}}',
                        data        : form.serialize(),
                        dataType    : 'json',
                        encode          : true
                    }).done(function(data) {
                        if(data.message){
                            $("#addInstructions_1").modal('hide');
                            $("#addModal").modal('show');

                        }else {
                            CartID = data.data.cart_id;
                            $("#addInstructions_1").modal('show');
                        }

                    }).fail(function(data){
//                        var erorrMassage = "Please Select Size !. ";
//                        var size=$('#size').val();
//                        if (size ==null) {
//                            $("#error").html('<h5 style="color:#d61030;">'+erorrMassage+'</h5>')
//                        }
                        $(".test").empty();
                        $.each(data.responseJSON.errors, function( index, value ) {
                            $("select[name='"+index+"']" ).parent().append('<span style="color: #c83824;" class="test">' + value + '</span>');

                        });
                    });
                    event.preventDefault();
                });
            });

            function addDetailsToForm() {

                $('#details').val($('#instructions_1').val());
                $('#card_id').val(CartID);
                $('#submit').click();
            }
        </script>
    @endpush
@stop
