@extends('front_layout.main')
@push('style')
    <style>
        </style>
    @endpush
@section('content')

    <div class="desktop">
        <section class="categories-section">
            <div class="container">
                <div class="categories-carousel owl-carousel owl-theme">
                    @foreach($categories as $category)
                        @if($category->id !=18 &$category->id !=19)
                        <div class="item">
                            <a href="{{route('front.product_category',$category->id)}}" class="category-box" style="background-image: url({{$category->image_url}});">
                                <span>{{$category->name}}</span>
                            </a>
                        </div>
                            @else
                            @if($category->id !=18)
                                <div class="item">
                                    <a href="{{route('front.build_your_calzone')}}" class="category-box" style="background-image: url({{$category->image_url}});">
                                        <span>{{$category->name}}</span>
                                    </a>
                                </div>
                            @endif

                            @if($category->id !=19)

                                <div class="item">
                                    <a href="{{route('front.build_your_pizza')}}" class="category-box" style="background-image: url({{$category->image_url}});">
                                        <span>{{$category->name}}</span>
                                    </a>
                                </div>
                            @endif
                        @endif

                    @endforeach

                </div>
            </div>
        </section>
    </div>

    <div class="mobile">
        <section class="mobile-category">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="tap-nav">
                            <a href="{{route('front.build_your_pizza')}}" class="tap-nav-head">
                                <h4>Build you pizza</h4>
                                <span><i class="fas fa-reply"></i></span>
                            </a>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="tap-nav">
                            <a href="{{route('front.build_your_calzone')}}" class="tap-nav-head">
                                <h4>Build you Calzone</h4>
                                <span><i class="fas fa-reply"></i></span>
                            </a>
                        </div>
                    </div>
                       @foreach($categories_mobile as $category)
                       @if($category->id !=1)
                            <div class="col-12">
                                <div class="tap-nav">
                                    <div class="tap-nav-head">
                                        <h4>{{$category->name}}</h4>
                                        <span><i class="fas fa-chevron-down"></i></span>
                                    </div>

                                    <div class="tap-nav-desc">
                                        @foreach($category->products as $product)
                                        <div class="product">
                                            <div class="row mx-0">
                                                <div class="col-7">
                                                    <div class="info">
                                                        <h5>{{$product->name}}</h5>
                                                        <span>{{$product->price}} $</span>
                                                        <div class="main-p">
                                                            @foreach($product->ingredients as $ingredient)
                                                                <p>{{$ingredient->name}},</p>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-5 d-flex justify-content-end">
                                                    <div class="img">
                                                        <img src="{{$product->image_url}}" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    {{--<form action="{{route('cart.addToCart')}}" method="post">--}}
                                                        {{--{{ csrf_field() }}--}}
                                                        {{--<input type="hidden" value="{{ $product->id }}" id="id" name="id">--}}
                                                        {{--<input type="hidden" value="{{ $product->name }}" id="name" name="name">--}}
                                                        {{--<input type="hidden" value="{{ $product->price }}" id="price" name="price">--}}
                                                        {{--<input type="hidden" value="{{ $product->image_url }}" id="img" name="img">--}}
                                                    <div class="add-to-cart">
                                                        <div class="quantity">
                                                            <input type="button" value="-" class="btn minus">
                                                            <input step="1" min="1" max="" value="1" class="form-control text-center" name="qty"
                                                                   size="4" inputmode="">
                                                            <input type="button" value="+" class="btn plus">
                                                        </div>
                                                        <a  class="btn index-link addInstructions" data-toggle="modal" href="#addInstructions" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->price }}" data-img="{{ $product->image_url }}" >Add to Cart</a>

                                                        {{--<button class="btn index-link">Add</button>--}}
                                                    </div>
                                                    {{--</form>--}}
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>

                        @else
                            <div class="col-12">
                                <div class="tap-nav">
                                    <div class="tap-nav-head">
                                        <h4>{{$category->name}}</h4>
                                        <span><i class="fas fa-chevron-down"></i></span>
                                    </div>
                                    <div class="tap-nav-desc">
                                        @foreach($category->products as $product)
                                            <div class="product">
                                                <div class="row mx-0">
                                                    <div class="col-7">
                                                        <div class="info">
                                                            <h5>{{$product->name}}</h5>
                                                            <span>{{$product->price}} $</span>
                                                            <div class="main-p">
                                                                @foreach($product->ingredients as $ingredient)
                                                                    <p>{{$ingredient->name}},</p>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5 d-flex justify-content-end">
                                                        <div class="img">
                                                            <img src="{{ $product->image_url }}" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="add-to-cart">
                                                            <a href="{{route('cart.category_product',$product->id)}}" class="btn index-link"> Details</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                           @endif
                   @endforeach




                </div>
            </div>
        </section>
    </div>

    <section class="about-us-section">
        <div class="container">
            <div class="row">
                {{--<div class="col-12">--}}
                    {{--<a class="index-link" href="{{route('product')}}">Order Now</a>--}}
                {{--</div>--}}
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-12 pb-10 px-5">
                            <div class="about-box">
                                <div class="top-about-box">
                                    <div class="left-side">
                                        <img src="{{asset('front-asset/assets/images/clock.png')}}" alt="" class="img-fluid">
                                        <span>open today</span>
                                    </div>
                                    <div class="right-side">
                                        <p>from <span>{{$setting->time_from}}</span></p>
                                        <p>to <span>{{$setting->time_to}}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 pb-20 px-5">
                            <div class="about-box">
                                <div class="top-about-box">
                                    <div class="left-side">
                                        <img src="{{asset('front-asset/assets/images/phone.png')}}" alt="" class="img-fluid">
                                    </div>
                                    <div class="right-side">
                                        <img src="{{asset('front-asset/assets/images/pizza-slice-1.png')}}" alt="" class="img-fluid">
                                    </div>
                                </div>
                                <div class="down-about-box">
                                    <p>{{$setting->mobile_1}}</p>
                                    <p>{{$setting->email}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 pb-20 px-5">
                            <div class="about-box">
                                <div class="top-about-box">
                                    <div class="left-side">
                                        <img src="{{asset('front-asset/assets/images/location.png')}}" alt="" class="img-fluid">
                                    </div>
                                    <div class="right-side">
                                        <img src="{{asset('front-asset/assets/images/cloth.png')}}" alt="" class="img-fluid">
                                    </div>
                                </div>
                                <div class="down-about-box">
                                    <p>{!! $setting->address_1 !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="map text-center">
                        {!!  $setting->iframe!!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="addInstructions" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <p class="py-2">Leave instructions in this order</p>
                    <form action="" method="post" id="product">
                        {{ csrf_field() }}
                        <input type="hidden"  id="id" name="id" value="">
                        <input type="hidden" id="name" name="name"  value="">
                        <input type="hidden"  id="price" name="price"  value="">
                        <input type="hidden"  id="img" name="img"  value="">
                        <input type="hidden"  id="quantity" name="quantity"  value="">
                        <input type="text" class="form-control" name="instructions" >
                        <div class="text-center mt-2">
                            <button id="submit" class="btn cart-btn">Add to Cart</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function () {
                $('.tap-nav-head').on('click', function () {
                    $('.tap-nav-head').not(this).find('i').removeClass('fa-chevron-up');
                    $('.tap-nav-head').not(this).find('i').addClass('fa-chevron-down');
                    $(this).find('i').toggleClass('fa-chevron-down');
                    $(this).find('i').toggleClass('fa-chevron-up');
                    $('.tap-nav-head').not(this).removeClass('active');
                    $(this).toggleClass('active');
                    $('.tap-nav-head').not(this).siblings('.tap-nav-desc').slideUp();
                    $(this).siblings('.tap-nav-desc').slideToggle();
//                    $('.tap-nav-head').not(this).siblings('.tap-nav-desc').removeClass('show');
//                    $(this).siblings('.tap-nav-desc').toggleClass('show');
                });
            });

            $(".addInstructions").click(function (e) {
                console.log($(this).data('id'))
                $('#name').val($(this).data('name'));
                $('#id').val($(this).data('id'));
                $('#price').val($(this).data('price'));
                $('#quantity').val($("input[name='qty']").val());
                $('#img').val($(this).data('img'));



            });
            $('#submit').click(function(event) {
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
    @endpush
    @stop