@extends('front_layout.main')
@push('style')
    <style>
    </style>
@endpush
@section('content')

        <section class="pizza1-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="size-add-box">
                            <form  id= "PizzaForm"  name="PizzaForm" class="" action="" method="post">
                            {{ csrf_field() }}
                                <div  id="error" style="text-align: center; " ></div>
                                <input type="hidden" value="{{ $products->id }}" id="id" name="id">
                                <input type="hidden" value="" id="details" name="details">
                                <input type="hidden" value="0" id="price" name="price">
                                <input type="hidden" value="0" id="card_id" name="card_id">
                                <h3>Select Size</h3>
                                <div class="row">
                                    @foreach($products ->sizes as $product)
                                    <div class="col-md-3">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline{{$product->id}}" name="name[]"
                                                   class="custom-control-input" value="{{$product->id}}"  data-pizzasize="{{$product->size}}" data-pizzasizeid="{{$product->id}}" data-pizzasizename="{{$product->name}}" data-pizzasizeprice="{{$product->price}}" onClick="type_click(this)">
                                            <label class="custom-control-label radio-customize" for="customRadioInline{{$product->id}}">
                                                <div class="text-center pizza-size">
                                                    <p>{{$product->size}}</p>
                                                    <div class="pizza-img">
                                                        <img src="{{$product->image_url}}" alt="" class="img-fluid">
                                                    </div>
                                                    <span>{{$product->price}} $</span>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>



                                <h3>Additives</h3>
                                <div class="row">
                                    @foreach($products ->extras as $product)
                                    <div class="col-md-4">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck{{$product->id}}" name="extras[]"  value="{{$product->id}}" data-idadd="{{$product->id}}"  data-priceadd="{{$product->price}}"  onClick="click_click(this)">
                                            @if($product->name != null)
                                            <label class="custom-control-label checkbox-customize" for="customCheck{{$product->id}}">
                                                <p>{{$product->name}} <span class="box_price" id="box_price_{{$product->id}}">{{$product->price}}$+</span></p>
                                            </label>
                                            @endif
                                        </div>
                                    </div>
                                        @endforeach
                                </div>

                                <div class="line"></div>
                                <div class="size-add-footer">
                                    <div class="pizza-total">
                                        <input type="hidden" id="pizza_size_price" value="0">
                                        <input type="hidden" id="pizza_extra_price"  value="0">
                                        {{--<input type="hidden" id="total">--}}
                                        <p>Total:</p>
                                        <span id="total">0 </span><span>$</span>
                                    </div>
                                    <div>
                                        <div class="quantity">
                                            <input type="button" value="-" class="btn minus">
                                            <input step="1" min="1" max="" value="1" name="quantity" id="quantity" class="form-control text-center"
                                                   size="4"  inputmode="">
                                            <input type="button" value="+" class="btn plus">
                                        </div>
                                        <a  id="submit">Add to Cart</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="pizza1-carousel owl-carousel owl-theme">
                            @foreach ($entrees_product->chunk(4) as $chunk)
                            <div class="item">
                                <div class="row px-10">
                                    @foreach ($chunk as $product)
                                    <div class="col-12 col-md-6">
                                        <div class="pizza-box">
                                            <div class="pizza-img">
                                                <img src="{{$product->image_url}}" alt="" class="img-fluid">
                                            </div>
                                            <div class="pizza-body">
                                                <h3>{{$product->name}}</h3>
                                                <span class="ingredient">
                                                   @foreach($product->ingredients as $ingredient)
                                                        <p class="d-inline-block p-0">{{$ingredient->name}},</p>
                                                    @endforeach
                                                </span>
                                                @if($product->categories->add_size != 1)
                                                    <span class="d-block">{{$product->price}}$</span>
                                                @endif
                                                {{--<form action="{{route('cart.addToCart')}}" method="post">--}}
                                                    {{--{{ csrf_field() }}--}}
                                                    {{--<input type="hidden" value="{{ $product->id }}" id="id" name="id">--}}
                                                    {{--<input type="hidden" value="{{ $product->name }}" id="name" name="name">--}}
                                                    {{--<input type="hidden" value="{{ $product->price }}" id="price" name="price">--}}
                                                    {{--<input type="hidden" value="{{ $product->image_url }}" id="img" name="img">--}}
                                                    {{--<input type="hidden" value="1" id="quantity" name="quantity">--}}

                                                    @if($product->categories->add_size != 1)
                                                        <div class="add-to-cart">
                                                            <div class="quantity">
                                                                <input type="button" value="-" class="btn minus">
                                                                <input step="1" min="1" max="" value="1" class="form-control text-center" size="4" inputmode="" name="qty" id="qty">
                                                                <input type="button" value="+" class="btn plus">
                                                            </div>
                                                            <a  class="addInstructions" data-toggle="modal" href="#addInstructions" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->price }}" data-img="{{ $product->image_url }}" >Add to Cart</a>

                                                            {{--<button id="submit"   class="btn cart-btn">Add to Cart</button>--}}
                                                        </div>
                                                        @else
                                                        <div class="add-to-cart-2">
                                                            <a href="{{route('cart.category_product',$product->id)}}">Go to Details</a>
                                                        </div>
                                                    @endif


                                                {{--</form>--}}
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                          @endforeach
                        </div>
                    </div>
                </div>
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
        <div class="modal fade" id="addInstructions" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <p class="py-2">Leave instructions in this order</p>
                        <form action="" method="post" id="product">
                            {{ csrf_field() }}
                            <input type="hidden"  id="extra_id" name="id" value="">
                            <input type="hidden" id="extra_name" name="name"  value="">
                            <input type="hidden"  id="extra_price" name="price"  value="">
                            <input type="hidden"  id="extra_img" name="img"  value="">
                            <input type="hidden"  id="extra_quantity" name="quantity"  value="">
                            <input type="text" class="form-control" name="instructions" >
                            <div class="text-center mt-2">
                                <button id="submit1" class="btn cart-btn">Add to Cart</button>
                            </div>
                        </form>
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
            <script src="{{asset('front-asset/assets/js/owl.carousel.min.js')}}"></script>
            <script>
                var CartID = '';
                $('.pizza1-carousel').owlCarousel({
                    loop: true,
                    margin: 10,
                    nav: true,
                    dots: false,
                    autoplay: false,
                    autoplayTimeout: 2000,
                    autoplayHoverPause: true,
                    responsive: {
                        0: {
                            items: 1
                        },
                        576: {
                            items: 1
                        },
                        767: {
                            items: 1
                        },
                        991: {
                            items: 1
                        },
                        1200: {
                            items: 1
                        }
                    }
                })
                $(".addInstructions").click(function (e) {
                    //console.log($(this).data('id'))
                    $('#extra_name').val($(this).data('name'));
                    $('#extra_id').val($(this).data('id'));
                    $('#extra_price').val($(this).data('price'));
                    $('#extra_quantity').val($('#qty').val());
                    console.log($('#qty').val())
                    $('#extra_img').val($(this).data('img'));



                });
                $('#submit1').click(function(event) {
                    var form = $('#product');
                    $.ajax({
                        type        : 'POST',
                        url         : '{{route('cart.addToCart')}}',
                        data        : form.serialize(),
                        dataType    : 'json',
                        encode          : true
                    }).done(function(data) {

                        location.reload();

                    }).fail(function(data){

                    });
                    event.preventDefault();
                });
            </script>
            <script>
                $('.btn.plus').off().click(function (e) {
                    var input = $(this).prev($('.quantity-input'));
                    input.val(+input.val() + 1);
                    $("#total").text();
                    $("input[name='qty']").val(+input.val())
                    let total= $("#price").val()*$("#quantity").val();
                    $("#total").text(total);


                });
                $('.btn.minus').off().click(function (e) {
                    var input = $(this).next($('.quantity-input'));
                    input.val(input.val() != "1" ? +input.val() - 1 : input.val());
                    $("#total").text();
                    let total= $("#price").val()*$("#quantity").val();
                    $("#total").text(total);
                    $("input[name='qty']").val(input.val())
                });

            </script>

            <script>
                $(document).ready(function() {



                    // process the form

                    $('#submit').click(function(event) {
                        $(".error").remove();
                        var form = $('#PizzaForm');
                        $.ajax({
                            type        : 'POST',
                            url         : '{{route('cart.store')}}',
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
                            var erorrMassage = "Please Select Size !. ";
                            var id=$('#id').val();
                            var size=$('#customRadioInline_'+id).val();
                        if (size ==null) {

                                $("#error").html('<h3 style="color:#d61030;">'+erorrMassage+'</h3>')
                            }
                        });
                        event.preventDefault();
                    });

                });

            </script>
            <script>

                function type_click(e)
                {

                    let id= $(e).data('pizzasizeid')
                    let pizzasize= $(e).data('pizzasize')
                    let pizzasizename= $(e).data('pizzasizename')
                    let pizzasizeprice= $(e).data('pizzasizeprice')
                    console.log(pizzasize,id,pizzasizename,pizzasizeprice)
                    // $('.pizza-total').empty();
                    if($('#customRadioInline'+id).is(':checked')) {
                        $("#pizza_size_price").val(pizzasizeprice)
                        let a=parseFloat($("#pizza_size_price").val());
                        let b=parseFloat($("#pizza_extra_price").val());
                        let sub_total=(a+b).toFixed(2);
                        console.log(sub_total)
                     //  $("#total").text(total);
                       $("#price").val(a);
                        let total=$("#price").val() *  $("#quantity").val();

                        $("#total").text(total);
                    }
                    click_click()


                }
                function click_click(e)
                {
                    let id= $(e).data('idadd')
                    let price= $(e).data('priceadd')
                    let pizza_size_price= $('#pizza_size_price').val();

                    // console.log(price,id);
                    if($('#customCheck'+id).is(':checked')) {
                        // checked
                      //  console.log(addtotal)
                        let sum = 0;

                        $("input[type=checkbox]:checked").each(function(){
                            sum += parseFloat($(this).data('priceadd'));
                        });

                        $('#pizza_extra_price').val(sum);

                    }
                    else{
                        $(".pizza_extra_price").empty();
                        let sum = 0;

                        $("input[type=checkbox]:checked").each(function(){
                            sum += parseFloat($(this).data('priceadd'));
                        });

                        $('#pizza_extra_price').val(sum);

                    }


                    let a=parseFloat($("#pizza_size_price").val());
                    let b=parseFloat($("#pizza_extra_price").val());
                    let total=(a+b).toFixed(2);
                  //  console.log(a,b,a+b,total)
                    let sub_total=total *$("#quantity").val();;
                    //console.log(total)
                    $("#total").text(sub_total);

                    //console.log(sub_total)
                   $("#price").val(total);



                }
//                function recalculate(){
//                    var sum = 0;
//
//                    $("input[type=checkbox]:checked").each(function(){
//                        sum += parseFloat($(this).data('priceadd'));
//                    });
//
//                    $('#pizza_extra_price').val(sum);
//                }

                function addDetailsToForm() {

                    $('#details').val($('#instructions_1').val());
                    $('#card_id').val(CartID);
                    $('#submit').click();
                }
            </script>
        @endpush

    @stop