

<header class="header-area header-style-1 header-height-2 text-white" style="background-color: #8eb4f4; border-bottom: 1px solid black;">
    <div class="header-top header-top-ptb-1 d-none d-lg-block" style="background-color: #111111">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-2 col-lg-4">
                    <div class="header-info">
                        <ul>
                            <li><i class="fi-rs-smartphone text-white"></i> <a href="#" class="text-white">{{$setting->contact_phone ?? '01310993183'}}</a></li>
                            <li><i class="fi-rs-marker text-white"></i><a  href="" class="text-white">Our location</a></li>
                        </ul>
                    </div>
                </div>


                <div class="col-xl-3 col-lg-4">
                    <div class="header-info header-info-right">
                        <ul>
                            @if(auth()->check())

                                    <li>
                                        <a class="language-dropdown-active text-white" href="#"> <i
                                                class="fi-rs-user"></i> {{auth()->user()->name}} <i
                                                class="fi-rs-angle-small-down"></i></a>
                                        <ul class="language-dropdown">
                                            <li><a href="{{ route('customer.dashboard') }}"><i class="fi-rs-home"></i>Dashboard</a></li>
                                            <li><a href="{{route('customer-logout')}}" onclick="return confirm('are you sure to logout ?')"><i class="fi-rs-lock"></i>Logout</a>
                                            </li>
                                        </ul>
                                    </li>

                                @else
                                <li class="text-white"><i class="fi-rs-user"></i><a class="text-white" href="{{route('login-register')}}">Log In / Sign Up</a>
                                </li>
                            @endif
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-middle header-middle-ptb-1 d-none d-lg-block sticky-bar" style="background-color: #8eb4f4">
        <div class="container">
            <div class="header-wrap">
                <div class="logo logo-width-1">
                    <a href="{{route('home')}}">
                        @if(!isset($setting->logo_png))
                            <h4>{{$setting->company_name}}</h4>
                        @else
                            <img src="{{asset($setting->logo_png)}}" alt="{{$setting->company_name}}">
                        @endif
                    </a>
                </div>
                <div class="header-right">
                    <div class="search-style-2">
                        <form action="#">
                            <input class="" id="globalSearch" type="text" placeholder="Search products..." autocomplete="off"/>
                        </form>
                    </div>
                    <div class="header-action-right">
                        <div class="header-action-2">
                            <div class="header-action-icon-2">
                                <a href="{{ route('product-all') }}">
                                    <img class="svgInject" alt="Evara" src="{{asset('/')}}website/assets/imgs/theme/new-product_1474713.png">
                                    <span class="pro-count blue" id="">
                                    <small>{{ \App\Models\Product::where('status',1)->count() }}</small>
                                    </span>
                                </a>
                            </div>

                            <div class="header-action-icon-2">

                                <a class="mini-cart-icon" href="{{ route('cart.index') }}">
                                    <img alt="Evara" src="{{asset('/')}}website/assets/imgs/theme/icons/icon-cart.svg">
                                    <span class="pro-count blue" id="CartItemCount">
                                        @if(auth()->check())
                                        <small>{{ \App\Models\Cart::where('customer_id',auth()->user()->id)->count() }}</small>
                                        @else
                                            <small>0</small>
                                        @endif
                                    </span>
                                </a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2" id="cartItems">
                                    {{-- div append here ajaxcartitem blade --}}
                                    <ul>
                                        @if(auth()->check())
                                        @php( $sum = 0 )
                                        @php($cartItems = \App\Models\Cart::where('customer_id',auth()->user()->id)->get())
                                        @foreach($cartItems as $cartItem)
                                            <li>
                                                <div class="row">
                                                    <div class="col-2">
                                                        <a href="">
                                                            <img alt="Evara" src="{{asset($cartItem->image)}}">
                                                        </a>
                                                    </div>
                                                    <div class="col-9">
                                                        <div class="shopping-cart-title">
                                                            <h4><a href="">{{ $cartItem->name }}</a></h4>
                                                            <h5>
                                                                @if($cartItem->product->discount_type == 0)
                                                                    {{ $price =  $cartItem->product->regular_price - $cartItem->product->discount_value }} x {{$cartItem->qty}}
                                                                @elseif($cartItem->product->discount_type == 1)
                                                                    {{ $price = $cartItem->product->regular_price - (($cartItem->product->regular_price * $cartItem->product->discount_value)/100) }} x {{$cartItem->qty}}
                                                                @else
                                                                    {{ $price = $cartItem->product->selling_price }} x {{$cartItem->qty}}
                                                                @endif
                                                            </h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-1">
                                                        <div class="shopping-cart-delete">
                                                            <a href="{{route('cart.delete', $cartItem->id)}}" onclick="return confirm('Are you sure to remove this..')"><i class="fi-rs-cross-small"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            @php($sum = $sum + $price)
                                        @endforeach
                                        <li class="justify-content-center"><a href="{{ route('cart.index') }}">See All</a></li>
                                    </ul>
                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total">
                                            <h4>Total <span>TK. {{ $sum }}</span></h4>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="{{ route('cart.index') }}" class="outline">View cart</a>
                                            <a href="{{ route('checkout') }}">Checkout</a>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom header-bottom-bg-color">
        <div class="container">
            <div class="header-wrap header-space-between" style="top: 0">
                <div class="logo logo-width-1 d-block d-lg-none">
                    <a href="{{route('home')}}">
                        @if(empty($setting->logo_png))
                            <h4>{{$setting->company_name}}</h4>
                        @else
                            <img src="{{asset($setting->logo_png)}}" alt="{{$setting->company_name}}">
                        @endif
                    </a>
                </div>
                <div class="header-nav d-none d-lg-flex">
                    <div class="main-categori-wrap d-none d-lg-block">
                        <a class="categori-button-active text-dark" href="#">
                            <span class="fi-rs-apps text-dark"></span> Browse Categories
                        </a>
                        <div class="categori-dropdown-wrap categori-dropdown-active-large" style="z-index:10000;">
                            <ul>
                                @foreach($categories as $category)
                                    <li class="">
                                        <a href="{{route('product-category',$category->slug)}}"><i class="evara-font-dress"></i>{{$category->name}}</a>

                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="hotline d-none d-lg-block">
                    <p class="text-danger"><i class="fi-rs-headset"></i><span>Hotline</span> {{$setting->support_phone}} </p>

                </div>
                {{--<p class="mobile-promotion">Happy <span class="text-brand">Mother's Day</span>. Big Sale Up to 40%</p>--}}
                <div class="header-action-right d-block d-lg-none">
                    <div class="header-action-2">
                        <div class="header-action-icon-2">
                            <a href="{{ route('product-all') }}">
                                <img class="svgInject" alt="Evara" src="{{asset('/')}}website/assets/imgs/theme/new-product_1474713.png">
                                <span class="pro-count blue" id="wishlistCartCount">
                                    <small>{{ \App\Models\Product::where('status',1)->count() }}</small>
                                </span>
                            </a>
                        </div>

                        <div class="header-action-icon-2">
                            <a class="mini-cart-icon" href="{{ route('cart.index') }}">
                                <img alt="Evara" src="{{asset('/')}}website/assets/imgs/theme/icons/icon-cart.svg">
                                <span class="pro-count blue" id="CartItemCount">
                                    @if(auth()->check())
                                        <small>{{ \App\Models\Cart::where('customer_id',auth()->user()->id)->count() }}</small>
                                    @else
                                        <small>0</small>
                                    @endif
                                </span>
                            </a>
                            <div class="cart-dropdown-wrap cart-dropdown-hm2" id="cartItems">
                                {{-- div append here ajaxcartitem blade --}}
                                <ul>
                                    @if(auth()->check())
                                    @php( $sum = 0 )
                                    @php($cartItems = \App\Models\Cart::where('customer_id',auth()->user()->id)->latest()->take(5)->get())
                                    @php($seeALlCartItems = \App\Models\Cart::where('customer_id',auth()->user()->id)->count())
                                    @foreach($cartItems as $cartItem)
                                        <li>
                                            <div class="row">
                                                <div class="col-2">
                                                    <a href="">
                                                        <img alt="Evara" src="{{asset($cartItem->image)}}">
                                                    </a>
                                                </div>
                                                <div class="col-9">
                                                    <div class="shopping-cart-title">
                                                        <h4><a href="">{{ $cartItem->name }}</a></h4>
                                                        <h5>
                                                            <span>{{ $cartItem->qty }} × {{ $cartItem->product->selling_price }}</span>
                                                            <span> = {{$total = $cartItem->qty * $cartItem->product->selling_price }}</span>

                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="col-1">
                                                    <div class="shopping-cart-delete">
                                                        <a href="{{route('cart.delete', $cartItem->id)}}" onclick="return confirm('Are you sure to remove this..')"><i class="fi-rs-cross-small"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        @php($sum = $sum + $total)
                                    @endforeach
                                    @if($seeALlCartItems > 4)
                                        <li class="justify-content-center">
                                            <a href="{{ route('cart.index') }}">See All</a></li>
                                    @endif
                                </ul>
                                <div class="shopping-cart-footer">
                                    <div class="shopping-cart-total">
                                        <h4>Total <span>TK. {{ $sum }}</span></h4>
                                    </div>
                                    <div class="shopping-cart-button">
                                        <a href="{{ route('cart.index') }}" class="outline">View cart</a>
                                        <a href="{{ route('checkout') }}">Checkout</a>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="header-action-icon-2 d-block d-lg-none">
                                <div class="burger-icon burger-icon-white">
                                    <span class="burger-icon-top"></span>
                                    <span class="burger-icon-mid"></span>
                                    <span class="burger-icon-bottom"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="mobile-header-active mobile-header-wrapper-style bg-dark">
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-top">
            <div class="mobile-header-logo">
                <a href="{{route('home')}}">
                    @if(empty($setting->logo_png))
                        <h4>{{$setting->company_name}}</h4>
                    @else
                        <img src="{{asset($setting->logo_png)}}" alt="{{$setting->company_name}}">
                    @endif
                </a>
            </div>
            <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                <button class="close-style search-close">
                    <i class="icon-top"></i>
                    <i class="icon-bottom"></i>
                </button>
            </div>
        </div>
        <div class="mobile-header-content-area">
            <div class="mobile-search search-style-3 mobile-header-border form-group">
                <form action="#">
                    <input class="" id="globalSearchMobile" type="text" placeholder="Search for items…">
                </form>
            </div>
            <div class="mobile-menu-wrap mobile-header-border">
                <div class="main-categori-wrap mobile-header-border text-white">
                    <a class="categori-button-active-2 text-white" href="#">
                        <span class="fi-rs-apps text-white"></span> Browse Categories
                    </a>
                    <div class="categori-dropdown-wrap categori-dropdown-active-small">
                        <ul>
                            @foreach($categories as $category)
                            <li>
                                <a class="text-white" href="{{route('product-category',$category->slug)}}"><i class="evara-font-dress text-white"></i>{{$category->name}}</a>

                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- mobile menu start -->

                <!-- mobile menu end -->
            </div>
            <div class="mobile-header-info-wrap mobile-header-border">
                <div class="single-mobile-header-info">
                    @if(auth()->check())
                        @if(auth()->user()->role == 'customer')
                        <a class="language-dropdown-active" href="#"> <i
                                class="fi-rs-user"></i> {{auth()->user()->name}} </a>
                        <ul class="language-dropdown">
                            <li><a class="text-white" href="{{ route('customer.dashboard') }}"><i class="fi-rs-home text-white"></i> Dashboard</a></li>
                            <li><a class="text-white" href="{{route('customer-logout')}}" onclick="return confirm('are you sure to logout ?')"><i class="fi-rs-lock text-white"></i> Logout</a>
                            </li>
                        </ul>
                        @else
                            <a class="text-white" href="{{route('login-register')}}">Log In / Sign Up </a>
                        @endif
                    @else
                        <a class="text-white" href="{{route('login-register')}}">Log In / Sign Up </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
