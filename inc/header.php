<?php
if(!isset($_SESSION))
{
    include 'lib/Session.php';
    Session::init();
}

    include_once './lib/Database.php';
    include_once './helpers/Format.php';

    spl_autoload_register(function ($class) {
        include_once "classes/" . $class . ".php";
    });

    $db = new Database();
    $fn = new Format();
    $pd = new Book();
    $cat = new Category();
    $ct = new Cart();
    $cmr = new Customer();
    $api = new GlobalApi();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mainlandbooks</title>
    <link rel="icon" type="image/png" href="./images/brand-logo.png" sizes="16x16">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/toastr.css">
    <link rel="stylesheet" href="css/jquery-confirm.min.css">
    <!-- owl css -->
    <link rel="stylesheet" href="css/owl/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl/custom.owl.css">
    <link rel="stylesheet" href="css/owl/owl.theme.default.css">
    <style>
        .popover {
            max-width: 90%;
        }

    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
    <div class="container">
        <a class="navbar-brand brand-logo" href="index"><img src="./images/brand-logo-mobile.png" alt="" class="img-fluid"></a>
        <div class="navbar-collapse" id="navbarSupportedContent">
            <div class="input-group mb-3 col-md-9 col-12">
                <input type="text" class="form-control border-0 bg-light search-input"
                       placeholder="Title, author, keyword...">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary border-0 border-right border-top border-bottom bg-light search-btn"
                            type="button" id="button-addon2"><i class="fa fa-search fa-1x"></i></button>
                </div>
            </div>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">

                    <div class="col-lg-1 col-2 col-sm-2 cart-container">
                        <a id="cart-popover" style="cursor: pointer;" data-placement="bottom" title="Recently added item"><i class="fa fa-cart-plus fa-2x"></i><span class="cart-counter">0</span></a>
                        <div id="popover_content_wrapper" style="display: none;">
                            <span id="cart_details"></span>

                        </div>
                    </div>
                </li>
                <?php
                if (isset($_GET['cmrsession']) && $_GET['cmrsession'] != NULL) {
                    $cmrId = Session::get("cmrId");
                    Session::remove("cmrLogin");
                    Session::remove("cmrId");
                    Session::remove("cmrEmail");
                    Session::remove("cmrSession");
                    header("location: login.php");
                }
                ?>
                <li class="nav-item dropdown account-dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                        My Account
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php
                            $cmrEmail = Session::get("cmrEmail");
                            $login = Session::get("cmrLogin");
                            if($login == false) {
                        ?>
                            <a class="dropdown-item" href="login">Login/Signup</a>
                        <?php } else { ?>
                                <a class="dropdown-item" href="profile">Profile</a>
                        <?php } ?>
                        <a class="dropdown-item" href="#">Make a Book Request</a>
                        <?php
                            if($login != false) {
                        ?>
                            <a class="dropdown-item" href="#">Wishlist</a>
                            <a class="dropdown-item" href="?cmrsession=<?php echo Session::get('cmrSession')?>">Logout</a>
                        <?php } ?>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<ul class="nav justify-content-center border-top category-nav">
    <li class="nav-ite pop" data-container="body" data-toggle="popover" data-placement="bottom"
        data-content='
        <div class="container">
            <div class="row">

                <div class="col">
                        <ul class="fiction-literature-list">
                            <li><a href="" class="dropdown-item">Graphic Novels and Comic</a></li>
                            <li><a href="" class="dropdown-item">Literature</a></li>
                            <li><a href="" class="dropdown-item">Mystery & Crime</a></li>
                            <li><a href="" class="dropdown-item">Poetry</a></li>
                            <li><a href="" class="dropdown-item">Romance</a></li>
                            <li><a href="" class="dropdown-item">Thrillers</a></li>
                        </ul>
                </div>

            </div>
        </div>' data-original-title="" title="">
        <a class="nav-link active" href="#">FICTION & LITERATURE</a>
    </li>
    <li class="nav-ite pop" data-container="body" data-toggle="popover" data-placement="bottom" data-content='<div class="container-fluid">
            <div class="row">
                <div class="col-3"><a href="" class="dropdown-item">Activity and Game Books</a></div>
                <div class="col-3"><a href="" class="dropdown-item">Art, Architecture & Photography</a></div>
                <div class="col-3"><a href="" class="dropdown-item">Bibles and Christianity</a></div>
                <div class="col-3"><a href="" class="dropdown-item">Biography, Autobiography and True Stories</a></div>
                <div class="col-3"><a href="" class="dropdown-item">Business Books</a></div>
                <div class="col-3"><a href="" class="dropdown-item">Computers</a></div>
                <div class="col-3"><a href="" class="dropdown-item">Psychology</a></div>
                <div class="col-3"><a href="" class="dropdown-item">Science & Technology</a></div>
                <div class="col-3"><a href="" class="dropdown-item">Cookbooks, Food and Wine</a></div>
                <div class="col-3"><a href="" class="dropdown-item">Craft and Hobbies</a></div>
                <div class="col-3"><a href="" class="dropdown-item">Current Affairs and Politics</a></div>
                <div class="col-3"><a href="" class="dropdown-item">Diet, Health & Fitness</a></div>
                <div class="col-3"><a href="" class="dropdown-item">Education</a></div>
                <div class="col-3"><a href="" class="dropdown-item">Engineering</a></div>
                <div class="col-3"><a href="" class="dropdown-item">Social Sciences</a></div>
                <div class="col-3"><a href="" class="dropdown-item">Environment</a></div>
                <div class="col-3"><a href="" class="dropdown-item">Fashion</a></div>
                <div class="col-3"><a href="" class="dropdown-item">Foreign Languages</a></div>
                <div class="col-3"><a href="" class="dropdown-item">Study Aids and Test Prep</a></div>
                <div class="col-3"><a href="" class="dropdown-item">Home and Gardens</a></div>
                <div class="col-3"><a href="" class="dropdown-item">Self-Help and Relationships</a></div>
                <div class="col-3"><a href="" class="dropdown-item">Role-Playing & Fantasy Games</a></div>
                <div class="col-3"><a href="" class="dropdown-item">Law</a></div>
                <div class="col-3"><a href="" class="dropdown-item">Medicine and Nursing Books</a></div>
                <div class="col-3"><a href="" class="dropdown-item">Music, Film & Performing Arts</a></div>
                <div class="col-3"><a href="" class="dropdown-item">Nature</a></div>
                <div class="col-3"><a href="" class="dropdown-item">Parenting & Family</a></div>
                <div class="col-3"><a href="" class="dropdown-item">Pets</a></div>
                <div class="col-3"><a href="" class="dropdown-item">Philosophy</a></div>
                <div class="col-3"><a href="" class="dropdown-item">Transportation</a></div>
                <div class="col-3"><a href="" class="dropdown-item">Travel</a></div>
                <div class="col-3"><a href="" class="dropdown-item">True Crime</a></div>
                <div class="col-3"><a href="" class="dropdown-item">Humour</a></div>
                <div class="col-3"><a href="" class="dropdown-item">History</a></div>
                <div class="col-3"><a href="" class="dropdown-item">Religion</a></div>
                </div>
        </div>' data-original-title="" title="">
        <a class="nav-link" href="#">NONFICTION</a>
    </li>
    <li class="nav-ite pop" data-container="body" data-toggle="popover" data-placement="bottom" data-content='<div class="container">
            <div class="row">
                <div class="col-2"><a href="" class="dropdown-item">Business</a></div>
                <div class="col-2"><a href="" class="dropdown-item">Calculus</a></div>
                <div class="col-2"><a href="" class="dropdown-item">Literature</a></div>
                <div class="col-2"><a href="" class="dropdown-item">Philosophy</a></div>
                <div class="col-2"><a href="" class="dropdown-item">Science</a></div>
                <div class="col-2"><a href="" class="dropdown-item">Algebra</a></div>
                <div class="col-2"><a href="" class="dropdown-item">Chemistry</a></div>
                <div class="col-2"><a href="" class="dropdown-item">Education</a></div>
                <div class="col-2"><a href="" class="dropdown-item">Medicine</a></div>
                <div class="col-2"><a href="" class="dropdown-item">Sociology</a></div>
                <div class="col-2"><a href="" class="dropdown-item">Architecture</a></div>
                <div class="col-2"><a href="" class="dropdown-item">Computer</a></div>
                <div class="col-2"><a href="" class="dropdown-item">Engineering</a></div>
                <div class="col-2"><a href="" class="dropdown-item">Mathematics</a></div>
                <div class="col-2"><a href="" class="dropdown-item">Psychology</a></div>
                <div class="col-2"><a href="" class="dropdown-item">Test Preparation</a></div>
                <div class="col-2"><a href="" class="dropdown-item">Art History</a></div>
                <div class="col-2"><a href="" class="dropdown-item">Design</a></div>
                <div class="col-2"><a href="" class="dropdown-item">History</a></div>
                <div class="col-2"><a href="" class="dropdown-item">Music</a></div>
                <div class="col-2"><a href="" class="dropdown-item">Reference</a></div>
                <div class="col-2"><a href="" class="dropdown-item">Biology</a></div>
                <div class="col-2"><a href="" class="dropdown-item">Economics</a></div>
                <div class="col-2"><a href="" class="dropdown-item">Law</a></div>
                <div class="col-2"><a href="" class="dropdown-item">Nursing</a></div>
                <div class="col-2"><a href="" class="dropdown-item">Religion</a></div>
                <div class="col-2"><a href="" class="dropdown-item">Politics & Current</a></div>
            </div>

        </div>' data-original-title="" title="">
        <a class="nav-link" href="#">TEXTBOOKS</a>
    </li>
    <li class="nav-ite pop" data-container="body" data-toggle="popover" data-placement="bottom" data-content='<div class="container">
            <div class="row">
                <div class="col">
                    <ul>
                        <li><h5 style="color: #5E5E5E;"><u>Age Group</u></h5></li>
                        <li><a href="" class="dropdown-item">Baby & Toddler</a></li>
                        <li><a href="" class="dropdown-item">Age 5 to 8</a></li>
                        <li><a href="" class="dropdown-item">Age 9 to 12</a></li>
                        <li><a href="" class="dropdown-item">Teenage/Young Adults</a></li>
                        <li><a href="" class="dropdown-item">Philosophy</a></li>
                        <li><a href="" class="dropdown-item">Science</a></li>
                    </ul>
                </div>
                <div class="col">
                    <ul>
                        <li><h5 style="color: #5E5E5E;"><u>Popular Categories</u></h5></li>
                        <li><a href="" class="dropdown-item">Early Learning</a></li>
                        <li><a href="" class="dropdown-item">Children Fiction</a></li>
                        <li><a href="" class="dropdown-item">Comics</a></li>
                        <li><a href="" class="dropdown-item">Hobbies and Interest</a></li>
                        <li><a href="" class="dropdown-item">Interactive & Activity Books</a></li>
                        <li><a href="" class="dropdown-item">Learning & Education</a></li>
                        <li><a href="" class="dropdown-item">Poetry & Anthologies</a></li>
                    </ul>
                </div>
            </div>
        </div>' data-original-title="" title="">
        <a class="nav-link" href="#">KIDS</a>
    </li>
