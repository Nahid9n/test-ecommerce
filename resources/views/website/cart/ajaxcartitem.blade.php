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
