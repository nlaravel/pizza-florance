
<div class="navbar-header">
    <ul class="nav navbar-nav flex-row">
        <li class="nav-item mr-auto"><a class="navbar-brand" href="{{route('front.index')}}">
                <div class="brand-logo"></div>
                <h2 class="brand-text mb-0">Florence Pizza</h2>
            </a></li>
        <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li>
    </ul>
</div>

<div class="shadow-bottom"></div>
<div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class=" nav-item"><a href="{{route('dashboard')}}"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">@lang('lang.Home')</span></a>

        </li>

        {{--<li class="nav-item has-sub sidebar-group-active"><a href=""><i class="feather icon-file"></i><span class="menu-title" data-i18n="Ecommerce">@lang('lang.LandingPage')</span></a>--}}
            {{--<ul class="menu-content" style="">--}}
                {{--<li class=" nav-item"><a href="{{route('about_us.index')}}"><i class="feather icon-info"></i><span class="menu-title" data-i18n="program">@lang('lang.about_us')</span></a>--}}
                {{--</li>--}}
            {{--</ul>--}}
        {{--</li>--}}

        <li class=" nav-item"><a href="{{route('category.index')}}"><i class="feather icon-server"></i><span class="menu-title" data-i18n="User">Category</span></a>
        </li>

        {{--<li class=" nav-item"><a href="{{route('entrees.index')}}"><i class="feather icon-plus-square"></i><span class="menu-title" data-i18n="User">Entrees</span></a>--}}

        {{--</li>--}}
        <li class=" nav-item"><a href="{{route('product.index')}}"><i class="feather icon-layers"></i><span class="menu-title" data-i18n="User">Product</span></a>

        </li>
        {{--<li class=" nav-item"><a href="{{route('day.index')}}"><i class="feather icon-box"></i><span class="menu-title" data-i18n="User">Day</span></a>--}}

        {{--</li>--}}
        <li class=" nav-item"><a href="{{route('order.index')}}"><i class="feather icon-box"></i><span class="menu-title" data-i18n="User">Order</span></a>

        </li>
        <li class=" nav-item"><a href="{{route('ingredient.index')}}"><i class="feather icon-grid"></i><span class="menu-title" data-i18n="User">Ingredient</span></a>

        </li>
        <li class="nav-item has-sub sidebar-group-active"><a href=""><i class="feather icon-file-text"></i><span class="menu-title" data-i18n="Ecommerce">Build Your Pizza</span></a>
            <ul class="menu-content" style="">
                <li class=" nav-item"><a href="{{route('pizza_category.index')}}"><i class="feather icon-info"></i><span class="menu-title" data-i18n="program">Add Type of Ingredient/Ingredients </span></a>
                </li><li class=" nav-item"><a href="{{route('pizza_size.index')}}"><i class="feather icon-info"></i><span class="menu-title" data-i18n="program">Add Pizza Size </span></a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-sub sidebar-group-active"><a href=""><i class="feather icon-file-text"></i><span class="menu-title" data-i18n="Ecommerce">Build Your Calzone</span></a>
            <ul class="menu-content" style="">
                <li class=" nav-item"><a href="{{route('calzone_category.index')}}"><i class="feather icon-info"></i><span class="menu-title" data-i18n="program">Add Type of Ingredient/Ingredients </span></a>
                </li><li class=" nav-item"><a href="{{route('calzone_size.index')}}"><i class="feather icon-info"></i><span class="menu-title" data-i18n="program">Add Calzone Size </span></a>
                </li>
            </ul>
        </li>
        <li class=" nav-item"><a href="{{route('coupon.index')}}"><i class="fa fa-barcode"></i><span class="menu-title" data-i18n="User">Coupons </span></a>

        </li>
        <li class=" nav-item"><a href="{{route('terms.index')}}"><i class="feather icon-info"></i><span class="menu-title" data-i18n="User">Terms & Conditions </span></a>

        </li>
        <li class=" nav-item"><a href="{{route('setting.index')}}"><i class="feather icon-settings"></i><span class="menu-title" data-i18n="User">@lang('lang.Setting')</span></a>

        </li>

        <li class=" nav-item"><a href="{{route('contact.index')}}"><i class="feather icon-mail"></i><span class="menu-title" data-i18n="User">Contact List</span></a>

        </li>
        <li class=" nav-item"><a href="{{route('payment.index')}}"><i class="fa fa-credit-card"></i><span class="menu-title" data-i18n="User">Payments Methods</span></a>

        </li>

        <li class=" nav-item"><a href="{{route('state.index')}}"><i class="feather icon-map"></i><span class="menu-title" data-i18n="User">State</span></a>

        </li>
        <li class=" nav-item"><a href="{{route('city.index')}}"><i class="feather icon-map-pin"></i><span class="menu-title" data-i18n="User">Delivery Region</span></a>

        </li>

    </ul>
</div>