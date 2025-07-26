<div class="totall-product text-center">
    <p> We found <strong class="text-brand" id="countProduct">{{ $products->count() }}</strong> items for you!</p>
</div>
<hr>
@foreach($products as $key => $product)
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
                <div class="product-action-1 d-flex">
                    <form action="{{route('cart.ad')}}" method="post" class="addTocart" id="addToCart{{rand()}}">
                        @csrf
                        <input hidden type="text" name="product_id" value="{{ $product->id }}">
                        <div hidden class="bt-1 border-color-1 mt-30 mb-30"></div>
                        <div class="">
                            <div class="row">
                                <input type="number" hidden name="qty" class="form-control w-100" value="1" min="1"  max="{{ $product->stock_amount }}"/>
                            </div>
                        </div>
                        <button aria-label="Add To Cart" class="action-btn hover-up me-1"><i class="fi-rs-shopping-bag-add"></i></button>
                    </form>
                </div>
                <div class="product-badges product-card product-badges-position  product-badges-mrg" data-product-id="{{ $product->id }}">
                    <span class="hot bg-primary fw-bold badge" id="product-badge-{{ $product->id }}">new</span>
                </div>
                <div class="product-badges product-badges-position-right text-center product-badges-mrg">
                    <span class="hot p-1 rounded-3 {{ $product->stock_amount >= 11 ? 'bg-success text-dark':'bg-danger text-white' }}"> {{ $product->stock_amount }} {{ $product->stock_amount >= 11 ? 'In Stock ':'Stock Out' }}</span>
                </div>
            </div>
            <div class="product-content-wrap">
                <div class="product-category">
                    <a href="{{route('product-category',$product->category->slug)}}">{{$product->category->name}}</a>
                </div>
                <h5><a href="{{ route('product-detail',$product->slug) }}">{{ \Illuminate\Support\Str::limit($product->name, 85)}}</a></h5>
                <div class="product-price">
                    <span style="font-size: 13px">৳ {{$product->selling_price}}</span>
                    <span class="old-price" style="font-size: 13px">৳ {{$product->regular_price}}</span>
                </div>
            </div>
        </div>
    </div>
@endforeach

