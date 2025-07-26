@extends('admin.master')
@section('title', 'Order Detail')
@section('body')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Order Module</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('order.index')}}">Order</a></li>
                <li class="breadcrumb-item active" aria-current="page">Order Detail</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->
    <div class="row">
            <!-- Left Section: List of Products -->
            <div class="col-md-7 col-lg-7 border-end">
                <div class="card">
                    <div class="card-body table-responsive">
                        <h4 class="mb-4"># Order No: <strong>{{ $order->order_code }}</strong></h4>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Sl NO</th>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Product Quantity</th>
                                <th style="text-align: center;">Product Total</th>


                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->orderDetails as $orderDetail)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$orderDetail->product_name}}</td>
                                    <td>{{$orderDetail->product_price}}</td>
                                    <td>{{$orderDetail->product_qty}}</td>
                                    <td style="text-align: center;">{{ $orderDetail->product_price * $orderDetail->product_qty }}</td>

                                </tr>
                            @endforeach
                            <tr>
                                <th colspan="4" style="text-align: right;">Subtotal:</th>
                                <td style="text-align: center;">
                                    <span id="subTotal" data-value="{{ $total = $order->order_total }}">{{ $total = $order->order_total }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="4" style="text-align: right;">Coupon Discount Amount :</th>
                                <td style="text-align: center;"> <span id="discountAmount" data-value="{{ $totalDiscount = $order->discount }}">{{ $totalDiscount = $order->discount }}</span> </td>
                            </tr>
                            <tr>
                                <th colspan="4" style="text-align: right;"> Special Discount Amount: </th>
                                <td style="text-align: center;">
                                    <input type="number" class="form-control text-center form-control-sm" step="0.01" id="special_discount_amount" value="{{ $totalSpecialDiscount = $order->special_discount }}" style="text-align: right; width: 103%" min="0.01">
                                </td>
                            </tr>
                            <tr>
                                <th colspan="4" style="text-align: right;"> COD Charge Amount: </th>
                                <td style="text-align: center;"> <span id="codChargeAmount" data-value="{{ $totalCOD = $order->cod_charge }}">{{ $totalCOD = $order->cod_charge }}</span></td>
                            </tr>
                            <tr>
                                <th colspan="4" style="text-align: right;"> Shipping Charge Amount: </th>
                                <td style="text-align: center;"><span id="shippingChargeAmount" data-value="{{ $totalShipping = $order->shipping_total }}">{{ $totalShipping = $order->shipping_total }}</span></td>
                            </tr>
                            <tr>
                                <th colspan="4" style="text-align: right;"> Shipping Discount Amount: </th>
                                <td style="text-align: center;">
                                    <input type="shipping_discount_amount" class="form-control text-center form-control-sm" step="0.01" id="shippingDiscountAmount" value="{{ $totalShippingDiscount = $order->shipping_discount_amount }}" style="text-align: right; width: 103%" min="0.01">
                                </td>
                            </tr>
                            <tr>
                                <th colspan="4" style="text-align: right;">VAT Amount:</th>
                                <td style="text-align: center;">
                                    <input type="number" class="form-control text-center form-control-sm" step="0.01" id="vat_amount" value="{{ $vat = $order->tax_total }}" style="text-align: right; width: 103%" min="0.01">
                                </td>
                            </tr>
                            <tr>
                                <th colspan="4" style="text-align: right;">Grand Total:</th>
                                <td style="text-align: center;">
                                    <span id="grand_total" data-value="{{ ($total + $totalCOD + $totalShipping + $vat) - ( $totalDiscount + $totalSpecialDiscount )}}">{{ ($total + $totalCOD + $totalShipping + $vat) - ( $totalDiscount + $totalSpecialDiscount )}}</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <h4>Customer</h4>
                        <hr>
                        <table class="w-full">
                            <tbody><tr>
                                <td class="pb-2"><b>Customer Name</b></td>
                                <td class="pb-2">: {{ $order->customer->name}}
                                </td>
                            </tr>
                            <tr>
                                <td class="pb-6"><b>Customer Phone</b></td>
                                <td class="pb-6">: {{ $order->customer->mobile}}</td>
                            </tr>

                            <tr class="">
                                <td class="mt-4">
                                    <h5>Delivery Address,</h5>
                                </td>
                            </tr>

                            <tr>
                                <td class="pb-2"><b>Address</b></td>
                                <td class="pb-2">: {{$order->delivery_address}}</td>
                            </tr>


                            </tbody></table>
                    </div>
                </div>
            </div>
            <!-- Left Section: List of Products -->

            <!-- Right Section: Order Details -->
            <div class="col-md-5 col-lg-5">

                <div class="card">
                    <div class="card-body">
                        <h4>Order Details</h4>
                        <hr>
                        <table>
                            <tbody>
                            <tr>
                                <td class="pb-2"><strong>Order Type</strong></td>
                                <td class="pb-2"> : <span class="text-dark">Web</span></td>
                            </tr>
                            <tr>
                                <td class="pb-2"><strong>Payment Method</strong></td>
                                <td class="pb-2"> : {{ ucfirst($order->payment_method == 'Cash' ? 'Cash On Delivery':'Online') }}</td>
                            </tr>
                            <tr>
                                <td class="pb-2"><strong>Payment Status</strong></td>
                                <td class="pb-2"> : <small class="p-1 rounded-2 text-black {{$order->payment_status == 'Paid' ? 'bg-success':'bg-danger' }}">{{ ucfirst($order->payment_status)}}</small>
                                </td>
                            </tr>
                            <tr>
                                <td class="pb-2"><strong>Payment date</strong></td>
                                <td class="pb-2">
                                    : {{$order->payment_date ?? 'n/a'}}
                                </td>
                            </tr>
                            <tr>
                                <td class="pb-2"><strong>Order by</strong></td>
                                <td class="pb-2">
                                    : {{ $order->customer->name}} ({{ $order->customer->mobile}})
                                </td>
                            </tr>
                            {{--<tr>
                                <td class="pb-2"><strong>Delivery Partner</strong></td>
                                <td class="pb-2"> : n/a</td>
                            </tr>

                            <tr>
                                <td class="pb-2"><strong>Delivery Partner Tracking ID</strong></td>
                                <td class="pb-2"> : n/a</td>
                            </tr>--}}
                            </tbody>
                        </table>
                    </div>
                </div>


            <!-- Update Order Section -->
                <div class="card mt-3">
                    <div class="card-body">
                        <form action="{{route('order.update',$order->order_code)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="order_totalAmount" name="order_total" value="{{$total}}">
                            <input type="hidden" id="discountTotalAmount" name="discount" value="{{$totalDiscount}}">
                            <input type="hidden" id="special_discountAmount" name="special_discount" value="{{$totalSpecialDiscount}}">
                            <input type="hidden" id="cod_chargeAmount" name="cod_charge" value="{{$totalCOD}}">
                            <input type="hidden" id="shipping_totalAmount" name="shipping_total" value="{{$totalShipping}}">
                            <input type="hidden" id="shipping_discount_amountAmount" name="shipping_discount_amount" value="{{$totalShippingDiscount}}">
                            <input type="hidden" id="tax_totalAmount" name="tax_total" value="{{$vat}}">
                            <div class="form-group mb-5">
                                <label class="form-label" for="">
                                    Delivery Address:
                                    <input type="text" name="delivery_address" class="form-control" value="{{$order->delivery_address}}">
                                </label>

                            </div>
                            <div class="form-group mb-5">
                                <label class="form-label" for="order_status">
                                    Order Status
                                </label>
                                <select class="form-control" name="order_status">
                                    <option value="Pending"  {{ $order->order_status == 'Pending' ? 'selected':'' }}>Pending</option>
                                    <option value="Confirmed"  {{ $order->order_status == 'Confirmed' ? 'selected':'' }}>Confirmed</option>
                                    <option value="Out_For_Delivery"  {{ $order->order_status == 'Out_For_Delivery' ? 'selected':'' }}>Out For Delivery</option>
                                    <option value="Delivered"  {{ $order->order_status == 'Delivered' ? 'selected':'' }}>Delivered</option>
                                    <option value="Canceled"  {{ $order->order_status == 'Canceled' ? 'selected':'' }}>Canceled</option>
                                </select>
                            </div>
                            <div class="form-group mb-5">
                                <label class="form-label" for="payment_method">
                                    Payment Method
                                </label>
                                <select class="form-control" name="payment_method">
                                    <option value="" >-- select --</option>
                                    <option value="Cash" @selected($order->payment_method == 'Cash') >Cash On Delivery</option>
                                    <option value="Online" @selected($order->payment_method == 'Online') >Online</option>
                                </select>
                            </div>

                            <div class="row">
                                <!-- <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Is Stock Out Completed ?</label>
                                    <div class="d-flex align-items-center">
                                        <div class="form-check form-check-inline me-3">
                                            <input class="form-check-input" {{ $order->stock_out == 1 ? 'checked':'' }} type="checkbox" id="stock_out_yes" name="is_stock_out_completed" value="1">
                                            <label class="form-check-label" for="stock_out_yes">Yes</label>
                                        </div>
                                    </div>
                                </div> -->

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Is Paid ?</label>
                                    <div class="d-flex align-items-center">
                                        <div class="form-check form-check-inline me-3">
                                            <input class="form-check-input" {{ $order->payment_status == 'Paid' ? 'checked':'' }} type="checkbox" id="is_paid" name="is_paid" value="Paid">
                                            <label class="form-check-label" for="is_paid">Yes</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" id="updateButton" class="btn btn-primary">Update Order</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Update Order Section -->
            </div>
            <!-- Right Section: Order Details -->
        </div>


@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('#special_discount_amount').on('keyup', function() {
                var special_discount_amount = $(this).val();
                var subTotal = $('#subTotal').data('value');
                var discountAmount = $('#discountAmount').data('value');
                var codChargeAmount = $('#codChargeAmount').data('value');
                var shippingChargeAmount = $('#shippingChargeAmount').data('value');
                var shippingDiscountAmount = $('#shippingDiscountAmount').val();
                var vat_amount = $('#vat_amount').val();
                // Calculate the sum
                subTotal = parseFloat(subTotal) || 0;
                codChargeAmount = parseFloat(codChargeAmount) || 0;
                shippingChargeAmount = parseFloat(shippingChargeAmount) || 0;
                vat_amount = parseFloat(vat_amount) || 0;
                discountAmount = parseFloat(discountAmount) || 0;
                special_discount_amount = parseFloat(special_discount_amount) || 0;
                shippingDiscountAmount = parseFloat(shippingDiscountAmount) || 0;
                let GrandTotal = Math.round(((subTotal + codChargeAmount + shippingChargeAmount + vat_amount) - (discountAmount + special_discount_amount + shippingDiscountAmount)));
                $('#order_totalAmount').val(subTotal);
                $('#discountTotalAmount').val(discountAmount);
                $('#special_discountAmount').val(special_discount_amount);
                $('#cod_chargeAmount').val(codChargeAmount);
                $('#shipping_totalAmount').val(shippingChargeAmount);
                $('#shipping_discount_amountAmount').val(shippingDiscountAmount);
                $('#tax_totalAmount').val(vat_amount);
                $('#grand_total').text(GrandTotal);
            });
            $('#shippingDiscountAmount').on('keyup', function() {
                var shippingDiscountAmount = $(this).val();
                var subTotal = $('#subTotal').data('value');
                var discountAmount = $('#discountAmount').data('value');
                var codChargeAmount = $('#codChargeAmount').data('value');
                var shippingChargeAmount = $('#shippingChargeAmount').data('value');
                var special_discount_amount = $('#special_discount_amount').val();
                var vat_amount = $('#vat_amount').val();
                // Calculate the sum
                subTotal = parseFloat(subTotal) || 0;
                codChargeAmount = parseFloat(codChargeAmount) || 0;
                shippingChargeAmount = parseFloat(shippingChargeAmount) || 0;
                vat_amount = parseFloat(vat_amount) || 0;
                discountAmount = parseFloat(discountAmount) || 0;
                special_discount_amount = parseFloat(special_discount_amount) || 0;
                shippingDiscountAmount = parseFloat(shippingDiscountAmount) || 0;
                let GrandTotal = Math.round(((subTotal + codChargeAmount + shippingChargeAmount + vat_amount) - (discountAmount + special_discount_amount + shippingDiscountAmount)));
                // Update the #subTotal element with the result
                $('#order_totalAmount').val(subTotal);
                $('#discountTotalAmount').val(discountAmount);
                $('#special_discountAmount').val(special_discount_amount);
                $('#cod_chargeAmount').val(codChargeAmount);
                $('#shipping_totalAmount').val(shippingChargeAmount);
                $('#shipping_discount_amountAmount').val(shippingDiscountAmount);
                $('#tax_totalAmount').val(vat_amount);
                $('#grand_total').text(GrandTotal);
            });
            $('#vat_amount').on('keyup', function() {
                var vat_amount = $(this).val();
                var special_discount_amount = $('#special_discount_amount').val();
                var subTotal = $('#subTotal').data('value');
                var discountAmount = $('#discountAmount').data('value');
                var codChargeAmount = $('#codChargeAmount').data('value');
                var shippingChargeAmount = $('#shippingChargeAmount').data('value');
                var shippingDiscountAmount = $('#shippingDiscountAmount').val();

                // Calculate the sum
                subTotal = parseFloat(subTotal) || 0;
                codChargeAmount = parseFloat(codChargeAmount) || 0;
                shippingChargeAmount = parseFloat(shippingChargeAmount) || 0;
                vat_amount = parseFloat(vat_amount) || 0;
                discountAmount = parseFloat(discountAmount) || 0;
                special_discount_amount = parseFloat(special_discount_amount) || 0;
                shippingDiscountAmount = parseFloat(shippingDiscountAmount) || 0;
                let GrandTotal = Math.round(((subTotal + codChargeAmount + shippingChargeAmount + vat_amount) - (discountAmount + special_discount_amount + shippingDiscountAmount)));
                // Update the #subTotal element with the result
                $('#order_totalAmount').val(subTotal);
                $('#discountTotalAmount').val(discountAmount);
                $('#special_discountAmount').val(special_discount_amount);
                $('#cod_chargeAmount').val(codChargeAmount);
                $('#shipping_totalAmount').val(shippingChargeAmount);
                $('#shipping_discount_amountAmount').val(shippingDiscountAmount);
                $('#tax_totalAmount').val(vat_amount);
                $('#grand_total').text(GrandTotal);
            });
        });
    </script>
@endpush
