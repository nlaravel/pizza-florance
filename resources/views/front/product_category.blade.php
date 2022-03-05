@extends('front_layout.main')
@push('style')
    <style>
    </style>
@endpush
@section('content')
    <section class="pizza-section">
        <div class="container">
            <div class="page-title">
                <h2 class="title">{{$category->name}}</h2>
                {{--<div class="titled-price">--}}
                {{--<p>10 inch<span>10.99 $</span></p>--}}
                {{--<div class="line"></div>--}}
                {{--<p>12 inch<span>13.99 $</span></p>--}}
                {{--<div class="line"></div>--}}
                {{--<p>14 inch<span>16.99 $</span></p>--}}
                {{--<div class="line"></div>--}}
                {{--<p>18 inch<span>23.99 $</span></p>--}}
                {{--</div>--}}
            </div>


            <div class="pizza-carousel owl-carousel owl-theme">
                @foreach ($products->chunk(8) as $chunk)
                <div class="item">
                    <div class="row px-10">

                        @if($category->id ==4)
                            <div class="col-12 col-md-6 col-lg-3">
                                <div class="pizza-box">
                                    <div class="pizza-img">
                                        <img src="{{asset('front-asset/assets/images/Calzone.png')}}" alt="" class="img-fluid">
                                    </div>
                                    <div class="pizza-body">
                                        <h3>Build your Calzone</h3>
                                        <span class="ingredient">  </span>

                                        <div class="add-to-cart-2">
                                            <a href="{{route('front.build_your_calzone')}}">Go to Details</a>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        @endif


                        @foreach($chunk as $product)

                            <div class="col-12 col-md-6 col-lg-3">
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
                                            {{--<div class="add-to-cart">--}}
                                            {{--<a href="#">Add to Cart</a>--}}
                                            {{--</div>--}}

                                                {{--<div class="quantity">--}}
                                                {{--<input type="button" value="-" class="btn minus">--}}
                                                {{--<input step="1" min="1" max="" value="1" class="form-control text-center" size="4" pattern="" inputmode="">--}}
                                                {{--<input type="button" value="+" class="btn plus">--}}
                                                {{--</div>--}}
                                            @if($product->categories->add_size != 1)
                                                <div class="add-to-cart">
                                                    <div class="quantity">
                                                        <input type="button" value="-" class="btn minus">
                                                        <input step="1" min="1" max="" value="1" class="form-control text-center" size="4" inputmode="" name="qty">
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
        {{--<script>--}}
            {{--$(document).ready(function() {--}}
                {{--$('.side-cart').addClass('active');--}}
                {{--$('.overlay').addClass('active');--}}
            {{--});--}}
        {{--</script>--}}
        <script src="{{asset('front-asset/assets/js/owl.carousel.min.js')}}"></script>

        <script>
            $('.pizza-carousel').owlCarousel({
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    @endpush
@stop