@extends('front_layout.main')
@push('style')
    <style>
    </style>
@endpush
@section('content')
    <section class="contact-section">
        <div class="container">
            <h2 class="title">Contact Us</h2>
            <div class="row">
                <div class="col-lg-6 pt-10">
                    <div class="row">
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
                                    <p>Palestine, Ramallah, <br> Ersal Street, Safina BLD</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="map text-center">
                                {!!  $setting->iframe!!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 pt-10">
                    <form id="contactForm" name="contact_form" class="" action="" method="post">
                    @csrf
                        <div class="row">
                            <div class="col-6">
                                <input type="text" class="form-control" placeholder="First Name" id="first_name" name="first_name">
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control" placeholder="Last Name" id="last_name" name="last_name">
                            </div>
                            <div class="col-12">
                                <input type="email" class="form-control" placeholder="Email Address" id="email" name="email">
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control" placeholder="Subject" id="subject" name="subject">
                            </div>
                            <div class="col-12">
                                <textarea class="form-control" rows="5" placeholder="Type Your Message"  name="message" id="message"></textarea>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button class="btn" type="button" id="submit">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script>

            $(document).ready(function() {

                // process the form

                $('#submit').click(function(event) {
                    var form = $('#contactForm');

                    $.ajax({
                        type        : 'POST',
                        url         : '{{route("front.storeContactUs")}}',
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
                            $("input[name='"+index+"']" ).parent().append('<span class="test" style="color: red;">' + value + '</span>');
                            $("textarea[name='"+index+"']" ).parent().append('<span class="test" style="color: red;">' + value + '</span>');

                        });
                    });
                    event.preventDefault();
                });

            });
        </script>
    @endpush
@stop