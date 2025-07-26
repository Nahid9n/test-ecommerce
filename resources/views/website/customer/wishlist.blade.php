@extends('website.master')
@section('title','Wishlists ')
@section('body')


    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route('home')}}" rel="nofollow">Home</a>
                <span></span> Wishlists
            </div>
        </div>
    </div>


    <section class="mb-50">
        <div class="container p-2" style="background-color: #000000">
            <div class="row" style="margin-right: 0; margin-left: 0; --bs-gutter-x: 0;">
                <div class="card bg-transparent text-white">
                    <div class="card-header text-center">
                        <h5>YOUR WISHLIST</h5>
                    </div>
                    <div class="card-body text-white">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="shopping-summery text-center">

                                    <thead>
                                    <tr class="main-heading">
                                        <th scope="col">SL</th>
                                        <th scope="col" colspan="2">Product</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Stock Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @if (count($wishlists) > 0)
                                        @foreach($wishlists as $key => $wishListItem)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td class="image product-thumbnail">
                                                    <a href="{{ route('product-detail',$wishListItem->product->slug)}}">
                                                        <img width="25" src="{{ asset($wishListItem->product->image) }}" alt="#">
                                                    </a>
                                                </td>
                                                <td class="product-des product-name" style="width: 300px;">
                                                    <h5 class="product-name"><a class="text-white" href="{{ route('product-detail',$wishListItem->product->slug)}}">{{$wishListItem->product->name}}</a></h5>
                                                </td>
                                                <td class="price" data-title="Price">
                                                    <span class="text-white">৳
                                                        @if($wishListItem->product->discount_type == 0)
                                                            {{ $price =  $wishListItem->product->regular_price - $wishListItem->product->discount_value }}
                                                        @elseif($wishListItem->product->discount_type == 1)
                                                            {{ $price = $wishListItem->product->regular_price - (($wishListItem->product->regular_price * $wishListItem->product->discount_value)/100) }}
                                                        @else
                                                            {{ $price = $wishListItem->product->selling_price }}
                                                        @endif
                                                    </span>
                                                </td>
                                                <td class="text-center" data-title="Stock">
                                                    <span class="color3 font-weight-bold text-white">In Stock: {{$wishListItem->product->stock_amount}}</span>
                                                </td>
                                                <td class="text-right" data-title="Cart">
                                                    <div class="d-flex justify-content-center">
                                                        <button aria-label="Add To Cart" data-bs-target="#wishListCart{{$rand = rand()}}" data-bs-toggle="modal" class="border-0 p-0 mx-1 rounded-3"><i class="btn-sm btn-success fi-rs-shopping-bag-add"></i></button>
                                                        <form action="{{ route('wishlist.destroy',$wishListItem->id) }}" method="post">

                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit" data-title="Remove" class="border-0 p-0 rounded-3" onclick="return confirm('Are you sure to delete?') ">
                                                                <i class="btn-sm btn-danger fi-rs-trash"></i>
                                                            </button>

                                                        </form>
                                                        <!-- Modal -->
                                                        <div  class="modal fade" id="wishListCart{{$rand}}" tabindex="-1" aria-labelledby="onloadModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-sm">
                                                                <div class="modal-content">
                                                                    <button type="button" class="btn-close float-end text-danger p-2" id="close-popup" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    <div class="modal-body">
                                                                        <form action="{{route('wishlist.cart.ad')}}" method="post" class="" id="addToCart">
                                                                            @csrf
                                                                            <input hidden type="number" name="product_id" value="{{ $wishListItem->product->id }}">
                                                                            <div class="mb-15">
                                                                                <strong class="" style="color: #0d0a0a">Color</strong>
                                                                                <select class="form-control" name="color" id="">
                                                                                    @foreach($wishListItem->product->colors as $key => $color)
                                                                                        <option {{$key == 0 ? 'selected':''}} value="{{$color->color->name}}" style="background-color: {{ $color->color->code }}">{{ $color->color->name ?? '' }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <div class="">
                                                                                <strong class="mr-10" style="color: #0d0a0a">Size</strong>
                                                                                <select class="form-control" name="size" id="">
                                                                                    @foreach($wishListItem->product->sizes as $key1 => $size)
                                                                                        <option {{$key == 0 ? 'selected':''}} value="{{$size->size->name}}" >{{ $size->size->name ?? '' }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <div hidden class="bt-1 border-color-1 mt-30 mb-30"></div>
                                                                            <div class="">
                                                                                <div class="row">
                                                                                    <input type="number" name="qty" class="form-control w-100" value="1" min="1"  max="{{ $wishListItem->product->stock_amount }}"/>
                                                                                </div>
                                                                            </div>
                                                                            <button aria-label="Add To Cart" class="border-0 p-0 mx-1 rounded-3"><i class="btn-sm btn-success fi-rs-shopping-bag-add"></i></button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                    @else

                                        <h4 class="text-center text-success">No product available at wishlist.</h4>

                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>



@endsection

