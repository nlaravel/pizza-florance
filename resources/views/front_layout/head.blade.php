<?php
$setting=\App\Setting::first();
?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>PIZZA</title>
<link rel="icon" href="{{$setting->favicon_url}}">
<link rel="stylesheet" href="{{asset('front-asset/assets/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('front-asset/assets/fontawesome/css/all.min.css')}}">
<link rel="stylesheet" href="{{asset('front-asset/assets/css/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{asset('front-asset/assets/css/owl.theme.default.min.css')}}">
<link rel="stylesheet" href="{{asset('front-asset/assets/css/animate.css')}}">
<link rel="stylesheet" href="{{asset('front-asset/assets/css/hover-min.css')}}">
<link rel="stylesheet" href="{{asset('front-asset/assets/css/style.css')}}">
<link rel="stylesheet" href="{{asset('front-asset/assets/css/media.css')}}">