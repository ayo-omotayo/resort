<?php
    include_once 'utilities/autoload.php';

    $url = "http://localhost/mainlandbooks/products/read.php";
    $object = $api->curlQueryGet($url);
    $output="";
    foreach ($object->products as $item) {
        $output .= '
                <div class="item">
                    <div class="card">
                        <div class="img_wrp">
                            <div class="img_text">
                                <div><button class="btn btm-sm" style="background-color: transparent;"> <i class="fa fa-heart fa-2x"></i></button></div>
                                <div><button class="btn btm-sm" style="background-color: transparent"> <i class="fa fa-shopping-cart fa-2x"></i></button></div>
                            </div>
                            <img src="admin/upload/7f13b58b37.png" class="img-fluid card-img-top owl-lazy card-img"  style="width: 236px; height:341px" />
                        </div>
                        <div class="card-body">
                            <h6 class="card-title">How to Study Smart</h6>
                            <div class="book-tile" style="text-align: center">
                                <p>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i><br />
                                    <span class="book-price">₦1000</span>
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
        ';
    }
echo $output;


?>