</ul>
<nav class="navbar navbar-expand-lg navbar-light bg-light d-lg-none">
    <a class="navbar-brand mobile-navbar-brand" href="#"><span class="first-word">Mainland</span><span class="second-word">Books</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        Categories
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    FICTION & LITERATURE
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <ul class="fiction-literature-list">
                        <li><a href="" class="dropdown-item">Graphic Novels and Comic</a></li>
                        <li><a href="" class="dropdown-item">Literature</a></li>
                        <li><a href="" class="dropdown-item">Mystery & Crime</a></li>
                        <li><a href="" class="dropdown-item">Poetry</a></li>
                        <li><a href="" class="dropdown-item">Romance</a></li>
                        <li><a href="" class="dropdown-item">Thrillers</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    NONFICTION
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <ul>
                        <li><a href="" class="dropdown-item">Activity and Game Books</a></li>
                        <li><a href="" class="dropdown-item">Art, Architecture & Photography</a></li>
                        <li><a href="" class="dropdown-item">Bibles and Christianity</a></li>
                        <li><a href="" class="dropdown-item">Biography, Autobiography and True Stories</a></li>
                        <li><a href="" class="dropdown-item">Business Books</a></li>
                        <li><a href="" class="dropdown-item">Computers</a></li>
                        <li><a href="" class="dropdown-item">Psychology</a></li>
                        <li><a href="" class="dropdown-item">Science & Technology</a></li>
                        <li><a href="" class="dropdown-item">Cookbooks, Food and Wine</a></li>
                        <li><a href="" class="dropdown-item">Craft and Hobbies</a></li>
                        <li><a href="" class="dropdown-item">Current Affairs and Politics</a></li>
                        <li><a href="" class="dropdown-item">Diet, Health & Fitness</a></li>
                        <li><a href="" class="dropdown-item">Education</a></li>
                        <li><a href="" class="dropdown-item">Engineering</a></li>
                        <li><a href="" class="dropdown-item">Social Sciences</a></li>
                        <li><a href="" class="dropdown-item">Environment</a></li>
                        <li><a href="" class="dropdown-item">Fashion</a></li>
                        <li><a href="" class="dropdown-item">Foreign Languages</a></li>
                        <li><a href="" class="dropdown-item">Study Aids and Test Prep</a></li>
                        <li><a href="" class="dropdown-item">Home and Gardens</a></li>
                        <li><a href="" class="dropdown-item">Self-Help and Relationships</a></li>
                        <li><a href="" class="dropdown-item">Role-Playing & Fantasy Games</a></li>
                        <li><a href="" class="dropdown-item">Law</a></li>
                        <li><a href="" class="dropdown-item">Medicine and Nursing Books</a></li>
                        <li><a href="" class="dropdown-item">Music, Film & Performing Arts</a></li>
                        <li><a href="" class="dropdown-item">Nature</a></li>
                        <li><a href="" class="dropdown-item">Parenting & Family</a></li>
                        <li><a href="" class="dropdown-item">Pets</a></li>
                        <li><a href="" class="dropdown-item">Philosophy</a></li>
                        <li><a href="" class="dropdown-item">Transportation</a></li>
                        <li><a href="" class="dropdown-item">Travel</a></li>
                        <li><a href="" class="dropdown-item">True Crime</a></li>
                        <li><a href="" class="dropdown-item">Humour</a></li>
                        <li><a href="" class="dropdown-item">History</a></li>
                        <li><a href="" class="dropdown-item">Religion</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    TEXTBOOKS
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <ul>
                        <li><a href="" class="dropdown-item">Accounting & Finance</a></li>
                        <li><a href="" class="dropdown-item">Business</a></li>
                        <li><a href="" class="dropdown-item">Calculus</a></li>
                        <li><a href="" class="dropdown-item">Literature</a></li>
                        <li><a href="" class="dropdown-item">Philosophy</a></li>
                        <li><a href="" class="dropdown-item">Science</a></li>
                        <li><a href="" class="dropdown-item">Algebra</a></li>
                        <li><a href="" class="dropdown-item">Chemistry</a></li>
                        <li><a href="" class="dropdown-item">Education</a></li>
                        <li><a href="" class="dropdown-item">Medicine</a></li>
                        <li><a href="" class="dropdown-item">Politics & Current Affairs</a></li>
                        <li><a href="" class="dropdown-item">Sociology</a></li>
                        <li><a href="" class="dropdown-item">Architecture</a></li>
                        <li><a href="" class="dropdown-item">Computer</a></li>
                        <li><a href="" class="dropdown-item">Engineering</a></li>
                        <li><a href="" class="dropdown-item">Mathematics</a></li>
                        <li><a href="" class="dropdown-item">Psychology</a></li>
                        <li><a href="" class="dropdown-item">Test Preparation</a></li>
                        <li><a href="" class="dropdown-item">Art History</a></li>
                        <li><a href="" class="dropdown-item">Design</a></li>
                        <li><a href="" class="dropdown-item">History</a></li>
                        <li><a href="" class="dropdown-item">Music</a></li>
                        <li><a href="" class="dropdown-item">Reference</a></li>
                        <li><a href="" class="dropdown-item">Biology</a></li>
                        <li><a href="" class="dropdown-item">Economics</a></li>
                        <li><a href="" class="dropdown-item">Law</a></li>
                        <li><a href="" class="dropdown-item">Nursing</a></li>
                        <li><a href="" class="dropdown-item">Religion</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    KIDS
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <ul>
                        <li><h5 style="color: #5E5E5E;"><u>Age Group</u></h5></li>
                        <li><a href="" class="dropdown-item">Baby & Toddler</a></li>
                        <li><a href="" class="dropdown-item">Age 5 to 8</a></li>
                        <li><a href="" class="dropdown-item">Age 9 to 12</a></li>
                        <li><a href="" class="dropdown-item">Teenage/Young Adults</a></li>
                        <li><a href="" class="dropdown-item">Philosophy</a></li>
                        <li><a href="" class="dropdown-item">Science</a></li>
                        <li><h5 style="color: #5E5E5E;"><u>Popular Categories</u></h5></li>
                        <li><a href="" class="dropdown-item">Early Learning</a></li>
                        <li><a href="" class="dropdown-item">Children Fiction</a></li>
                        <li><a href="" class="dropdown-item">Comics</a></li>
                        <li><a href="" class="dropdown-item">Hobbies and Interest</a></li>
                        <li><a href="" class="dropdown-item">Interactive & Activity Books</a></li>
                        <li><a href="" class="dropdown-item">Learning & Education</a></li>
                        <li><a href="" class="dropdown-item">Poetry & Anthologies</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>

