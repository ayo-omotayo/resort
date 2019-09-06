<footer class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col">
                <ul>
                    <li class="footer-header">
                        <h5>MAINLAND BOOKS</h5>
                    </li>
                    <li>+234 8077564555</li>
                    <li>Info@mainlandbooks</li>
                </ul>
            </div>
            <div class="col">
                <ul>
                    <li class="footer-header">
                        <h5>CUSTOMER SERVICE</h5>
                    </li>
                    <li>FAQS</li>
                    <li>Payment Information</li>
                    <li>Terms & Conditions</li>
                </ul>
            </div>
            <div class="col">
                <ul>
                    <li class="footer-header">
                        <h5>FOLLOWS US ON</h5>
                    </li>
                    <li>Twitter</li>
                    <li>Facebook</li>
                    <li>Instagram</li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <hr />
            </div>
        </div>
        <div class="row">
            <div class="col">
                <span class="copyright">Copyright ©2019 – Mainland books</span>
            </div>
        </div>
    </div>
</footer>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/toastr.min.js"></script>
<script src="js/jquery-confirm.min.js"></script>
<!-- owl jquery -->
<script src="js/owl/owl.carousel.min.js"></script>
<script src="js/app.js"></script>
<script>
    $(document).ready(function () {
        $('.pop').popover({
            trigger: 'manual',
            html: true,
            animation: false
        }).on('mouseenter', function () {
            var _this = this;
            $(this).popover('show');
            $('.popover').on('mouseleave', function () {
                $(_this).popover('hide');
            });
        }).on('mouseleave', function () {
            var _this = this;
            setTimeout(function () {
                if (!$('.popover:hover').length) {
                    $(_this).popover('hide');
                }
            }, 300);
        });
    });
</script>
<script>
    $(document).ready(function () {
        load_cart_data();

        function load_cart_data() {
            $.ajax({
                url: "fetch_cart.php",
                method: "POST",
                dataType: "json",
                success: function (data) {
                    $('#cart_details').html(data.cart_details);
                    $('.total_price').text(data.total_price);
                    $('.cart-counter').text(data.total_item);
                }
            });
        }

        function load_cart_page_data() {
            $.ajax({
                url: "fetch_cart_page.php",
                method: "POST",
                dataType: "json",
                success: function (data) {
                    $('#cart_page').html(data.cart_page_details);
                    $('.total_price_cart_page').text(data.total_price_cart_page);
                    $('.badge').text(data.total_item);
                }
            });
        }

        $('#cart-popover').popover({
            html: true,
            container: 'body',
            content: function () {
                return $('#popover_content_wrapper').html();
            }
        });

        $(document).on('click', '.add_to_cart', function() {
            var bookCartId = $(this).attr("id");
            var bookCartName = $('#name'+bookCartId+'').val();
            var bookPrice = $('#price'+bookCartId+'').val();
            var bookQuantity = $('#quantity'+bookCartId).val();
            var bookImage = $('#image'+bookCartId).val();
            var action = "add";

            if(bookQuantity > 0) {
                $.ajax({
                    url: "action.php",
                    method: "POST",
                    data: {bookCartId: bookCartId, bookCartName: bookCartName,
                        bookPrice: bookPrice, bookQuantity:bookQuantity,bookCartImage:bookImage,
                        action: action},
                    success: function (data) {
                        load_cart_data();
                        toastr.success('Item has been Added into Cart');
                    }
                });
            } else {
                toastr.error("Cannot Add item to Cart");
            }
        });

        $(document).on('click', '.add_to_wlist', function() {
            var bookCartId = $(this).attr("id");
            var bookCartName = $('#name'+bookCartId+'').val();
            var bookPrice = $('#price'+bookCartId+'').val();
            var bookQuantity = $('#quantity'+bookCartId).val();
            var bookImage = $('#image'+bookCartId).val();
            var action = "add_wlist";

            if(bookQuantity > 0) {
                $.ajax({
                    url: "action.php",
                    method: "POST",
                    data: {bookCartId: bookCartId, bookCartName: bookCartName,
                        bookPrice: bookPrice, bookQuantity:bookQuantity,bookCartImage:bookImage,
                        action: action},
                    success: function (data) {
                        if ($.trim(data) === "loginError") {
                            toastr.error('Unauthorized, kindly login to add item to WishList');
                            setTimeout(function () {
                                window.location.href = "login";
                            }, 3000);
                        } else if($.trim(data)=== "insertedTrue") {
                            toastr.success('Item saved to your WishList');
                        } else if($.trim(data)=== "exist") {
                            toastr.info('Item already in WishList');
                        }
                    }
                });
            }
        });

        $(document).on('click', '.button-minus', function(){
            var $el = $(this).closest('tr');
            var bid = $el.find(".bookId").val();
            var bprice = $el.find(".bookPrice").val();
            var bqty = $el.find(".bookQty").val();
            var action ="minus_qty";
            $.ajax({
                url: "action.php",
                method: "POST",
                cache: false,
                data: {bookCartId: bid,bookPrice: bprice, bookQuantity:bqty,
                    action: action},
                success: function (data) {
                    load_cart_data();
                    load_cart_page_data();
                }
            });
        });

        $(document).on('click', '.button-plus', function(){
            var $el = $(this).closest('tr');
            var bid = $el.find(".bookId").val();
            var bprice = $el.find(".bookPrice").val();
            var bqty = $el.find(".bookQty").val();
            var action ="add_qty";
            $.ajax({
                url: "action.php",
                method: "POST",
                cache: false,
                data: {bookCartId: bid,bookPrice: bprice, bookQuantity:bqty,
                    action: action},
                success: function (data) {
                    load_cart_data();
                    load_cart_page_data();
                }
            });
        });

        $(document).on('change', '.bookQty', function(){
            var $el = $(this).closest('tr');
            var bid = $el.find(".bookId").val();
            var bprice = $el.find(".bookPrice").val();
            var bqty = $el.find(".bookQty").val();
            var action ="update";
            $.ajax({
                url: "action.php",
                method: "POST",
                cache: false,
                data: {bookCartId: bid,bookPrice: bprice, bookQuantity:bqty,
                    action: action},
                success: function (data) {
                    load_cart_data();
                    load_cart_page_data();
                }
            });
        });

        $(document).on('click', '.delete', function(){
            var bookCartId = $(this).attr("id");
            var action = "remove";
            $.ajax({
                url: "action.php",
                method: "POST",
                data: {bookCartId: bookCartId, action: action},
                success: function () {
                    load_cart_data();
                    load_cart_page_data();
                    toastr.info("Item removed from cart");
                }
            });
            $(this).closest('.cart-item').remove();
        });

        $(document).on('click', '#clear_cart', function(){
            var action = 'empty';
            $.ajax({
                url: "action.php",
                method: "POST",
                data: {action: action},
                success: function () {
                    load_cart_data();
                    $('#cart-popover').popover('hide');
                    alert ("Your Cart has been clear");
                }
            });
        });

        // $(document).on('click', '#test', function () {
        //     $.confirm({
        //         title: 'Mainlandbooks',
        //         content: 'Are you sure you want to remove item?',
        //         type: 'green',
        //         buttons: {
        //             ok: {
        //                 text: "ok!",
        //                 btnClass: 'btn-primary',
        //                 keys: ['enter'],
        //                 action: function(){
        //                     console.log('the user clicked confirm');
        //                 }
        //             },
        //             cancel: function(){
        //                 console.log('the user clicked cancel');
        //             }
        //         }
        //     });
        // });

    });

</script>
</body>

</html>