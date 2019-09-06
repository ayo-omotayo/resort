
<?php include 'utilities/autoload.php'; ?>
<?php include 'inc/header.php'; ?>
<?php
if (!isset($_GET['product']) || $_GET['product'] == NULL) {
    echo "<script>window.location = '404.php'; </script>";
}
?>
<?php
$url = "http://localhost/mainlandbooks/products/read_one.php?product=".$_GET['product'];
$object = $api->curlQueryGet($url);
foreach ($object->products as $item) {
?>
<div class="container book-details-wrapper">
    <div class="row mt-5 mb-5">
        <div class="col col-sm-3 col-md-4 col-lg-3 img-container">
            <img src="admin/<?= $item->image; ?>" alt="" />
        </div>
        <div class="col col-sm-9 col-md-9 col-lg-9">
            <div class="card border-0">
                    <div class="card-body">
                        <h5 class="card-title"><?= $item->bookName; ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted">By Rachel Devenish Ford</h6>
                        <table class="table table-sm table-borderless">
                            <tbody>
                            <tr>
                                <td scope="row" width="20%">Price</td>
                                <td id="productPrice">₦<?= number_format($item->price, 0); ?></td>
                            </tr>
                            <tr>
                                <td scope="row">Reviews</td>
                                <td style="color: #EFD54E">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Quantity</td>
                                <td class="qty-update">
                                    <button class="minus" id="<?=$item->bookId; ?>"><span><i class="fa fa-minus"></i></span></button>
                                    <input type="number" value="1" step="1" id="quantity<?= $item->bookId ?>" name="quantity">
                                    <input type="hidden" name="hidden_name" id="name<?= $item->bookId ?>"  value="<?= $item->bookName ?>">
                                    <input type="hidden" name="hidden_price" id="price<?= $item->bookId ?>"  value="<?= $item->price ?>">
                                    <input type="hidden" name="hidden_image" id="image<?= $item->bookId ?>"  value="<?= $item->image ?>">
                                    <button class="add" id="<?=$item->bookId; ?>"><span><i class="fa fa-plus"></i></span></button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="">
                            <span><button class="btn btn-primary btn-lg add-to-cart-btn add_to_cart" name="add_to_cart" id="<?= $item->bookId ?>">Add to
                                    cart</button></span>
                            <span><button class="btn btn-primary btn-lg add_to_wlist" name="add_to_wlist" id="<?= $item->bookId ?>">Add to wishlist</button></span>
                        </div>
                        <p class="card-text">Choose Expedited Shipping at checkout for guaranteed delivery by Wednesday,
                            August 28</p>
                    </div>

            </div>
        </div>
    </div>
</div>

<div class="container mb-3">
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col">
                    <div class="row product-details-tabs">
                        <div class="col">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill"
                                       href="#pills-home" role="tab" aria-controls="pills-home"
                                       aria-selected="true">Overview</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill"
                                       href="#pills-profile" role="tab" aria-controls="pills-profile"
                                       aria-selected="false">Product Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill"
                                       href="#pills-contact" role="tab" aria-controls="pills-contact"
                                       aria-selected="false">Write a Review</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                             aria-labelledby="pills-home-tab">
                            <p><span class="bold-statement">ABOUT THE BOOK:</span> <?= $item->body; ?>
                            </p>
                            <p><span class="bold-statement">ABOUT THE AUTHOR:</span> Malcolm Gladwell is the author of five New York Times bestsellers:
                                The Tipping Point, Blink, Outliers, What the Dog Saw, and David and Goliath. He is the
                                host of the podcast Revisionist History and is a staff writer at The New Yorker. He was
                                named one of the 100 most influential people by Time magazine and one of the Foreign Policy's Top
                                Global Thinkers. Previously, he was a reporter with the Washington Post, where he covered
                                business and science, and then served as the newspaper's New York City bureau chief. He
                                graduated from the University of Toronto, Trinity College, with a degree in history. Gladwell
                                was born in England and grew up in rural Ontario. He lives in New York.
                            </p>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                             aria-labelledby="pills-profile-tab">
                            <table class="table table-sm table-borderless">
                                <tbody>
                                <tr>
                                    <td width="20%">ISBN</td>
                                    <td>9781785176814Z</td>
                                </tr>
                                <tr>
                                    <td width="20%">Publisher</td>
                                    <td>Penguin Books Ltd</td>
                                </tr>
                                <tr>
                                    <td width="20%">Publish date</td>
                                    <td>08/13/2019</td>
                                </tr>
                                <tr>
                                    <td width="20%">Pages</td>
                                    <td>320</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                             aria-labelledby="pills-contact-tab">
                            <div class="container">
                                <div id="review_message"></div>
                                <form id="rateForm" method="post" class="row user-review-form">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="name">Name <span class="text-danger">*</span> </label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Rate <span class="text-danger">*</span></label>
                                            <div class="review-star">
                                                <i class="fa fa-star fa-2x rate" data-index="0"></i>
                                                <i class="fa fa-star fa-2x rate" data-index="1"></i>
                                                <i class="fa fa-star fa-2x rate" data-index="2"></i>
                                                <i class="fa fa-star fa-2x rate" data-index="3"></i>
                                                <i class="fa fa-star fa-2x rate" data-index="4"></i>
                                            </div>
                                            <input type="hidden" name="rating" id="rating">
                                            <input type="hidden" name="bookId" id="bookId" value="<?php echo $_GET['product']; ?>">
                                            <span id="rate_message"></span>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="review">Review <span class="text-danger">*</span></label>
                                            <textarea class="form-control" id="review" name="review" rows="5"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit Review</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <?php
}
?>
<?php include 'inc/footer.php'; ?>
<script>

    $(document).on('click', '.add', function() {
        var bookId = $(this).attr("id");
        var value = parseInt($('#quantity'+bookId).val());
        $('#quantity'+bookId).val(++value);
    });

    $(document).on('click', '.minus', function() {
        var bookId = $(this).attr("id");
        var value = parseInt($('#quantity'+bookId).val());
        if (value<=1) $('#quantity'+bookId).val(1);
        else $('#quantity'+bookId).val(--value);
    });

