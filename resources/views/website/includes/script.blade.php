

<!-- DATA TABLE JS-->
<script src="{{asset('/')}}admin/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="{{asset('/')}}admin/assets/plugins/datatable/js/dataTables.bootstrap5.js"></script>
<script src="{{asset('/')}}admin/assets/plugins/datatable/js/dataTables.buttons.min.js"></script>
<script src="{{asset('/')}}admin/assets/plugins/datatable/js/buttons.bootstrap5.min.js"></script>
<script src="{{asset('/')}}admin/assets/plugins/datatable/js/jszip.min.js"></script>
<script src="{{asset('/')}}admin/assets/plugins/datatable/pdfmake/pdfmake.min.js"></script>
<script src="{{asset('/')}}admin/assets/plugins/datatable/pdfmake/vfs_fonts.js"></script>
<script src="{{asset('/')}}admin/assets/plugins/datatable/js/buttons.html5.min.js"></script>
<script src="{{asset('/')}}admin/assets/plugins/datatable/js/buttons.print.min.js"></script>
<script src="{{asset('/')}}admin/assets/plugins/datatable/js/buttons.colVis.min.js"></script>
<script src="{{asset('/')}}admin/assets/plugins/datatable/dataTables.responsive.min.js"></script>
<script src="{{asset('/')}}admin/assets/plugins/datatable/responsive.bootstrap5.min.js"></script>
<script src="{{asset('/')}}admin/assets/js/table-data.js"></script>
<!-- Template  JS -->

<!-- INTERNAL DATA-TABLES JS-->
<script src="{{asset('/')}}admin/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="{{asset('/')}}admin/assets/plugins/datatable/js/dataTables.bootstrap5.js"></script>
<script src="{{asset('/')}}admin/assets/plugins/datatable/dataTables.responsive.min.js"></script>

<script src="{{asset('/')}}website/assets/js/maind134.js?v=3.4"></script>
<script src="{{asset('/')}}website/assets/js/shopd134.js?v=3.4"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    toastr.options = {
        "progressBar" : true,
        "closeButton" : true,
    }
    @if(Session::has('message'))
    toastr.success("{{ Session::get('message') }}");

    @elseif(Session::has('warning'))
    toastr.warning("{{ Session::get('warning') }}");

    @elseif(Session::has('info'))
    toastr.info("{{ Session::get('info') }}");

    @elseif(Session::has('error'))
    toastr.error("{{ Session::get('error') }}");
    @endif
</script>

<script src="{{asset('/')}}website/assets/js/toastr.min.js"></script>
{!! Toastr::message() !!}


<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
        $('.select2-selection').css({'width': '580px'});
    });
</script>

<script>
    $(document).ready(function() {
        $('.summernote').summernote();
    });
</script>

<script>
    $('#globalSearch').on('keyup', function () {
        const query = $(this).val();
        if(query.length >= 3){
            $.ajax({
                type: "GET",
                url: "{{ route('products.search') }}",
                data: {search_text: query},
                dataType: "html",
                success: function (response) {
                    $('#mainContainer').empty();
                    $('#mainContainer').append(response);
                }
            });
        }
    });
    $('#globalSearchMobile').on('keyup', function () {
        const query = $(this).val();
        if(query.length >= 3){
            $.ajax({
                type: "GET",
                url: "{{ route('products.search') }}",
                data: {search_text: query},
                dataType: "html",
                success: function (response) {
                    $('#mainContainer').empty();
                    $('#mainContainer').append(response);
                }
            });
        }
    });
</script>

<script>
    $(document).ready(function () {
        $('#filterBtn').click(function () {
            const categoryId = $('#category').val();
            const minPrice = $('#min_price').val();
            const maxPrice = $('#max_price').val();

            $.ajax({
                url: '{{ route('product.filter') }}',
                type: 'GET',
                data: {
                    category_id: categoryId,
                    min_price: minPrice,
                    max_price: maxPrice
                },
                dataType: 'html',
                success: function(res) {
                    if (res == '0') {
                        $('#filterProducts').text("Product not found");
                    } else {
                        $('#filterProducts').html(res);
                    }
                }
            });
        });
    });
</script>
<script>
    /* product page all filter */
    /*$(document).ready(function () {
        function fetchFilteredProducts(keyword) {
            let filters = {
                category_id: $('#categoryFilter').val(),

                min_price: $('#min_price').val(),
                max_price: $('#max_price').val(),

            };
            console.log(keyword)
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
                        /!*updatePaginationLinks();*!/
                    }
                }
            });
        }

        // Trigger fetchFilteredProducts on change/input
        $('#categoryFilter').on('change', function () {
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
        $('#sortByFilter').on('change', function () {
            fetchFilteredProducts();
        });
        $('#min_price').on('input', function () {
            fetchFilteredProducts();
        });
        $('#max_price').on('input', function () {
            fetchFilteredProducts();
        });
        $('#globalSearch').on('keyup', function () {
            var keyword =  $('#globalSearch').val();
            // if(keyword.length >= 3){
                fetchFilteredProducts(keyword);
            // }
        });
        $('#globalSearchMobile').on('keyup', function () {
            var keyword =  $('#globalSearchMobile').val();
            // if(keyword.length >= 3){
                fetchFilteredProducts(keyword);
            // }
        });
        // $('#globalSearch').on('input', function () {
        //     fetchFilteredProducts();
        // });
    });*/
    function updatePaginationLinks() {
        $('.pagination-links a').on('click', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            var jsonString = "{{ $data }}";
            filter(page,jsonString);
        });
    }
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

        if(c != 2){
            QtyChange(a, value,color,size);
        }

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
            QtyChange(a, value,color,size);
        }
    }
    function QtyChange(id, qty,color,size){
        $.ajax({
            url: "{{ route('ajax-update-Product') }}",
            type: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
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
    }
</script>
<script src="{{asset('/')}}website/assets/owl-carousel/jquery.mousewheel.min.js"></script>
@stack('js')
<script>
    $(document).ready(function() {
        var owl = $('.owl-carousel');
        owl.owlCarousel({
            loop: true,
            autoplay:true,
            autoplayTimeout:3000,
            nav: true,
            margin: 10,
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 3
                },
                960: {
                    items: 4
                },
                1200: {
                    items: 5
                }
            }
        });
    })
</script>
<script src="{{asset('/')}}website/assets/owl-carousel/owl.carousel.js"></script>
<script>
    var acc = document.getElementsByClassName("accordion");
    var i;
    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        });
    }
</script>
<script>
    $(document).ready(function() {

        $('.product-card').each(function() {
            const badgeElement = $(this).find('.badge');
            const badges = JSON.parse($(this).attr('data-badges'));
            let currentIndex = 0;
            setInterval(function() {
                badgeElement.text(badges[currentIndex]);
                currentIndex = (currentIndex + 1) % badges.length;
            }, 1500);
        });
    });
</script>

