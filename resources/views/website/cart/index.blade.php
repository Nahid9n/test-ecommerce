@extends('website.master')
@section('title','My Cart')
@section('body')
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route('home')}}" rel="nofollow">Home</a>
                <span></span> Your Cart
            </div>
        </div>
    </div>
    <section class="mb-50">
        <div class="container p-2" style="background-color: #000000">
            <div class="row" style="margin-right: 0; margin-left: 0; --bs-gutter-x: 0;">
                <div class="card bg-transparent text-white">
                    <div class="card-header text-center">
                        <h5>YOUR CART</h5>
                    </div>
                    <div class="card-body text-white">
                        @php $sum = 0@endphp
                        @php $vat = 0 @endphp
                        @php $discountTotal = 0 @endphp
                        @php $ids = array() @endphp
                        <div class="col-12">
                            <form action="{{route('cart.update')}}" method="post" class=" bg-transparent p-1 text-white rounded-2">
                                @csrf
                                <div class="table-responsive">
                                    <p class="text-center">{{session('message')}}</p>
                                    <table class="shopping-summery text-center text-white clean">
                                        <thead>
                                        <tr class="main-heading">
                                            <th scope="col">Image</th>
                                            <th class="col-4" style="width: 500px;">Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Subtotal</th>
                                            <th scope="col">Remove</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($products as $key=> $product)
                                            @php array_push($ids,$product->id) @endphp
                                            <tr>
                                                <td class="image product-thumbnail">
                                                    <img src="{{ asset($product->image ?? '') }}" alt="#" width="50">
                                                </td>
                                                <td class="" style="width: 500px;">
                                                    <h5 class="text-white" style="font-size: 12px"><a class="text-white" href="{{route('product-detail',$product->product->slug)}}" target="_blank">{{ $product->name }}</a></h5>
                                                
                                                </td>
                                                <td class="price" data-title="Price">
                                                    <span class="text-white fw-bold">৳
                                                        @if($product->product->discount_type == 0)
                                                            {{ $price =  $product->product->regular_price - $product->product->discount_value }}
                                                        @elseif($product->product->discount_type == 1)
                                                            {{ $price = $product->product->regular_price - (($product->product->regular_price * $product->product->discount_value)/100) }}
                                                        @else
                                                            {{ $price = $product->product->regular_price }}
                                                        @endif
                                                    </span>
                                                </td>
                                                <td class="text-center" data-title="Stock">
                                                    <div class="d-flex text-center" style="width: 150px">
                                                        <span class="down btn btn-sm" style="width: 3px; height: 40px"  id="{{$key}}" onClick='decreaseCount({{ $product->product_id }}, this)'>-</span>
                                                        <input type="text" class="form-control bg-transparent text-white border-0 text-center counterQty{{ $product->product_id }}" name="data[{{$key}}][qty]" value="{{$product->qty}}">
                                                        <span class="up btn btn-sm" style="width: 3px; height: 40px" id="{{$key}}" onClick='increaseCount({{ $product->product_id }}, this)'>+</span>
                                                        <input type="hidden" class="form-control text-center colorUpdate" name="color" value="{{$product->color}}">
                                                        <input type="hidden" class="form-control text-center sizeUpdate" name="size" value="{{$product->size}}">
                                                        <input type="hidden" class="form-control text-center priceUpdate" name="price" value="{{$price}}">
                                                        <input type="hidden" class="form-control form-control-sm" name="data[{{$key}}][rowId]" value="{{$product->rowId}}">
                                                        {{--                                                <input type="number" class="form-control counterQty" onclick="QtyChange()" name="data[{{$key}}][qty]" value="{{$product->qty}}" min="1"  max="{{ $product->product->stock_amount }}">--}}
                                                        {{--                                                <input type="number" name="data[{{$key}}][qty]" min="1" class="form-control" value="{{ $product->qty }}"/>--}}
                                                        {{--                                                <input type="hidden" name="data[{{$key}}][rowId]" class="form-control" value="{{$product->rowId}}"/>--}}
                                                    </div>
                                                </td>

                                                {{--                                        <input type="number" name="dat[{{$key}}][qty]" class="form-control" value="{{$product->qty}}"/>--}}

                                                <td class="text-right" data-title="Cart">
                                                    <span style="font-size: 12px" class="totalPrice{{ $product->product_id }}">৳ {{$total = $price * $product->qty}} </span>
                                                </td>
                                                <td class="action" data-title="Remove">
                                                    <a href="{{route('cart.delete', $product->id)}}" onclick="return confirm('Are you sure to remove this..');" class="border-0">
                                                        <i class="fi-rs-trash btn bg-danger border-0 btn-sm"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @php $sum = $sum + $total @endphp
                                            @php
                                                if ($product->product->vat_applicable == 1){
                                                    $vat = $vat + (($product->product->vat/100) * $product->product->selling_price);
                                                }
                                            @endphp
                                            {{--@php($discountTotal = $discountTotal + $discount)--}}
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="cart-action text-end">
                                    <!-- <button type="submit" class="btn"><i class="fi-rs-shopping-bag mr-10 my-2"></i>Update Cart</button> -->
                                    <a href="{{route('home')}}" class="btn"><i class="fi-rs-shopping-bag mr-10 my-2"></i>Continue Shopping</a>
                                </div>
                            </form>
                            <div class="row text-end">
                                <form action="{{route('cart.clear')}}" method="post">
                                    @csrf
                                    <input type="hidden" value="{{ json_encode($ids) }}" name="ids">
                                    <button type="submit" class="btn btn-sm btn-danger bg-danger px-5" onclick="return confirm('Are you sure to remove this..');">Clear Cart</button>
                                </form>
                            </div>
                            <div class="row mb-50">
                                <div class="col-lg-6 col-md-12">

                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="p-md-4 p-30 cart-totals">
                                        <div class="heading_s1 mb-3">
                                            <h4 class="text-white">Cart Totals</h4>
                                        </div>
                                        <div class="cart-totals">
                                            <div class="table-responsive">
                                                <table class="">
                                                    <tbody>
                                                    <tr>
                                                        <td class="cart_total_label text-white">Total</td>
                                                        <td class="cart_total_amount"><span class="font-lg text-white">৳ {{ $sum }}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="cart_total_label text-white">Tax Amount</td>
                                                        <td class="cart_total_amount"><span class="font-lg text-white">৳ {{ $tax = $vat }}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="cart_total_label text-white">Sub Total</td>
                                                        <td class="cart_total_amount">
                                                            <strong>
                                                                <span class="font-lg text-white" id="subTotal">৳ {{ $orderTotal = $sum + $tax }}</span>
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <input type="hidden" id="orderTotal" name="order_total" value="{{ $orderTotal }}"/>
                                            <input type="hidden" id="orderTax" name="tax_total" value="{{ $tax }}"/>
                                            <input type="hidden" id="orderDiscount" name="shipping_total" value="0"/>
                                        </div>
                                        <a href="{{ route('checkout') }}" class="btn "> <i class="fi-rs-box-alt mr-10"></i> Proceed To CheckOut</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

