<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping Cart Test</title>
    <script src="js/jquery.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <style>
        .popover {
            width: 100%;
            max-width: 400px;
        }
        input {
            border: 1px solid #0A246A;
            box-sizing: border-box;
            margin: 0;
            outline: none;
            padding: 10px;
        }

        input[type="button"] {
            -webkit-appearance: button;
            cursor: pointer;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }

        .input-group {
            clear: both;
            margin: 15px 0;
            position: relative;
        }

        .input-group input[type='button'] {
            background-color: #eeeeee;
            min-width: 38px;
            width: auto;
            transition: all 300ms ease;
        }

        .input-group .button-minus,
        .input-group .button-plus {
            font-weight: bold;
            height: 38px;
            padding: 0;
            width: 38px;
            position: relative;
        }

        .input-group .quantity-field {
            position: relative;
            height: 38px;
            left: -6px;
            text-align: center;
            width: 62px;
            display: inline-block;
            font-size: 13px;
            margin: 0 0 5px;
            resize: vertical;
        }

        .button-plus {
            left: -13px;
        }

        input[type="number"] {
            -moz-appearance: textfield;
            -webkit-appearance: none;
        }
    </style>
</head>
<body>
<div class="container">
    <br />
    <h3>PHP Ajax Shopping Cart</h3>
    <br />
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Ayokunle Test</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-cart" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar-cart">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a id="cart-popover" class="nav-link btn" data-placement="bottom" title="Shopping Cart">
                        <i class="fa fa-shopping-cart fa-1x"></i>
                        <span class="badge badge-pill badge-secondary"></span>
                        <span class="total_price">₦0.00</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <div id="popover_content_wrapper" style="display: none;">
        <span id="cart_details"></span>

    </div>