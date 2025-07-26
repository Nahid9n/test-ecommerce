@extends('website.master')
@section('title','Checkout')
@section('body')
    <style>
        /* Style the container to add a border after selection */
        .address-container {
            align-items: center;
            cursor: pointer;
            padding: 5px;
        }

        .address-radio {
            display: none;
        }

        .address-label {
            padding: 10px;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }

        /* Change the cursor to pointer when hovering */
        .address-container:hover .address-label {
            cursor: pointer;
        }

        /* Add border and background color when the radio is checked */
        .address-radio:checked + .address-label {
            border-color: #007bff; /* Change to desired color */
            background-color: rgba(0, 123, 255, 0.1); /* Optional background color */
        }

    </style>
    <section class="mb-50 pt-2">
        <div class="container p-2" style="background-color: #000000">
            <div class="row" style="margin-right: 0; margin-left: 0; --bs-gutter-x: 0;">
                <div class="card bg-transparent text-white m-0 p-0" style="border: none">
                    <div class="card-body text-white p-0">
                        <form class="col-md-12" action="{{ 'new-order' }}" method="POST">
                            @csrf
                            <div class="row" style=" --bs-gutter-x: 0;">
                                <div class="col-md-5">
                                    <div class="card bg-transparent" style="border: none;">
                                        <div class="card-header text-center" style="background-color: #322E7E">
                                            <h4 class="text-white">Billing & Shipping Information</h4>
                                        </div>
                                        <div class="card-body border-0">

                                            <div class="form-group">
                                                <textarea class="bg-transparent text-white" required name="address" id="" placeholder="Address"></textarea>

                                            </div>
                                            <div class="form-group">
                                                <input type="text" id="addressName" class="bg-transparent text-white" required  value="{{ auth()->user()->name }}" readonly name="name" placeholder="Full name"/>
                                            </div>
                                            <div class="form-group">
                                                <input type="email" id="addressEmail" class="bg-transparent text-white" name="email"  required="" value="{{ auth()->user()->email }}" readonly placeholder="Email Address *"/>
                                            </div>
                                            <div class="form-group">
                                                <input type="number" id="addressNumber" class="bg-transparent text-white" name="mobile"  value="" required="" placeholder="Mobile Number">
                                            </div>
                                            <div class="form-group">
                                                <input type="number" id="addressZip" name="zip" class="bg-transparent text-white" placeholder="Zip" >
                                            </div>

                                            <div class="form-group">
                                                <input type="text" id="house_road_area" name="house_road_area" class="bg-transparent text-white" placeholder="House No , Road , Area ,Landmark" >
                                            </div>

                                            <div class="form-group">
                                                <textarea class="bg-transparent text-white" name="order_note" placeholder="Order Note"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="card bg-transparent" style="border: none;">
                                        <div class="card-header text-center border-1" style="background-color: #322E7E">
                                            <h4 class="text-white">Total Items ({{ $cartItems->count() }})</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive order_table text-center">
                                                <table class="border-0" style="border: none;">
                                                    <thead>
                                                    <tr>
                                                        <th colspan="2">Product</th>
                                                        <th>Total</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @php $sum = 0 @endphp
                                                    @php $vat = 0 @endphp
                                                    @php $ids = array() @endphp
                                                    @foreach($cartItems as $product)
                                                        <tr>
                                                            <td class="image product-thumbnail"><img src="{{ asset($product->image ?? '') }}" width="25" alt="#"></td>
                                                            <td>
                                                                <h5>
                                                                    <a class="text-white" href="{{ route('product-detail',$product->product->slug) }}">{{ $product->name }}</a>
                                                                </h5>

                                                                @if($product->product->discount_type == 0)
                                                                    {{ $price =  $product->product->regular_price - $product->product->discount_value }} x {{$product->qty}}
                                                                @elseif($product->product->discount_type == 1)
                                                                    {{ $price = $product->product->regular_price - (($product->product->regular_price * $product->product->discount_value)/100) }} x {{$product->qty}}
                                                                @else
                                                                    {{ $price = $product->product->regular_price }} x {{$product->qty}}
                                                                @endif
                                                            </td>
                                                            <td>৳ {{ $total =  $price * $product->qty }}</td>
                                                        </tr>
                                                        @php $sum = $sum + $total @endphp

                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="bt-1 border-color-1 mt-30 mb-30">

                                                <!-- Display applied coupon details or errors -->
                                                <div id="coupon-message" class="mt-2"></div>
                                            </div>
                                            <div class="payment_method">
                                                <div class="mb-25">
                                                    <h5 class="text-white">Payment Method</h5>
                                                </div>
                                                <div class="payment_option">
                                                    <div class="custome-radio">
                                                        <input class="form-check-input" required="" type="radio" name="payment_method"
                                                               value="Cash" id="exampleRadios3" checked="">
                                                        <label class="form-check-label text-white" for="exampleRadios3" data-bs-toggle="collapse"
                                                               data-target="#bankTranfer" aria-controls="bankTranfer">Cash On
                                                            Delivery</label>
                                                        <div class="form-group collapse in" id="bankTranfer">
                                                            <p class="text-muted mt-5 text-white">There are many variations of passages of Lorem
                                                                Ipsum available, but the majority have suffered alteration. </p>
                                                        </div>
                                                    </div>
                                                    <div class="custome-radio">
                                                        <input class="form-check-input text-white" required="" type="radio" name="payment_method"
                                                               value="Online" id="exampleRadios4">
                                                        <label class="form-check-label text-white" for="exampleRadios4" data-bs-toggle="collapse"
                                                               data-target="#checkPayment" aria-controls="checkPayment">Online
                                                            Payment</label>
                                                        <div class="form-group collapse in" id="checkPayment">
                                                            <p class="text-muted mt-5 text-white">Please send your cheque to Store Name, Store
                                                                Street, Store Town, Store State / County, Store Postcode. </p>
                                                        </div>
                                                    </div>

                                                </div>
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
                                                            <td class="cart_total_label text-white">Shipping</td>
                                                            <td class="cart_total_amount">
                                                                <span class="font-lg text-white" >৳ </span><span class="font-lg text-white" id="shippingCost">{{ $shippingCost = 0 }}</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="cart_total_label text-white">Cash On Delivery</td>
                                                            <td class="cart_total_amount">
                                                                <span class="font-lg text-white" >৳ </span><span class="font-lg text-white" id="codCost">0</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="cart_total_label text-white">Discount</td>
                                                            <td class="cart_total_amount">
                                                                <strong>
                                                                    <span class="font-lg text-white" id="couponDiscount">৳ 0</span>
                                                                </strong>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td class="cart_total_label text-white">Sub Total</td>
                                                            <td class="cart_total_amount">
                                                                <strong>
                                                                    <span class="font-lg text-white" id="subTotal">৳ {{ $orderTotal = $sum + $tax + $shippingCost }}</span>
                                                                </strong>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <input type="hidden" id="orderTotal" name="order_total" value="{{ $orderTotal }}"/>
                                                <input type="hidden" id="orderTax" name="tax_total" value="{{ $tax }}"/>
                                                <input type="hidden" id="orderDiscount" name="discount_total" value="0"/>
                                                <input type="hidden" id="orderShippingCost" name="shipping_total" value="{{ $shippingCost }}"/>
                                                <input type="hidden" id="orderCODCost" name="cod_charge_total" value="0"/>
                                            </div>
                                            <div class="d-grid justify-content-end">
                                                <button type="submit" onclick="return confirm('Are You Sure To Place Order ?')" class="btn btn-fill-out btn-block">Place Order</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div  class="modal fade" id="addressAdd" tabindex="-1" aria-labelledby="onloadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="d-grid justify-content-end">
                    <button type="button" class="btn-close float-end p-2" id="close-popup" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="my-2 text-center">CREATE NEW ADDRESS</h5>
                    <hr class="text-black" style="border: 1px solid black">

                </div>
            </div>
        </div>
    </div>
@endsection
