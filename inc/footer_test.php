</div>

</body>
</html>
<script>
    $(document).ready(function () {

        load_product();
        load_cart_data();
        load_cart_page_data();

        function load_product() {
            $.ajax({
                url: "fetch_item.php",
                method: "POST",
                success: function (data) {
                    $('#display_item').html(data);
                }
            });
        }

        function load_cart_data() {
            $.ajax({
                url: "fetch_cart.php",
                method: "POST",
                dataType: "json",
                success: function (data) {
                    $('#cart_details').html(data.cart_details);
                    $('.total_price').text(data.total_price);
                    $('.badge').text(data.total_item);
                }
            });
        }

        //////////////////////////////////////

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
                        // load_cart_data2();
                        alert("Item has been Added into Cart");
                    }
                });
            } else {
                alert("Please Enter Number of Quantity");
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
            if(confirm("Are you sure you want to remove this product?")) {
                $.ajax({
                    url: "action.php",
                    method: "POST",
                    data: {bookCartId: bookCartId, action: action},
                    success: function () {
                        load_cart_data();
                        load_cart_page_data();
                        alert ("Item has been removed from Cart");
                    }
                });
                $(this).closest('tr').remove();
            } else {
                return false;
            }
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

    });

</script>