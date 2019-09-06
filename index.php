<?php include 'inc/header.php'; ?>
<div id="carouselExampleIndicators" class="carousel slide banner-carousel" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="./images/banner/banner-slide-1.png" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
                <p><a href="#" class="btn btn-lg btn-primary shadow-sm">Shop now</a></p>
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="./images/banner/banner-slide-1.png" alt="Second slide">
            <div class="carousel-caption d-none d-md-block">
                <p><a href="#" class="btn btn-lg btn-primary shadow-sm">Shop now</a></p>
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="./images/banner/banner-slide-1.png" alt="Third slide">
            <div class="carousel-caption d-none d-md-block">
                <p><a href="#" class="btn btn-lg btn-primary shadow-sm">Shop now</a></p>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="category-title">
                <h4>New Arrivals</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="owl-carousel owl-theme">
                <?php
                $url = "http://localhost/mainlandbooks/products/read_all.php";
                $object = $api->curlQueryGet($url);
                $output="";
                foreach ($object->products as $item) {
                    $output .= '
                <div class="item">
                    <div class="card">
                        <div class="img_wrp">
                            <div class="img_text">
                                <div>
                                    <button name="add_to_wlist" id="'.$item->bookId . '" class="btn btm-sm add_to_wlist" 
                                        style="background-color: transparent;"> <i class="fa fa-heart fa-2x"></i>
                                    </button>
                                </div>
                                <div>
                                    <button name="add_to_cart" id="'.$item->bookId . '" class="btn btm-sm add_to_cart" 
                                        style="background-color: transparent"> <i class="fa fa-shopping-cart fa-2x"></i>
                                    </button>
                                </div>
                            </div>
                            <a href="book.php?product='.$item->bookId.'&book='.$item->bookSlug.'">
                                <img data-src="admin/'.$item->image.'" class="img-fluid card-img-top owl-lazy card-img" />
                            </a>
                        </div>
                        <input type="hidden" name="quantity" id="quantity'
                        .$item->bookId . '" class="form-control" value="1">
                        <input type="hidden" name="hidden_name" id="name'
                        .$item->bookId . '"  value="'.$item->bookName.'">
                        <input type="hidden" name="hidden_price" id="price'
                        .$item->bookId . '"  value="'.$item->price.'">
                        <input type="hidden" name="hidden_image" id="image'
                        .$item->bookId . '"  value="'.$item->image.'">
                        <div class="card-body">
                            <a href="book.php?product='.$item->bookId.'&book='.$item->bookSlug.'">
                            <h6 class="card-title">'.
                        (strlen($item->bookName) > 49 ? $fn->textShorten($item->bookName, 50) : $item->bookName)
                        .'</h6></a>
                            <div class="book-tile" style="text-align: center">
                                <p>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i><br />
                                    <span class="book-price">₦'.number_format($item->price, 0).'</span>
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
                ';
                }
                echo $output;
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <hr />
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="category-title">
                <h4>Coming Soon</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="owl-carousel owl-theme">
                <div class="item">
                    <div class="card">
                        <div class="img_wrp">
                            <div class="img_text">
                                <div><button class="btn btm-sm add_to_wlist" style="background-color: transparent;"> <i class="fa fa-heart fa-2x"></i></button></div>
                                <div><button class="btn btm-sm add_to_cart" style="background-color: transparent;"> <i class="fa fa-shopping-cart fa-2x"></i></button>
                                </div>
                            </div>
                            <img data-src="images/Mask Group (2).png"
                                 class="img-fluid card-img-top owl-lazy card-img">
                        </div>
                        <div class="card-body">
                            <h6 class="card-title">HOW TO STUDY SMART</h6>

                            <div class="book-tile" style="text-align: center">
                                <p>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i><br />
                                    <span class="book-price">₦1000</span>
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <hr />
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="category-title">
                <h4>Best Sellers</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="owl-carousel owl-theme">
                <div class="item">
                    <div class="card">
                        <div class="img_wrp">
                            <div class="img_text">
                                <div><button class="btn btm-sm add_to_wlist" style="background-color: transparent;"> <i class="fa fa-heart fa-2x"></i></button></div>
                                <div><button class="btn btm-sm add_to_cart" style="background-color: transparent;"> <i class="fa fa-shopping-cart fa-2x"></i></button>
                                </div>
                            </div>
                            <img data-src="images/MaskGroup.png"
                                 class="img-fluid card-img-top owl-lazy card-img">
                        </div>
                        <div class="card-body">
                            <h6 class="card-title">HOW TO STUDY SMART</h6>

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
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <hr />
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="category-title">
                <h4>Featured Books</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="owl-carousel owl-theme">
                <?php
                $url = "http://localhost/mainlandbooks/products/read_featured.php";
                $object = $api->curlQueryGet($url);
                $output="";
                foreach ($object->products as $item) {
                    $output .= '
                <div class="item">
                    <div class="card">
                        <div class="img_wrp">
                            <div class="img_text">
                                <div>
                                    <button name="add_to_wlist" id="'.$item->bookId . '" class="btn btm-sm add_to_wlist" 
                                        style="background-color: transparent;"> <i class="fa fa-heart fa-2x"></i>
                                    </button>
                                </div>
                                <div>
                                    <button name="add_to_cart" id="'.$item->bookId . '" class="btn btm-sm add_to_cart" 
                                        style="background-color: transparent"> <i class="fa fa-shopping-cart fa-2x"></i>
                                    </button>
                                </div>
                            </div>
                            <img data-src="admin/'.$item->image.'" class="img-fluid card-img-top owl-lazy card-img" />
                        </div>
                        <input type="hidden" name="quantity" id="quantity'
                        .$item->bookId . '" class="form-control" value="1">
                        <input type="hidden" name="hidden_name" id="name'
                        .$item->bookId . '"  value="'.$item->bookName.'">
                        <input type="hidden" name="hidden_price" id="price'
                        .$item->bookId . '"  value="'.$item->price.'">
                        <input type="hidden" name="hidden_image" id="image'
                        .$item->bookId . '"  value="'.$item->image.'">
                        <div class="card-body">
                            <h6 class="card-title">'.
                    (strlen($item->bookName) > 49 ? $fn->textShorten($item->bookName, 50) : $item->bookName)
                    .'</h6>
                            <div class="book-tile" style="text-align: center">
                                <p>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i><br />
                                    <span class="book-price">₦'.number_format($item->price, 0).'</span>
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
                ';
                }
                echo $output;
                ?>
            </div>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>