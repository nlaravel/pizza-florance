<!DOCTYPE html>
<html lang="en">

<head>
    @include('front_layout.head')
    @stack('style')
</head>

<body>
<div class="overlay"></div>

<header>
  @include('front_layout.header')
</header>

@yield('content')

@include('front.cart')


<script src="{{asset('front-asset/assets/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{asset('front-asset/assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('front-asset/assets/js/owl.carousel.min.js')}}"></script>
<script>

    $(document).ready(function(){
        if ($(window).width() < 576) {
            var scrollTop =0;
            $(window).scroll(function(){
                scrollTop = $(window).scrollTop();
                if (scrollTop > 101){
                    $('.navbar').addClass ('scrollNav');
                }else if (scrollTop == 0){
                    $('.navbar').removeClass('scrollNav');
                }
            });
        }
    });

    $('.categories-carousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        dots: false,
        autoplay: false,
        autoplayTimeout: 2000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 2
            },
            576: {
                items: 3
            },
            767: {
                items: 4
            },
            991: {
                items: 5
            },
            1200: {
                items: 6
            }
        }
    })
</script>

    <script>


    function openNav() {
        $('.side-cart').addClass('active');
        $('.overlay').addClass('active');
    }
    $('.overlay, .side-cart-close-btn, .close-btn').on('click', function () {
        $('.side-cart').removeClass('active')
        $('.overlay').removeClass('active');
    });
</script>
<script>
    $('.btn.plus').off().click(function (e) {
        var input = $(this).prev($('.quantity-input'));
        input.val(+input.val() + 1);
        $("input[name='qty']").val(+input.val());
        //console.log()

    });
    $('.btn.minus').off().click(function (e) {
        var input = $(this).next($('.quantity-input'));
        input.val(input.val() != "1" ? +input.val() - 1 : input.val());
        $("input[name='qty']").val(input.val())
    });
</script>
<script>
    $(document).ready(function() {



        // process the form

        $('#submit_applyCoupon').click(function(event) {
            event.preventDefault();
            event.stopPropagation();

            $(".error").remove();
            var form = $('#applyCoupon');

            $.ajax({
                type        : 'POST',
                url         : '{{route('cart.applyCoupon')}}',
                data        : form.serialize(),
                dataType    : 'json',
                encode          : true
            }).done(function(data) {
                console.log(data.Message)
                $('#message').text(data.Message)
                $('.coupon_alert').addClass('d-block');
                location.reload();
                $('.side-cart').addClass('active');
                $('.overlay').addClass('active');
            }).fail(function(data){
                $('#message').text('This Coupon is un Correct')   ;
                $('.coupon_alert').addClass('d-block');
            });
            event.preventDefault();
        });

    });
</script>
@stack('scripts')
</body>

</html>