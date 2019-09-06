<?php
session_start();

$total_price = 0;
$total_item = 0;

$output = '<div class="container-fluid">';

if (!empty($_SESSION['shopping_cart'])) {
    foreach ($_SESSION["shopping_cart"] as $keys => $values) {
        $output .= '
  
                    <div class="row cart-item border-top">
                        <div class="col">
                            <img src="admin/'.$values['bookCartImage'].'" class="img img-fluid" style="width: 50px; height: 50px;">
                        </div>
                        <div class="col-7" style="max-width: 200px">
                                <div class="cart-dropdown-title">'.$values['bookCartName'].'</div><b>'.$values['bookQuantity'].' x 
                                ₦ '.number_format($values['bookPrice'], 0).'</b>
                        </div>
                        <div class="col-2">
                            <button type="button" name="delete" style="background: transparent; border: none; cursor: pointer" 
                                    class="cart-dropdown-remove delete" id="'.$values["bookCartId"].'">
                                <i class="fa fa-times fa-1x "></i>
                            </button>
                        </div>
                    </div>
                    
                ';
        $total_price = $total_price + ($values['bookPrice'] * $values['bookQuantity']);
        $total_item = $total_item + 1;
    }
    $output .= '
        <div class="row">
            <div class="col">
                <a href="" class="btn btn-primary cart-dropdown-btn"><i class="fa fa-cart-plus"></i> Checkout</a>
                <a href="" class="btn btn-primary cart-dropdown-btn"><i class="fa fa-shopping-cart"></i> View cart</a>
            </div>
        </div></div>
    ';
} else {
    $output .= '
                <div class="row cart-item border-top">
                    <h5>Cart is Empty</h5>
                </div>
            </div>
        ';
}
$data = array(
    'cart_details'  => $output,
    'total_price'   => '₦'.number_format($total_price, 0),
    'total_item'    => $total_item
);

echo json_encode($data);

?>