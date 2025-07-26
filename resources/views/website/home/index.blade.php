@extends('website.master')
@section('title',"home")
@section('body')
    <style>
        .productartheight{
            height: 500px;
        }
        @media  (max-width: 768px){
            .imageHeight{
                width: 50%;
                height: auto;
            }
        }
        @media  (max-width: 575px){
            .imageHeight{
                width: 70%;
                height: auto;
            }
            .product-cart-wrap{
                height: 400px;
            }
        }
        .short-popup {
            position: fixed;
            bottom: 20px;
            width: 300px;
            padding: 10px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            z-index: 1;
        }
        .short-popup.left {
            left: 20px;
        }
        .short-popup.right {
            right: 20px;
        }

        .close-popup {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: transparent;
            border: none;
            font-size: 25px;
            cursor: pointer;
            color: red;
        }
        ​@media only screen and (max-width: 600px) {
            .sectionContainerBackground {
                background-color: lightblue;
            }
        }
    </style>

    <div class="container" bis_skin_checked="1">
        <div class="row align-items-center slider-animated-1" bis_skin_checked="1">
            <div class="col-lg-5 col-md-6" bis_skin_checked="1">
                <div class="hero-slider-content-2" bis_skin_checked="1">
                    <h4 class="animated">25 % Offer</h4>
                    <h2 class="animated fw-900"></h2>
                    <h1 class="animated fw-900 text-brand"></h1>
                    <p class="animated"></p>
                    <a class="animated btn btn-brush btn-brush-2" href="{{route('product-all')}}" tabindex="-1"> Shop Now  <i class="fi-rs-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-lg-7 col-md-6" bis_skin_checked="1">
                <div class="single-slider-img single-slider-img-1" bis_skin_checked="1">
                    <img class="animated slider-1-1 img-fluid w-100 h-auto" src="https://taraashi.devnahid.com/admin/img/product-offer-images/1729189525.png" alt="" style="width: 100%">
                </div>
            </div>
        </div>
    </div>
    <section class="section-padding">
        <div class="container wow fadeIn animated">
            <h3 class="section-title mb-20"><span>Featured</span> Categories</h3>
            <div class="large-12 columns">
                <div class="owl-carousel owl-theme">
                    @foreach($categories as $category)
                        <div class="card-1 d-grid justify-content-center">
                            <figure class="img-hover-scale text-center overflow-hidden">
                                <a href="{{route('product-category',$category->slug)}}">
                                    @if($category->image != '')
                                        <img src="{{ asset($category->image)}}" class="p-0" width="auto" height="70" alt="a" />
                                    @else
                                        <img src="{{asset('/')}}no_image.jpg" class="p-0 imageHeight" width="auto" height="70" alt="a" />
                                    @endif
                                </a>
                            </figure>
                            <h5><a class="category_name" href="{{route('product-category',$category->slug)}}"><small>{{ $category->name }}</small></a></h5>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section class="container my-4">
        <section class="sectionContainerBackground rounded-3" style="width: 100%; height: 250px; background-image: url('{{ asset('/download.png') }}'); background-size:cover ; background-position: center; background-repeat: no-repeat;">
            <!-- Section Content -->
        </section>
        <div class="my-2 text-center">
            <h1 class="fw-bold my-4">Featured Products</h1>
            <h5 class="fw-bold my-2"> Shopping For Happy Life Mart</h5>
        </div>
        <div class="container text-center">
            <div class="row product-grid-4">
                @foreach($products as $key => $product)
                    @php
                        $rand = rand(0,99999999999999)
                    @endphp
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                        <div class="product-cart-wrap mb-30 productartheight"  style="height: auto;">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{ route('product-detail',$product->slug) }}">
                                        @if($product->image != '')
                                            <img class="default-img imageHeight" src="{{asset($product->image)}}" width="100" alt="">
                                        @else
                                            <img src="{{asset('/')}}no_image.jpg" class="p-0 default-img imageHeight" width="100" alt="" />
                                        @endif
                                        @if($product->back_image != '')
                                            <img class="hover-img imageHeight" src="{{asset($product->back_image)}}" width="100" alt="">
                                        @else
                                            <img src="{{asset('/')}}no_image.jpg" class="hover-img imageHeight" width="100" alt="" />
                                        @endif
                                    </a>
                                </div>
                                <div class="product-action-1 d-flex justify-content-center">
                                    <form action="{{route('cart.ad')}}" method="post" class="addTocart" id="addToCart{{rand()}}">
                                        @csrf
                                        <input hidden type="number" name="product_id" value="{{ $product->id }}">


                                        <div hidden class="bt-1 border-color-1 mt-30 mb-30"></div>
                                        <div class="">
                                            <div class="row">
                                                <input type="number" hidden name="qty" class="form-control w-100" value="1" min="1"  max="{{ $product->stock_amount }}"/>
                                            </div>
                                        </div>
                                        <button aria-label="Add To Cart" class="action-btn hover-up me-1"><i class="fi-rs-shopping-bag-add"></i></button>
                                    </form>

                                </div>
                                <!-- Define the badges for each product based on product fields -->
                                @php
                                    $badges = [];
                                    if ($product->discount_banner != 2) {
                                        if ($product->discount_banner == 'save-percentage'){
                                            $badges[] = 'Save('.$product->discount_value.'%)';
                                        }
                                        if ($product->discount_banner == 'save-tk'){
                                            $badges[] = 'Save('.$product->discount_value.'Tk)';
                                        }
                                        if ($product->discount_banner == 'discount-percentage'){
                                            $badges[] = 'Discount('.$product->discount_value.'%)';
                                        }
                                        if ($product->discount_banner == 'discount-tk'){
                                            $badges[] = 'Discount('.$product->discount_value.'Tk)';
                                        }
                                    }
                                    if ($product->free_delivery == 1) {
                                        $badges[] = 'Free Delivery';
                                    }
                                @endphp
                                <div class="product-badges product-card product-badges-position  product-badges-mrg" data-product-id="{{ $product->id }}" data-badges="{{ json_encode($badges) }}">
                                    @if(!empty($badges))
                                        <span class="hot bg-primary fw-bold badge" id="product-badge-{{ $product->id }}"></span>
                                    @endif
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="{{route('product-category',$product->category->slug)}}">{{$product->category->name}}</a>
                                </div>
                                <h5 class="text-start"><a href="{{ route('product-detail',$product->slug) }}">{{ \Illuminate\Support\Str::limit($product->name, 85)}}</a></h5>
                                <div class="product-price">




                                    <span class="" style="font-size: 13px">৳ {{ $product->regular_price }}</span>
{{--                                    @if($product->discount_value)--}}
{{--                                        <small style="font-size: 13px">( {{ $product->discount_value }} {{ $product->discount_type == 0 ? 'Tk':'' }} {{ $product->discount_type == 1 ? '%':'' }}  Off)</small>--}}
{{--                                    @endif--}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <h5 class="text-center"><a class="animated btn btn-brush btn-brush-1" href="{{route('product-all')}}">See More <i class="fi-rs-arrow-right"></i></a></h5>
    </section>
    <section class="section-padding">
        <div class="container wow fadeIn animated">
            <h3 class="section-title mb-20"><span>New</span> Arrivals</h3>
            <div class="large-12 columns">
                <div class="owl-carousel owl-theme">
                    @foreach($products as $key => $latestProduct)
                        <div class="item product-cart-wrap small hover-up" style="margin: 1px">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{ route('product-detail',$latestProduct->slug)}}">
                                        @if($latestProduct->image != '')
                                            <img class="default-img imageHeight" src="{{asset($latestProduct->image)}}" width="100" alt="">
                                        @else
                                            <img src="{{asset('/')}}no_image.jpg" class="p-0 default-img imageHeight" width="100" alt="" />
                                        @endif
                                        @if($latestProduct->back_image != '')
                                            <img class="hover-img imageHeight" src="{{asset($latestProduct->back_image)}}" width="100" alt="">
                                        @else
                                            <img src="{{asset('/')}}no_image.jpg" class="hover-img imageHeight" width="100" alt="" />
                                        @endif
                                    </a>
                                </div>
                                <div class="product-action-1  d-flex justify-content-center">
                                    <form action="{{route('cart.ad')}}" method="post" class="addTocart" id="addToCart{{rand()}}">
                                        @csrf
                                        <input hidden type="number" name="product_id" value="{{ $latestProduct->id }}">

                                        <div hidden class="bt-1 border-color-1 mt-30 mb-30"></div>
                                        <div class="">
                                            <div class="row">
                                                <input type="number" hidden name="qty" class="form-control w-100" value="1" min="1"  max="{{ $latestProduct->stock_amount }}"/>
                                            </div>
                                        </div>
                                        <button aria-label="Add To Cart" class="action-btn hover-up me-1"><i class="fi-rs-shopping-bag-add"></i></button>
                                    </form>

                                </div>
                                @php
                                    $badges = [];
                                    if ($latestProduct->discount_banner != 2) {
                                        if ($latestProduct->discount_banner == 'save-percentage'){
                                            $badges[] = 'Save('.$latestProduct->discount_value.'%)';
                                        }
                                        if ($latestProduct->discount_banner == 'save-tk'){
                                            $badges[] = 'Save('.$latestProduct->discount_value.'Tk)';
                                        }
                                        if ($latestProduct->discount_banner == 'discount-percentage'){
                                            $badges[] = 'Discount('.$latestProduct->discount_value.'%)';
                                        }
                                        if ($latestProduct->discount_banner == 'discount-tk'){
                                            $badges[] = 'Discount('.$latestProduct->discount_value.'Tk)';
                                        }
                                    }
                                    if ($latestProduct->free_delivery == 1) {
                                        $badges[] = 'Free Delivery';
                                    }
                                @endphp
                                <div class="product-badges product-card product-badges-position  product-badges-mrg" data-product-id="{{ $latestProduct->id }}" data-badges="{{ json_encode($badges) }}">
                                    @if(!empty($badges))
                                        <span class="hot bg-primary fw-bold badge" id="product-badge-{{ $latestProduct->id }}"></span>
                                    @endif
                                </div>
                                <div class="product-badges product-badges-position-right text-center product-badges-mrg">
                                    <span class="hot p-1 rounded-3 {{ $latestProduct->stock_amount >= 5 ? 'bg-success':'bg-danger text-white' }}"> {{ $latestProduct->stock_visibility == 1 ? $latestProduct->stock_amount:''}} {{ $latestProduct->stock_amount >= 5 ? 'In Stock ':'Stock Out' }}</span>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="{{route('product-category',$latestProduct->category->slug)}}">{{$latestProduct->category->name}}</a>
                                </div>
                                <h2 class="text-start"><a href="{{route('product-detail', $latestProduct->slug)}}">{{ \Illuminate\Support\Str::limit($latestProduct->name,60) }}</a></h2>
                                <div class="product-price text-start">
                                    @if($latestProduct->discount_value)
                                        <span>
                                        ৳ {{ $latestProduct->discount_type == 0 ? ($latestProduct->regular_price - $latestProduct->discount_value):'' }}
                                            {{ $latestProduct->discount_type == 1 ? number_format(($latestProduct->regular_price - (($latestProduct->regular_price * $latestProduct->discount_value) / 100)),2):'' }}
                                    </span>
                                    @else
                                        <span class="">৳ {{ $latestProduct->selling_price }}</span>
                                    @endif
                                    @if($latestProduct->selling_price != $latestProduct->regular_price)
                                    <span class="old-price">৳ {{ $latestProduct->regular_price }}</span>
                                    @endif
                                    @if($latestProduct->discount_value)
                                        <small>(  {{ $latestProduct->discount_type == 0 ? '৳ ':'' }}{{ $latestProduct->discount_value }} {{ $latestProduct->discount_type == 1 ? '%':'' }}  Off)</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('.short-popup').fadeIn();
            }, 5000);
            $(document).on('click', '.close-popup', function() {
                $('.short-popup').fadeOut();
            });
        });
    </script>

@endpush