</script>
<script>
    var ratedIndex = -1;
    var customerID = "";
    $(document).ready(function () {
        resetStarColors();
        if(localStorage.getItem('ratedIndex') != null) {
            // setStars(parseInt(localStorage.getItem('ratedIndex')));
            // bookId = localStorage.getItem('bookId');
        }

        $('.rate').on('click', function () {
            ratedIndex = parseInt($(this).data('index'));
            localStorage.setItem('ratedIndex', ratedIndex);
        });

        $('#rateForm').on('submit', function (e) {
            e.preventDefault();
            $('#rating').val(ratedIndex + 1);
            saveToDB();
        });

        $('.rate').mouseover(function () {
            resetStarColors();
            var currentIndex = parseInt($(this).data('index'));
            if (currentIndex === 0) { $("#rate_message").text('I hate it'); }
            if (currentIndex === 1) { $("#rate_message").text('I don\'t like it'); }
            if (currentIndex === 2) { $("#rate_message").text('I have mixed feelings about it'); }
            if (currentIndex === 3) { $("#rate_message").text('I like it'); }
            if (currentIndex === 4) { $("#rate_message").text('I love it'); }
            setStars(currentIndex);
        });

        $('.rate').mouseleave(function () {
            resetStarColors();
            $("#rate_message").text('');
            if(ratedIndex !== -1) {
                setStars(ratedIndex);
            }
        });
    });

    function saveToDB() {
        var comment = $('#review').val();
        var name = $('#name').val();
        var rating = parseInt($('#rating').val());
        var bookId = parseInt($('#bookId').val());

        if ($.trim(comment)==='' || $.trim(name)==='' || rating < 1) {
            $('#review_message').html('<span class="text-danger">Please fill all required field</span>');
        } else if($.trim(bookId)==='') {
            $('#review_message').html('<span class="text-danger">No product selected</span>');
        } else {
            $.ajax({
                url: "action.php",
                method: "POST",
                dataType: 'json',
                data: {
                    save_review: 1,
                    bookId: bookId,
                    name: name,
                    ratedIndex: ratedIndex,
                    comment: comment,
                }, success: function(data) {
                    if ($.trim(data)==="true") {
                        $('#review_message').html('<span class="text-success">Feedback received. We are glad you did this, thanks.</span>');
                        $('#rateForm').trigger("reset");
                        localStorage.removeItem('ratedIndex');
                    } else {
                        $('#review_message').html('<span class="text-danger">Error occurred,please try again later</span>');
                    }
                }
            });
        }
    }

    function setStars(max) {
        for (var i=0; i <= max; i++)
            $('.rate:eq('+i+')').css('color', '#EFD54E');
    }

    function resetStarColors() {
        $('.rate').css('color', '#dcdcdc');
    }
</script>
