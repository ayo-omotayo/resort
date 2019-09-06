<?php
    include_once 'utilities/autoload.php';

    $url = "http://localhost/mainlandbooks/products/read.php";
    $object = $api->curlQueryGet($url);
    $output="";
    foreach ($object->products as $item) {
            $output .= '
                <div class="col-md-3" style="margin-top: 12px;">
                    <div style="border: 1px solid #333; background-color: #f1f1f1;
                    border-radius: 5px; padding: 16px; " align="center">
                        <img alt="cart_item" width="70%" src="admin/'.$item->image.'"
                            class="img-responsive" /><br />
                        <h4 class="text-info">'.$item->bookName.'</h4>
                        <h4 class="text-danger">₦ '.$item->price.'</h4>
                        <input type="text" name="quantity" id="quantity'
                            .$item->bookId . '" class="form-control" value="1">
                        <input type="hidden" name="hidden_name" id="name'
                            .$item->bookId . '"  value="'.$item->bookName.'">
                        <input type="hidden" name="hidden_price" id="price'
                            .$item->bookId . '"  value="'.$item->price.'">
                        <input type="hidden" name="hidden_image" id="image'
                            .$item->bookId . '"  value="'.$item->image.'">
                        <input type="button" name="add_to_cart" id="'
                            .$item->bookId . '" style="margin: 5px; "
                            class="btn btn-success form-control add_to_cart"
                            value="Add to Cart" />
                    </div>
                </div>
            ';
}

echo $output;


?>
