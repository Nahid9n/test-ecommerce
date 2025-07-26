@include('website.includes.style')
<section class="mt-2 mb-50">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-6 my-2">
                <select name="category" class="p-2" id="categoryFilter">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-md-1 col-6 my-2">
                <select name="" class="p-2" id="sortByFilter">
                    <option value="">Sort By</option>
                    <option value="latest">Latest</option>
                    <option value="latest">Oldest</option>
                    <option value="a-to-z">A to Z</option>
                    <option value="z-to-a">Z to A</option>
                    <option value="low-to-high">Low to High</option>
                    <option value="high-to-low">High to Low</option>
                </select>
            </div>
            <div class="col-md-3 col-6 my-2 d-flex">
                <input type="number" id="min_price" placeholder="Min Price">
                <input type="number" id="max_price" placeholder="Max Price">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="row product-grid-3" id="filterProducts">
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
                                            <input hidden type="number" name="product_id" value="{{ $product->id }}">
                                            <div hidden class="attr-detail attr-color mb-15">
                                                <strong class="mr-10">Color</strong>
                                                <ul class="list-filter color-filter">
                                                    <li>
                                                        <select class="form-control" hidden name="color" id="">
                                                            @foreach($product->colors as $key => $color)
                                                                <option {{$key == 0 ? 'selected':''}} value="{{$color->color->name}}" style="background-color: {{ $color->color->code }}">{{ $color->color->name ?? '' }}</option>
                                                            @endforeach
                                                        </select>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div hidden class="attr-detail attr-size">
                                                <strong class="mr-10">Size</strong>
                                                <ul class="list-filter size-filter font-small">
                                                    <li>
                                                        <select class="form-control" hidden name="size" id="">
                                                            @foreach($product->sizes as $key1 => $size)
                                                                <option {{$key == 0 ? 'selected':''}} value="{{$size->size->name}}" >{{ $size->size->name ?? '' }}</option>
                                                            @endforeach
                                                        </select>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div hidden class="bt-1 border-color-1 mt-30 mb-30"></div>
                                            <div class="">
                                                <div class="row">
                                                    <input type="number" hidden name="qty" class="form-control w-100" value="1" min="1"  max="{{ $product->stock_amount }}"/>
                                                </div>
                                            </div>
                                            <button aria-label="Add To Cart" class="action-btn hover-up me-1"><i class="fi-rs-shopping-bag-add"></i></button>
                                        </form>
                                        <form action="{{route('wishlist.ad')}}" method="get" class="wishlist" id="wishListAdd{{rand()}}">
                                            <input hidden type="number" class="wish_product_id" name="product_id" value="{{ $product->id }}">
                                            <button aria-label="Add To Wishlist" class="action-btn hover-up" ><i class="fi-rs-heart"></i></button>
                                        </form>
                                    </div>
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
                                        <span class="hot bg-primary fw-bold badge" id="product-badge-{{ $product->id }}">new</span>
                                    </div>
                                    <div class="product-badges product-badges-position-right text-center product-badges-mrg">
                                        <span class="hot p-1 rounded-3 {{ $product->stock_amount >= 11 ? 'bg-success text-dark':'bg-danger text-white' }}"> {{ $product->stock_visibility == 1 ? $product->stock_amount :''}} {{ $product->stock_amount >= 11 ? 'In Stock ':'Stock Out' }}</span>
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="product-category">
                                        <a href="{{route('product-category',$product->category->slug)}}">{{$product->category->name}}</a>
                                    </div>
                                    <h2><a href="{{ route('product-detail',$product->slug) }}">{{ \Illuminate\Support\Str::limit($product->name, 85)}}</a></h2>
                                    <div class="product-price">
                                        @if(isset($product->discount_value))
                                            <span class="text-brand">৳
                                                        @if($product->discount_type == 0)
                                                    {{ $product->regular_price - $product->discount_value }}
                                                @elseif($product->discount_type == 1)
                                                    {{ $product->regular_price - (($product->regular_price * $product->discount_value)/100) }}
                                                @else
                                                    {{ $product->regular_price }}
                                                @endif
                                                    </span>
                                            <span class="old-price font-md ml-15">Tk.{{ $product->regular_price }} </span>
                                        @else
                                            <span class="text-brand">৳ {{ $product->selling_price }} </span>
                                            <span class="old-price font-md ml-15">৳ {{ $product->regular_price }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            @if(\App\Models\Product::count() > $products->count())
                <!-- Load More Button -->
                    <div class="text-center mt-4">
                        <button id="load-more" class="btn btn-primary" data-page="1">Load More</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@include('website.includes.script')
@push('js')
    <script>
        /* product page all filter */
        $(document).ready(function () {
            function fetchFilteredProducts() {
                let filters = {
                    category_id: $('#categoryFilter').val(),
                    subcategory_id: $('#subCategoryId').val(),
                    brand_id: $('#brandFilter').val(),
                    size: $('#sizeFilter').val(),
                    color: $('#colorFilter').val(),
                    min_price: $('#min_price').val(),
                    max_price: $('#max_price').val(),
                    // keyword: $('#globalSearch').val(),
                };

                // Send AJAX request to fetch filtered products
                $.ajax({
                    url: '{{ route('product.filter') }}',
                    type: 'GET',
                    data: filters,
                    dataType: 'html',
                    success: function(res) {
                        if (res == '0') {
                            $('#filterProducts').text("Product not found");
                        } else {
                            $('#filterProducts').html(res);
                            /*updatePaginationLinks();*/
                        }
                    }
                });
            }

            // Trigger fetchFilteredProducts on change/input
            $('#categoryFilter').on('change', function () {
                var category = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('get-sub-category-by-category-filter') }}",
                    data: { category_id: category },
                    success: function (response) {
                        let options = '<option value="">Select Subcategory</option>';
                        response.forEach(subcategory => {
                            options += `<option value="${subcategory.id}">${subcategory.name}</option>`;
                        });
                        $('#subCategoryId').html(options);
                    }
                })
                fetchFilteredProducts();
            });
            $('#subCategoryId').on('change', function () {
                fetchFilteredProducts();
            });
            $('#brandFilter').on('change', function () {
                fetchFilteredProducts();
            });
            $('#sizeFilter').on('change', function () {
                fetchFilteredProducts();
            });
            $('#colorFilter').on('change', function () {
                fetchFilteredProducts();
            });
            $('#min_price').on('input', function () {
                fetchFilteredProducts();
            });
            $('#max_price').on('input', function () {
                fetchFilteredProducts();
            });
            // $('#globalSearch').on('input', function () {
            //     fetchFilteredProducts();
            // });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.wishlist').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('value');
                $.ajax({
                    url: "{{ route('wishlist.ad') }}",
                    type: "GET",
                    dataType: 'json',
                    data: {
                        product_id: id,
                    },
                    success: function(res) {
                        if (res.status !== false) {
                            toastr.success(res.message);
                            $('#wishlistCartCount').empty('');
                            $('#wishlistCartCount').append('<span class="old-price"> '+res.count+'</span>');
                        } else {
                            toastr.error(res.error);
                        }
                    },

                    error: function(xhr, status, error) {
                        console.error(xhr);
                    }
                });
            });

            $(document).on('submit', '.addTocart', function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                var url = $(this).attr('action');
                $.ajax({
                    url: url,
                    type: "post",
                    dataType: 'json',
                    data: formData,
                    success: function(res) {
                        if (res.status !== false) {
                            toastr.success(res.message);
                            $('#CartItemCount').empty('');
                            $('#CartItemCount').append('<span class="old-price"> '+res.count+'</span>');
                            getCartDetails();

                        } else {
                            toastr.error(res.error);
                        }
                    },

                    error: function(xhr, status, error) {
                        console.error(xhr);
                    }
                });
            });
            function getCartDetails() {
                $.ajax({
                    url: "{{ route('get-cart-details') }}",
                    type: "GET",
                    dataType: 'html',
                    success: function(res) {
                        $('#cartItems').empty('');
                        $('#cartItems').append(res);
                    }
                });
            }




        });
    </script>
@endpush
