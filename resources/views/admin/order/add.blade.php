@extends('admin.master')
@section('title','Create New Order')
@section('body')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Create New Order</h1>
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
        <div class="col-md-6 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatable" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Brand</th>
                                <th>Category</th>
                                <th style="text-align: center;">MRP</th>
                                <th style="text-align: center;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $key => $product)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td><img src="{{ asset($product->image)}}" alt="" width="30"></td>
                                    <td>
                                        <a class="text-dark" target="_blank" href="{{route('product.show',$product->code)}}">{{$product->name}}</a><br>
                                        <small class="text-muted">SKU : {{$product->code}}</small>
                                    </td>
                                    <td>{{$product->brand->name}}</td>
                                    <td>{{$product->category->name}}</td>
                                    <td style="text-align: center;">
                                        @if($product->discount_type == 0)
                                            {{ $price =  $product->regular_price - $product->discount_value }}
                                        @elseif($product->discount_type == 1)
                                            {{ $price = $product->regular_price - (($product->regular_price * $product->discount_value)/100) }}
                                        @else
                                            {{ $price = $product->selling_price }}
                                        @endif
                                    </td>
                                    <td style="text-align: center;">
                                        <button data-bs-target="#addToCartModal{{$key}}" data-bs-toggle="modal" class="brn btn-sm btn-success"><i class="fa fa-cart-arrow-down"></i></button>
                                    </td>
                                </tr>
                                <!-- Add to Cart Modal -->
                                <div class="modal fade" id="addToCartModal{{$key}}" tabindex="-1" aria-labelledby="addToCartModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addToCartModalLabel">Add Product to Cart</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('admin.add.cart')}}" id="addToCartForm" method="post">
                                                    @csrf
                                                    <input hidden type="number" name="product_id" value="{{ $product->id }}">
                                                    <div class="mb-3">
                                                        <label for="productName" class="form-label">Product Name</label>
                                                        <input type="text" class="form-control bg-transparent text-dark" value="{{ $product->name }}" id="modalProductName" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="productPrice" class="form-label">Product Price</label>
                                                        <input type="text" class="form-control bg-transparent  text-dark" value="{{ $price }}" id="modalProductPrice" name="product_price" readonly>
                                                        <input type="hidden" class="form-control" id="modalWeight" name="weight" value="{{ $product->weight }}" readonly="">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="variantSelect" class="form-label">Color</label>
                                                        <select class="form-select" id="variantSelect" name="color" required="">
                                                            @foreach($product->colors as $key => $color)
                                                                <option {{$key == 0 ? 'selected':''}} value="{{$color->color->name}}" style="background-color: {{ $color->color->code }}">{{ $color->color->name ?? '' }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="variantSelect" class="form-label">Size</label>
                                                        <select class="form-control" id="variantSelect" name="size" required="">
                                                            @foreach($product->sizes as $key1 => $size)
                                                                <option {{$key == 0 ? 'selected':''}} value="{{$size->size->name}}" >{{ $size->size->name ?? '' }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="quantity" class="form-label">Quantity</label>
                                                        <input type="number" class="form-control" id="qty" name="qty" min="1" value="1" required="">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <!-- Left Section: List of Products -->
        <div class="col-md-6 col-lg-6 p-3">
            <div class="card mb-2">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2 class="section-title mb-0">
                        <i class="ki-duotone ki-handcart"></i>
                        Cart
                    </h2>

                    <button type="button" href="" class="btn btn-sm btn-info" onclick="clearCart()">Clear Cart
                        <form action="http://182.163.98.65/safwahmart/order-management/cart/clear" method="POST" id="cart_clear_form">
                            <input type="hidden" name="_token" value="D6U6uStvhztwBEY4vRIgVWPdwcLI28RnDE0KWHTc" autocomplete="off">                            </form>
                    </button>
                </div>
                <div class="card-body cart_list">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                            <tr>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Size</th>
                                <th>Color</th>
                                <th>Qty</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                              $subTotal = 0;
                              $vatTotal = 0;
                            @endphp
                            @foreach($carts as $cart)
                                <tr>
                                <td>
                                    <div class="symbol symbol-50px">
                                        <img src="{{ asset($cart->image)}}" alt="Thumbnail" width="50">
                                    </div>
                                </td>
                                <td>{{$cart->product->name}}</td>
                                <td>
                                    @if($cart->product->discount_type == 0)
                                        {{ $cartprice =  $cart->product->regular_price - $cart->product->discount_value }}
                                    @elseif($product->discount_type == 1)
                                        {{ $cartprice = $cart->product->regular_price - (($cart->product->regular_price * $cart->product->discount_value)/100) }}
                                    @else
                                        {{ $cartprice = $cart->product->selling_price }}
                                    @endif
                                </td>
                                <td>{{ $cart->size ?? 'N/A'}}</td>
                                <td>{{ $cart->color ?? 'N/A'}}</td>
                                <td>
                                    <form action="{{ route('admin.update.cart',$cart->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex text-center" style="width: 150px">
                                                <span class="down btn btn-sm" style="width: 3px; height: 40px"  id="{{$key}}" onClick='decreaseCount({{ $cart->product_id }}, this)'><i class="fa text-dark fa-minus-circle"></i></span>
                                                <input type="text" class="form-control bg-transparent text-dark border-0 text-center counterQty{{ $cart->product_id }}" name="qty" value="{{ $cart->qty }}">
                                                <span class="up btn btn-sm" style="width: 3px; height: 40px" id="{{$key}}" onClick='increaseCount({{ $cart->product_id }}, this)'><i class="fa text-dark fa-plus-circle"></i></span>
                                                <input type="hidden" class="form-control text-center colorUpdate" name="color" value="{{$cart->color}}">
                                                <input type="hidden" class="form-control text-center sizeUpdate" name="size" value="{{$cart->size}}">
                                                <input type="hidden" class="form-control text-center priceUpdate" name="price" value="{{$cartprice}}">
                                                <input type="hidden" class="form-control form-control-sm" name="data[{{$key}}][rowId]" value="{{$cart->rowId}}">
                                                <button type="submit" class="btn btn-success btn-sm float-start m-1" onclick="return confirm('Are you want to update this !!!')">
                                                    <i class="fa fa-refresh"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                                <td class="">
                                    <form action="{{--{{ route('color.destroy',$cart->id) }}--}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm float-start m-1" onclick="return confirm('Are you want to delete this !!!')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                                @php
                                    $subTotal = $subTotal + ($cartprice * $cart->qty);
                                    if ($cart->product->vat_applicable == 1){
                                       $vatTotal =  $vatTotal + (($cart->product->vat / 100) * ($cartprice * $cart->qty));
                                    }
                                @endphp
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card mb-2">
                <div class="card-body">
                    <div class="form-group mb-4">
                        <label>
                            <h5>Order Source:</h5>
                        </label>
                        <div class="d-flex fw-semibold h-100">
                            <div class="form-check form-check-inline form-check-custom form-check-solid me-9">
                                <input class="form-check-input" type="radio" id="order_pos" name="order_source" value="pos">
                                <label class="form-check-label text-dark" for="order_pos" style="color: black;">POS</label>
                            </div>
                            <div class="form-check form-check-inline form-check-custom form-check-solid me-9">
                                <input class="form-check-input" type="radio" id="order_facebook" name="order_source" value="facebook">
                                <label class="form-check-label text-dark" for="order_facebook" style="color: black;">Facebook</label>
                            </div>
                            <div class="form-check form-check-inline form-check-custom form-check-solid me-9">
                                <input class="form-check-input" type="radio" id="order_whatsapp" name="order_source" value="whatsapp">
                                <label class="form-check-label text-dark" for="order_whatsapp" style="color: black;">WhatsApp</label>
                            </div>
                            <div class="form-check form-check-inline form-check-custom form-check-solid me-9">
                                <input class="form-check-input" type="radio" id="order_phone" name="order_source" value="phone">
                                <label class="form-check-label text-dark" for="order_phone" style="color: black;">Phone</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="customer-content" class="mb-2">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2 class="section-title mb-0">
                            <i class="ki-duotone ki-user">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Customer
                        </h2>
                        <button id="addCustomerBtn" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#customerModal">
                            Add Customer
                        </button>
                    </div>

                    <div id="customer-container" class="card-body">
                        <div class="col-md-12 d-flex justify-content-end">

                        </div>

                        <div class="col-md-12 form-group">
                            <label class="form-label" for="user_id">
                                Select Customer:
                            </label>
                            <select class="form-control select2 select2-show-search customer" style="width: 100%">
                                @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }} ( {{ $customer->customer->mobile ?? 'n/a' }} )</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label class="form-label" for="user_address_id">
                                Select Address:
                            </label>
                            <select class="form-control customerAddress" style="width: 100%;" disabled="">
                                <option value="">Select an address</option>
                            </select>
                        </div>
                        <!-- Hidden fields for user_id and user_address_id -->
                        <div class="card mt-4">
                            <div class="card-header">
                                <h5 class="mt-4">Added Customer Details</h5>
                            </div>
                            <div class="card-body">
                                <!-- Hidden fields -->
                                <input type="hidden" id="customer_id" name="customer_id" value="">
                                <input type="hidden" id="customer_address_id" name="customer_address_id" value="">
                                <input type="hidden" id="district_id" name="district_id" value="">
                                <input type="hidden" id="area_id" name="area_id" value="">

                                <!-- Display customer details -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <strong>Customer Name:</strong>
                                        <p id="customer_name_span">N/A</p>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Customer Number:</strong>
                                        <p id="address_number_span">N/A</p>
                                    </div>
                                </div>

                                <!-- Display district and area details -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <strong>Address:</strong>
                                        <p id="address_name_span">
                                            N/A</p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <strong>District:</strong>
                                        <p id="district_name_span">
                                            N/A</p>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Area:</strong>
                                        <p id="area_name_span">N/A</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Form Modal -->
                    <div class="modal fade" id="customerModal" tabindex="-1" aria-labelledby="customerModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="customerModalLabel">Add Customer</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin.new.customer') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group mb-5">
                                                    <label class="form-label" for="name">
                                                        Customer Name
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="name" id="name" value="" class="form-control" placeholder="Customer Name" required="">
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group mb-5">
                                                    <label class="form-label" for="phone">
                                                        Phone Number
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="phone" id="phone" value="" class="form-control" placeholder="Phone Number" required="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">


                                            <div class="col-sm-6">
                                                <div class="form-group mb-5">
                                                    <label class="form-label" for="customer_type_id">
                                                        Customer Type
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <select name="customer_type_id" id="customer_type_id" class="form-select" required="">
                                                        <option value="">--Select--</option>
                                                        <option value="1">Bronze
                                                        </option>
                                                        <option value="2">Premium
                                                        </option>
                                                        <option value="3">Silver
                                                        </option>
                                                        <option value="4">বসুন্ধরা মিডিয়া অ্যাওয়ার্ড আয়োজক কমিটি
                                                        </option>
                                                        <option value="6">Platinum
                                                        </option>
                                                        <option value="10">super
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group mb-5">
                                                    <label class="form-label" for="gender">
                                                        Gender
                                                    </label>
                                                    <select name="gender" id="gender" class="form-select">
                                                        <option value="">--Select--</option>
                                                        <option value="1">Male</option>
                                                        <option value="2">Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group mb-5">
                                                    <label class="form-label" for="address_type">
                                                        Address type
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <select class="form-control attribute-option" name="address_type[]" required="">
                                                        <option value="default">-- Select Option --</option>
                                                        <option value="1">Home</option>
                                                        <option value="2">Office</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group mb-5">
                                                    <label class="form-label" for="district">
                                                        City/District
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <select id="district_id" class="form-control district-select" name="district_id[]" required="">
                                                        <option value="" disabled="" selected="">Select City/District</option>
                                                        <option value="1">BARGUNA
                                                        </option>
                                                        <option value="2">BARISAL
                                                        </option>
                                                        <option value="3">BHOLA
                                                        </option>
                                                        <option value="4">JHALOKATI
                                                        </option>
                                                        <option value="5">PATUAKHALI
                                                        </option>
                                                        <option value="6">PIROJPUR
                                                        </option>
                                                        <option value="7">BANDARBAN
                                                        </option>
                                                        <option value="8">BRAHMANBARIA
                                                        </option>
                                                        <option value="9">CHANDPUR
                                                        </option>
                                                        <option value="10">CHITTAGONG
                                                        </option>
                                                        <option value="11">COMILLA
                                                        </option>
                                                        <option value="12">COX'S BAZAR
                                                        </option>
                                                        <option value="13">FENI
                                                        </option>
                                                        <option value="14">KHAGRACHHARI
                                                        </option>
                                                        <option value="15">LAKSHMIPUR
                                                        </option>
                                                        <option value="16">NOAKHALI
                                                        </option>
                                                        <option value="17">RANGAMATI
                                                        </option>
                                                        <option value="18">DHAKA
                                                        </option>
                                                        <option value="19">FARIDPUR
                                                        </option>
                                                        <option value="20">GAZIPUR
                                                        </option>
                                                        <option value="21">GOPALGANJ
                                                        </option>
                                                        <option value="22">JAMALPUR
                                                        </option>
                                                        <option value="23">KISHOREGONJ
                                                        </option>
                                                        <option value="24">MADARIPUR
                                                        </option>
                                                        <option value="25">MANIKGANJ
                                                        </option>
                                                        <option value="26">MUNSHIGANJ
                                                        </option>
                                                        <option value="27">MYMENSINGH
                                                        </option>
                                                        <option value="28">NARAYANGANJ
                                                        </option>
                                                        <option value="29">NARSINGDI
                                                        </option>
                                                        <option value="30">NETRAKONA
                                                        </option>
                                                        <option value="31">RAJBARI
                                                        </option>
                                                        <option value="32">SHARIATPUR
                                                        </option>
                                                        <option value="33">SHERPUR
                                                        </option>
                                                        <option value="34">TANGAIL
                                                        </option>
                                                        <option value="35">BAGERHAT
                                                        </option>
                                                        <option value="36">CHUADANGA
                                                        </option>
                                                        <option value="37">JESSORE
                                                        </option>
                                                        <option value="38">JHENAIDAH
                                                        </option>
                                                        <option value="39">KHULNA
                                                        </option>
                                                        <option value="40">KUSHTIA
                                                        </option>
                                                        <option value="41">MAGURA
                                                        </option>
                                                        <option value="42">MEHERPUR
                                                        </option>
                                                        <option value="43">NARAIL
                                                        </option>
                                                        <option value="44">SATKHIRA
                                                        </option>
                                                        <option value="45">BOGRA
                                                        </option>
                                                        <option value="46">JOYPURHAT
                                                        </option>
                                                        <option value="47">NAOGAON
                                                        </option>
                                                        <option value="48">NATORE
                                                        </option>
                                                        <option value="49">CHAPAI NABABGANJ
                                                        </option>
                                                        <option value="50">PABNA
                                                        </option>
                                                        <option value="51">RAJSHAHI
                                                        </option>
                                                        <option value="52">SIRAJGANJ
                                                        </option>
                                                        <option value="53">DINAJPUR
                                                        </option>
                                                        <option value="54">GAIBANDHA
                                                        </option>
                                                        <option value="55">KURIGRAM
                                                        </option>
                                                        <option value="56">LALMONIRHAT
                                                        </option>
                                                        <option value="57">NILPHAMARI
                                                        </option>
                                                        <option value="58">PANCHAGARH
                                                        </option>
                                                        <option value="59">RANGPUR
                                                        </option>
                                                        <option value="60">THAKURGAON
                                                        </option>
                                                        <option value="61">HABIGANJ
                                                        </option>
                                                        <option value="62">MAULVIBAZAR
                                                        </option>
                                                        <option value="63">SUNAMGANJ
                                                        </option>
                                                        <option value="64">SYLHET
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group mb-5">
                                                    <label class="form-label" for="area_id">
                                                        Area
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <select id="area_id" class="form-control area-select" name="area_id[]" required="">
                                                        <option value="" disabled="" selected="">Select Area</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group mb-5">
                                                    <label class="form-label" for="zip_code">
                                                        Zip Code
                                                    </label>
                                                    <input type="text" name="zip_code[]" id="zip_code" class="form-control" placeholder="Zip Code" required="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group mb-5">
                                                    <label class="form-label" for="contact_person_name">
                                                        Contact Person Name
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input id="contact_person_name" name="contact_person_name[]" class="form-control" placeholder="Contact Person Name" required="">
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group mb-5">
                                                    <label class="form-label" for="contact_person_number">
                                                        Contact Person Name
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="contact_person_number[]" id="contact_person_number" class="form-control" placeholder="Contact Person Number" required="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group mb-5">
                                            <label class="form-label" for="address">
                                                Address
                                                <span class="text-danger">*</span>
                                            </label>
                                            <textarea id="address" class="form-control" rows="2" placeholder="Address" name="address[]"></textarea>

                                            <input type="hidden" name="is_active" id="is_active" value="1" class="form-control" required="">
                                            <input type="hidden" name="order_customer" id="order_customer" value="true" class="form-control" required="">
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="mb-4">
                <div class="card-body billing_section">
                    <!-- billing content -->
                    <div class="card">
                        <div class="card-body">
                            <!-- Coupon input and apply button -->
                            <div class="form-group mb-2">
                                <form action="{{route('coupon.apply')}}" method="POST">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <input type="hidden" id="orderTotal" class="form-control" name="order_total" value="{{ $subTotal }}">
                                        <input type="hidden" id="orderTotal" class="form-control" name="discount_total" value="">
                                        <input type="text" id="coupon-code" name="coupon" class="form-control text-white bg-transparent" placeholder="Enter Valid Coupon Code" aria-label="Enter Valid Coupon Code" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-success" id="apply-coupon" style="background-color: #322e7e" type="button"><i class="fi-rs-label"></i> Apply</button>
                                            <button class="btn btn-danger" hidden id="remove-coupon" style="background-color: #ed1656" type="button"><i class="fi-rs-label"></i> Remove</button>
                                        </div>
                                        <br>
                                    </div>
                                    <div class="row">
                                        <span class="bg-primary text-black p-1 rounded-2" id="couponAmountAfterApply"></span>
                                    </div>
                                </form>
                            </div>
                            <form action="">
                                <div class="row">
                                    <!-- Left Column: Payment Method and Order Type -->
                                    <!-- Payment Method radio buttons -->
                                    <div class="form-group mb-4">
                                        <label><b>Payment Method:</b></label>
                                        <div class="d-flex fw-semibold h-100 mt-2">
                                            <div class="form-check form-check-inline form-check-custom form-check-solid me-3">
                                                <input class="form-check-input" type="radio" id="cash" name="payment_method" value="cash" checked="">
                                                <label class="form-check-label text-dark text-sm text-md text-lg" for="cash" style="color: black;">Cash</label>
                                            </div>
                                            <div class="form-check form-check-inline form-check-custom form-check-solid me-3">
                                                <input class="form-check-input" type="radio" id="card" name="payment_method" value="card">
                                                <label class="form-check-label text-dark text-sm text-md text-lg" for="card" style="color: black;">Card</label>
                                            </div>
                                            <div class="form-check form-check-inline form-check-custom form-check-solid me-3">
                                                <input class="form-check-input" type="radio" id="mfs" name="payment_method" value="mfs">
                                                <label class="form-check-label text-dark text-sm text-md text-lg" for="mfs" style="color: black;">Mfs</label>
                                            </div>
                                            <div class="form-check form-check-inline form-check-custom form-check-solid me-3">
                                                <input class="form-check-input" type="radio" id="cod" name="payment_method" value="cod">
                                                <label class="form-check-label text-dark text-sm text-md text-lg" for="cod" style="color: black;">Cash on Delivery</label>
                                            </div>
                                            <div class="form-check form-check-inline form-check-custom form-check-solid me-3">
                                                <input class="form-check-input" type="radio" id="online" name="payment_method" value="online">
                                                <label class="form-check-label text-dark text-sm text-md text-lg" for="online" style="color: black;">Online Payment</label>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="row my-2">
                                    <!-- Right Column: Payment Status and Printing Type -->
                                    <div class="col-md-5">
                                        <!-- Payment Status radio buttons -->
                                        <div class="form-group mb-4">
                                            <label><b>Payment Status:</b></label>
                                            <div class="d-flex fw-semibold h-100 mt-2">
                                                <div class="form-check form-check-inline form-check-custom form-check-solid me-9">
                                                    <input class="form-check-input" type="radio" id="paid" name="payment_status" value="paid">
                                                    <label class="form-check-label text-dark" for="paid" style="color: black;">Paid</label>
                                                </div>
                                                <div class="form-check form-check-inline form-check-custom form-check-solid me-9">
                                                    <input class="form-check-input" type="radio" id="unpaid" name="payment_status" value="unpaid" checked="">
                                                    <label class="form-check-label text-dark" for="unpaid" style="color: black;">Unpaid</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <!-- Printing Type radio buttons -->
                                        <div class="form-group mb-4">
                                            <label><b>Printing Type:</b></label>
                                            <div class="d-flex fw-semibold h-100 mt-2">
                                                <div class="form-check form-check-inline form-check-custom form-check-solid me-9">
                                                    <input class="form-check-input" type="radio" id="pos" name="printing_type" value="pos" checked="">
                                                    <label class="form-check-label text-dark" for="pos" style="color: black;">POS</label>
                                                </div>
                                                <div class="form-check form-check-inline form-check-custom form-check-solid me-9">
                                                    <input class="form-check-input" type="radio" id="normal" name="printing_type" value="normal">
                                                    <label class="form-check-label text-dark" for="normal" style="color: black;">Normal</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <!-- Summary with right-aligned text -->
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label for="subtotal">Subtotal:</label>
                                    <div class="col-sm-4">
                                        <input type="text" id="subtotal" class="form-control bg-transparent text-right" value="{{$subTotal}}" readonly="">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label for="vat">VAT:</label>
                                    <div class="col-sm-4">
                                        <input type="text" id="vat" class="form-control text-right" value="{{ $tax = $vatTotal }}">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label for="shipping_charge">Shipping Charge Amount:</label>
                                    <div class="col-sm-4">
                                        <input type="text" id="shipping_charge" class="form-control bg-transparent text-right" value="{{ $shippingCost = 0 }}" readonly="">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label for="shipping_charge">Shipping Discount Amount:</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control text-center form-control-sm" step="0.01" id="shippingDiscountAmount" value="{{ $shippingDiscountAmount = 0 }}" style="text-align: right; width: 103%" min="0.01">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label for="cod_charge">COD Charge ( <span id="codApplied">0</span> %):</label>
                                    <div class="col-sm-4">
                                        <input type="text" id="cod_charge" class="form-control bg-transparent text-right" value="{{ $codChargeAmount = 0 }}" readonly="">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label for="coupon_discount">Coupon Discount Amount :</label>
                                    <div class="col-sm-4">
                                        <input type="text" id="coupon_discount" class="form-control bg-transparent text-right" value="{{ $couponDiscountAmount = 0 }}" readonly="">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label for="special_discount">Special Discount:</label>
                                    <div class="col-sm-4">
                                        <input type="number" id="special_discount" class="form-control text-right" value="{{$specialDiscountAmount = 0}}" min="0.01" step="0.01">
                                    </div>
                                </div>
                                <!-- Underline -->
                                <hr>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h4>Grand Total:</h4>
                                    <div class="col-sm-4">
                                        <input type="text" id="grand_total" class="form-control bg-transparent text-right" value="{{ (($subTotal + $codChargeAmount + $shippingCost + $tax) - ($couponDiscountAmount + $specialDiscountAmount + $shippingDiscountAmount)) }}" readonly="">
                                    </div>
                                </div>
                                <!-- Submit Button -->
                                <div class="d-flex justify-content-end mt-3">
                                    <button type="button" id="create-order" class="btn btn-primary">Create Order</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function increaseCount(a, b, c) {
            var input = b.previousElementSibling;
            var color = b.nextElementSibling;
            var size = color.nextElementSibling;
            var value = parseInt(input.value, 10);
            value = isNaN(value) ? 0 : value;
            value++;
            input.value = value;
            color = color.value;
            size = size.value;

        }
        function decreaseCount(a, b) {
            var input = b.nextElementSibling;
            var color = input.nextElementSibling.nextElementSibling;
            var size = color.nextElementSibling;
            var value = parseInt(input.value, 10);
            if (value > 1) {
                value = isNaN(value) ? 0 : value;
                value--;
                input.value = value;
                color = color.value;
                size = size.value;
            }
        }
        /*function QtyChange(id, qty,color,size){
            $.ajax({
                url: "<?php echo e(route('ajax-update-Product')); ?>",
                type: 'post',
                data: {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    "product_id": id,
                    "qty": qty,
                    "color": color,
                    "size": size,
                },
                dataType: 'json',
                success: function(res) {
                    if (res.success) {
                        toastr.success(res.success);
                        $(".counterQty.id").val(res.qty);
                        location.reload();
                    }
                    if (res.error) {
                        toastr.error(res.error);
                        $(".counterQty").val(qty-1);
                    }
                }
            });
        }*/
    </script>
    <script>
        $(document).ready(function () {
            $('.customer').on('change', function () {
                let customerId = $(this).val();
                console.log(customerId);
                if (customerId) {
                    $.ajax({
                        url: `/customer/${customerId}/address`,
                        type: 'GET',
                        success: function (response) {
                            if (response.success) {
                                let areaOptions = '<option value="">Select Area</option>';
                                response.data.forEach(function (address) {
                                    areaOptions += `<option data-address-id="${address.id}" value="${address.id}">${address.type} : ${address.address} , ${address.place.name} ,${address.district.name} </option>`;
                                });
                                $('.customerAddress').html(areaOptions);
                                $('.customerAddress').attr('disabled', false);
                            }
                        },
                        error: function () {
                            alert('Error fetching areas. Please try again.');
                        }
                    });
                } else {
                    $('.area').html('<option value="">Select Address</option>');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.customerAddress').on('change', function() {
                var addressId = $(this).val();
                console.log(addressId)
                var orderTotal = $('#subtotal').val();
                var orderTax = $('#vat').val();
                var orderDiscount = $('#coupon_discount').val();
                console.log(orderTotal,orderTax);
                $.ajax({
                    url: '/get-customer-address-details',
                    method: 'GET',
                    data: { id: addressId },
                    success: function(response) {
                        if (response.success) {
                            $('#customer_name_span').text(response.address.customer_name);
                            $('#address_number_span').text(response.address.number);
                            $('#address_name_span').text(response.address.address);
                            $('#district_name_span').text(response.address.district.name);
                            $('#area_name_span').text(response.address.place.name);
                            $('#shipping_charge').val(response.address.place.shipping_cost);
                            $('#codApplied').text(response.address.place.cod_charge);
                            $('#cod_charge').val(Math.round((((response.address.place.cod_charge * orderTotal) / 100)) * 100) / 100  ?? 0);
                            shippingCost = parseFloat(response.address.place.shipping_cost) || 0; // Default to 0 if not a valid number
                            orderTotal = parseFloat(orderTotal) || 0;
                            orderTax = parseFloat(orderTax) || 0;
                            orderDiscount = parseFloat(orderDiscount) || 0;
                            orderCOD = parseFloat(Math.round((((response.address.place.cod_charge * orderTotal) / 100)) * 100) / 100) || 0;
                            // Calculate the sum
                            let subTotal = Math.round(((shippingCost + orderTotal + orderTax + orderCOD) - orderDiscount) * 100) / 100;
                            $('#grand_total').val(subTotal);
                        } else {
                            $('#selected-address').text('Error loading address data');
                        }
                    },
                    error: function() {
                        $('#selected-address').text('Failed to fetch address data');
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#special_discount').on('keyup', function() {
                var special_discount_amount = $(this).val();
                var subTotal = $('#subtotal').val();
                var vat_amount = $('#vat').val();
                var discountAmount = $('#coupon_discount').val();
                var codChargeAmount = $('#cod_charge').val();
                var shippingChargeAmount = $('#shipping_charge').val();
                var shippingDiscountAmount = $('#shippingDiscountAmount').val();

                console.log(special_discount_amount,subTotal,vat_amount,discountAmount,codChargeAmount,shippingChargeAmount,shippingDiscountAmount)
                // Calculate the sum
                subTotal = parseFloat(subTotal) || 0;
                codChargeAmount = parseFloat(codChargeAmount) || 0;
                shippingChargeAmount = parseFloat(shippingChargeAmount) || 0;
                vat_amount = parseFloat(vat_amount) || 0;
                discountAmount = parseFloat(discountAmount) || 0;
                special_discount_amount = parseFloat(special_discount_amount) || 0;
                shippingDiscountAmount = parseFloat(shippingDiscountAmount) || 0;
                let GrandTotal = Math.round(((subTotal + codChargeAmount + shippingChargeAmount + vat_amount) - (discountAmount + special_discount_amount + shippingDiscountAmount)));
                $('#subtotal').val(subTotal);
                $('#coupon_discount').val(discountAmount);
                $('#special_discount_amount').val(special_discount_amount);
                $('#cod_charge').val(codChargeAmount);
                $('#shipping_charge').val(shippingChargeAmount);
                $('#shippingDiscountAmount').val(shippingDiscountAmount);
                $('#vat').val(vat_amount);
                $('#grand_total').val(GrandTotal);
            });
            $('#shippingDiscountAmount').on('keyup', function() {
                var shippingDiscountAmount = $(this).val();
                var special_discount_amount = $('#special_discount').val();
                var subTotal = $('#subtotal').val();
                var vat_amount = $('#vat').val();
                var discountAmount = $('#coupon_discount').val();
                var codChargeAmount = $('#cod_charge').val();
                var shippingChargeAmount = $('#shipping_charge').val();
                // Calculate the sum
                subTotal = parseFloat(subTotal) || 0;
                codChargeAmount = parseFloat(codChargeAmount) || 0;
                shippingChargeAmount = parseFloat(shippingChargeAmount) || 0;
                vat_amount = parseFloat(vat_amount) || 0;
                discountAmount = parseFloat(discountAmount) || 0;
                special_discount_amount = parseFloat(special_discount_amount) || 0;
                shippingDiscountAmount = parseFloat(shippingDiscountAmount) || 0;
                let GrandTotal = Math.round(((subTotal + codChargeAmount + shippingChargeAmount + vat_amount) - (discountAmount + special_discount_amount + shippingDiscountAmount)));
                $('#subtotal').val(subTotal);
                $('#coupon_discount').val(discountAmount);
                $('#special_discount_amount').val(special_discount_amount);
                $('#cod_charge').val(codChargeAmount);
                $('#shipping_charge').val(shippingChargeAmount);
                $('#shippingDiscountAmount').val(shippingDiscountAmount);
                $('#vat').val(vat_amount);
                $('#grand_total').val(GrandTotal);
            });
            $('#vat').on('keyup', function() {
                var vat_amount = $(this).val();
                var special_discount_amount = $('#special_discount').val();
                var subTotal = $('#subtotal').val();
                var shippingDiscountAmount = $('#shippingDiscountAmount').val();
                var discountAmount = $('#coupon_discount').val();
                var codChargeAmount = $('#cod_charge').val();
                var shippingChargeAmount = $('#shipping_charge').val();

                // Calculate the sum
                subTotal = parseFloat(subTotal) || 0;
                codChargeAmount = parseFloat(codChargeAmount) || 0;
                shippingChargeAmount = parseFloat(shippingChargeAmount) || 0;
                vat_amount = parseFloat(vat_amount) || 0;
                discountAmount = parseFloat(discountAmount) || 0;
                special_discount_amount = parseFloat(special_discount_amount) || 0;
                shippingDiscountAmount = parseFloat(shippingDiscountAmount) || 0;
                let GrandTotal = Math.round(((subTotal + codChargeAmount + shippingChargeAmount + vat_amount) - (discountAmount + special_discount_amount + shippingDiscountAmount)));
                $('#subtotal').val(subTotal);
                $('#coupon_discount').val(discountAmount);
                $('#special_discount_amount').val(special_discount_amount);
                $('#cod_charge').val(codChargeAmount);
                $('#shipping_charge').val(shippingChargeAmount);
                $('#shippingDiscountAmount').val(shippingDiscountAmount);
                $('#vat').val(vat_amount);
                $('#grand_total').val(GrandTotal);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#apply-coupon').on('click', function() {
                var couponCode = $('#coupon-code').val().trim();
                var order_total = $('#subtotal').val();
                var orderTax = $('#vat').val();
                var orderDiscount = $('#coupon_discount').val();
                var orderCODCost = $('#cod_charge').val();
                var orderShippingCost = $('#shipping_charge').val();
                var shippingDiscountAmount = $('#shippingDiscountAmount').val();
                var special_discount_amount = $('#special_discount').val();
                console.log(couponCode,order_total,orderTax,orderDiscount,orderCODCost,orderShippingCost,shippingDiscountAmount,special_discount_amount);
                if (couponCode === '') {
                    $('#coupon-message').text('Please enter a coupon code').css('color', 'red');
                    return;
                }
                console.log(couponCode);
                $.ajax({
                    url: '/order-coupon-apply',
                    method: 'GET',
                    data: {
                        coupon_code: couponCode,
                        order_total: order_total,
                    },
                    success: function(response) {
                        console.log(response.success)
                        if (response.success) {
                            toastr.success(response.message);
                            subTotal = parseFloat(order_total) || 0;
                            codChargeAmount = parseFloat(orderCODCost) || 0;
                            shippingChargeAmount = parseFloat(orderShippingCost) || 0;
                            vat_amount = parseFloat(orderTax) || 0;
                            discountAmount = parseFloat(response.discount) || 0;
                            specialDiscountAmount = parseFloat(special_discount_amount) || 0;
                            shippingDisAmount = parseFloat(shippingDiscountAmount) || 0;
                            let GrandTotal = Math.round(((subTotal + codChargeAmount + shippingChargeAmount + vat_amount) - (discountAmount + specialDiscountAmount + shippingDisAmount)));

                            $('#subtotal').val(subTotal);
                            $('#coupon_discount').val(discountAmount);
                            $('#special_discount_amount').val(specialDiscountAmount);
                            $('#cod_charge').val(codChargeAmount);
                            $('#shipping_charge').val(shippingChargeAmount);
                            $('#shippingDiscountAmount').val(shippingDisAmount);
                            $('#vat').val(vat_amount);
                            $('#grand_total').val(GrandTotal);
                            $('#couponDiscount').text('৳ ' + response.discount);
                            $('#couponAmountAfterApply').text('Coupon Discount : ৳ ' + response.discount);

                            $('#coupon-code').prop('readonly', true);
                            $('#remove-coupon').prop('hidden', false);
                            $('#apply-coupon').prop('hidden', true);
                        } else {
                            toastr.error(response.error);
                        }
                    }
                });
            });
            $('#remove-coupon').on('click', function() {
                var couponCode = $('#coupon-code').val().trim();
                var order_total = $('#subtotal').val();
                var orderTax = $('#vat').val();
                var orderDiscount = $('#coupon_discount').val();
                var orderCODCost = $('#cod_charge').val();
                var orderShippingCost = $('#shipping_charge').val();
                var shippingDiscountAmount = $('#shippingDiscountAmount').val();
                var special_discount_amount = $('#special_discount').val();
                if (couponCode === '') {
                    $('#coupon-message').text('Please enter a coupon code').css('color', 'red');
                    return;
                }
                console.log(couponCode);
                $.ajax({
                    url: '/order-coupon-apply',
                    method: 'GET',
                    data: {
                        coupon_code: couponCode,
                        order_total: order_total,
                    },
                    success: function(response) {
                        console.log(response.success)
                        if (response.success) {
                            toastr.success('Remove Coupon Success');
                            $('#orderDiscount').val(response.discount);
                            subTotal = parseFloat(order_total) || 0;
                            codChargeAmount = parseFloat(codChargeAmount) || 0;
                            shippingChargeAmount = parseFloat(orderShippingCost) || 0;
                            vat_amount = parseFloat(orderTax) || 0;
                            discountAmount = parseFloat(response.discount) || 0;
                            special_discount_amount = parseFloat(special_discount_amount) || 0;
                            shippingDiscountAmount = parseFloat(shippingDiscountAmount) || 0;

                            let GrandTotal = Math.round(((subTotal + codChargeAmount + shippingChargeAmount + vat_amount) - (special_discount_amount + shippingDiscountAmount)));
                            $('#subtotal').val(subTotal);
                            $('#coupon_discount').val(discountAmount);
                            $('#special_discount_amount').val(special_discount_amount);
                            $('#cod_charge').val(codChargeAmount);
                            $('#shipping_charge').val(shippingChargeAmount);
                            $('#shippingDiscountAmount').val(shippingDiscountAmount);
                            $('#vat').val(vat_amount);
                            $('#grand_total').val(GrandTotal);

                            // Calculate the sum
                            $('#couponAmountAfterApply').empty();

                            $('#coupon-code').prop('readonly', false);
                            $('#coupon-code').val('');
                            $('#remove-coupon').prop('hidden', true);
                            $('#apply-coupon').prop('hidden', false);
                        } else {
                            toastr.error(response.error);
                        }
                    }
                });
            });
        });

    </script>
@endpush
