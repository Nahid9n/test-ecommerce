
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <title>Top Ecommerce | @yield('title')</title>

    @include('website.includes.meta')
    @include('website.includes.style')
    <style>
        .main {
            position: relative;
        }
        .main::before {
            content: "";
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>

</head>

<body class="" style="overflow-x: hidden">


@include('website.includes.header')

<main class="" id="mainContainer">
   @yield('body')
</main>


@include('website.includes.footer')
<!-- Vendor JS-->
<script src="{{asset('/')}}website/assets/js/vendor/jquery-3.6.0.min.js"></script>
<script src="{{asset('/')}}website/assets/js/vendor/modernizr-3.6.0.min.js"></script>
{{--<script src="{{asset('/')}}website/assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>--}}
<script src="{{asset('/')}}website/assets/js/vendor/bootstrap.bundle.min.js"></script>
<script src="{{asset('/')}}website/assets/js/plugins/slick.js"></script>
<script src="{{asset('/')}}website/assets/js/plugins/jquery.syotimer.min.js"></script>
<script src="{{asset('/')}}website/assets/js/plugins/wow.js"></script>
<script src="{{asset('/')}}website/assets/js/plugins/jquery-ui.js"></script>
<script src="{{asset('/')}}website/assets/js/plugins/perfect-scrollbar.js"></script>
<script src="{{asset('/')}}website/assets/js/plugins/magnific-popup.js"></script>
<script src="{{asset('/')}}website/assets/js/plugins/select2.min.js"></script>
<script src="{{asset('/')}}website/assets/js/plugins/waypoints.js"></script>
<script src="{{asset('/')}}website/assets/js/plugins/counterup.js"></script>
<script src="{{asset('/')}}website/assets/js/plugins/jquery.countdown.min.js"></script>
<script src="{{asset('/')}}website/assets/js/plugins/images-loaded.js"></script>
<script src="{{asset('/')}}website/assets/js/plugins/isotope.js"></script>
<script src="{{asset('/')}}website/assets/js/plugins/scrollup.js"></script>
<script src="{{asset('/')}}website/assets/js/plugins/jquery.vticker-min.js"></script>
<script src="{{asset('/')}}website/assets/js/plugins/jquery.theia.sticky.js"></script>
<script src="{{asset('/')}}website/assets/js/plugins/jquery.elevatezoom.js"></script>
<script src="{{asset('/')}}website/assets/summernote/summernote-bs4.min.js"></script>
@include('website.includes.script')
<script>
    $(document).ready(function() {
        const initialLoadedCount = $('#filterProducts .product').length;
        let page = 0; // Start with page 1 for "Load More"
        $('#load-more').click(function() {
            page++; // Increment page number on each click

            $.ajax({
                url: '{{route('product.loadMore')}}',
                method: 'GET',
                data: { page: page,
                        initialLoaded: initialLoadedCount,
                },
                success: function(response) {
                    if (response.html) {
                        $('#filterProducts').append(response.html); // Append products
                    }

                    if (!response.hasMore) {
                        // No more pages, disable the button
                        $('#load-more').text('No More Products').prop('disabled', true);
                    } else {
                        // Increment page number
                        $('#load-more').data('page', page + 1);

                    }
                },
                error: function() {
                    alert('Error loading products.');
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(document).on('submit', '.wishlist', function(e) {
            e.preventDefault();
            var formData = $(this).find('.wish_product_id').val();
            var url = $(this).attr('action');
            console.log(formData);
            $.ajax({
                url: url,
                type: "get",
                dataType: 'json',
                data: {
                    product_id:formData,
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
        $(document).on('submit', '.wishListAddToCart', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            var url = $(this).attr('action');
            // Close the modal
            $('#wishListCart').modal('hide');
            // Optionally, clear the form
            $('#addToCart')[0].reset();
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
<script>
    $(document).ready(function() {
        // Get today's date in YYYY-MM-DD format
        var today = new Date();
        var formattedDate = today.getFullYear() + '-' + (today.getMonth() + 1).toString().padStart(2, '0') + '-' + today.getDate().toString().padStart(2, '0');

        // Get the date when the popup was last shown from localStorage
        var popupShownDate = localStorage.getItem('popup_shown_date');

        // If the popup hasn't been shown today, display the modal
        if (popupShownDate !== formattedDate) {
            // Show the modal using Bootstrap's modal method
            $('#onloadModal').modal('show');

            // Store today's date in localStorage
            localStorage.setItem('popup_shown_date', formattedDate);
        }
    });
</script>

</body>

</html>
