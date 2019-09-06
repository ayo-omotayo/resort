<?php
    session_start();

    $total_price = 0;
    $total_item = 0;

    $output = '
        <div class="table-responsive" id="order_table">
            <table class="table table-bordered table-striped">
                <tr>
                    <th width="30%">Product Name</th>
                    <th width="20%">Quantity</th>
                    <th width="20%">Price</th>
                    <th width="15%">Total</th>
                    <th width="5%">Action</th>
                </tr>
            
    ';
    if (!empty($_SESSION['shopping_cart'])) {
        foreach ($_SESSION["shopping_cart"] as $keys => $values) {
            $output .= '
                <tr>
                    <td>'.$values['bookCartName'].'</td>
                    <td>
                        <div class="input-group">
                            <input type="button" value="-" class="button-minus" data-field="quantity">
                            <input type="number" step="1" max="" value="'.$values['bookQuantity'].'" name="bookQty" id="bookQty" class="quantity-field bookQty">
                            <input type="button" value="+" class="button-plus" data-field="quantity">
                        </div>
                             <input type="hidden" class="bookId"  value="'.$values['bookCartId'].'" name="bookId" id="bookId">
                             <input type="hidden" class="bookPrice" value="'.$values['bookPrice'].'" name="bookPrice" id="bookPrice">
                    </td>
                    <td align="right">₦ '.$values['bookPrice'].'</td>
                    <td align="right">'.number_format($values['bookQuantity'] * $values['bookPrice'], 2).'</td>
                    <td><button name="delete" class="btn btn-danger 
                        btn-sm delete" id="'.$values["bookCartId"].'">Remove</button></td>
                </tr>
            ';
            $total_price = $total_price + ($values['bookPrice'] * $values['bookQuantity']);
            $total_item = $total_item + 1;
        }
        $output .= '
            <tr>
                <td colspan="3" align="right">Total</td>
                <td align="right">₦ '.number_format($total_price, 2).'</td>
                <td></td>
            </tr>
        ';
    } else {
        $output .= '
            <tr>
                <td colspan="5" align="center">
                    Your Cart is Empty!
                </td>
            </tr>
        ';
    }
    $output .= '</table></div>';
    $data = array(
        'cart_page_details'  => $output,
        'total_price_cart_page' => '₦'.number_format($total_price, 2),
        'total_item'    => $total_item
    );

    echo json_encode($data);

?>