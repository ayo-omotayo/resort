<?php
    include_once 'utilities/autoload.php';
    $cmrId = Session::get("cmrId");

    if (isset($_POST['action'])) {

        if ($_POST['action'] =="add") {
            if (isset($_SESSION['shopping_cart'])) {
                $is_available = 0;
                foreach ($_SESSION['shopping_cart'] as $keys => $values) {
                    if($_SESSION["shopping_cart"][$keys]["bookCartId"] == $_POST["bookCartId"]) {
                        $is_available++;
                        $_SESSION["shopping_cart"][$keys]["bookQuantity"] =
                            $_SESSION["shopping_cart"][$keys]["bookQuantity"] + $_POST["bookQuantity"];
                    }
                }
                if ($is_available == 0) {
                    $item_array = array(
                        'bookCartId'      => $_POST['bookCartId'],
                        'bookCartName'    => $_POST['bookCartName'],
                        'bookCartImage'    => $_POST['bookCartImage'],
                        'bookPrice'       => $_POST['bookPrice'],
                        'bookQuantity'    => $_POST['bookQuantity']
                    );
                    $_SESSION["shopping_cart"][] = $item_array;
                }
            } else {
                $item_array = array(
                  'bookCartId'      => $_POST['bookCartId'],
                  'bookCartName'    => $_POST['bookCartName'],
                  'bookCartImage'    => $_POST['bookCartImage'],
                  'bookPrice'       => $_POST['bookPrice'],
                  'bookQuantity'    => $_POST['bookQuantity']
                );
                $_SESSION["shopping_cart"][] = $item_array;
            }
        }

        if ($_POST['action'] == "add_wlist") {
            if (isset($_SESSION['cmrLogin']) && $_SESSION['cmrLogin'] == true ) {
                $pid = $_POST['bookCartId'];
                $wlistInsertData = $pd->saveWishListData($pid, $cmrId);
                if($wlistInsertData == "exist") { echo "exist"; }
                else if ($wlistInsertData == "true") { echo "insertedTrue"; }
            } else {
                echo "loginError";
            }
        }

        if ($_POST['action'] =="add_qty") {
            if (isset($_POST['bookQuantity']) && $_POST['bookQuantity']>0) {

                if (isset($_SESSION['shopping_cart'])) {
                    $is_available = 0;
                    foreach ($_SESSION['shopping_cart'] as $keys => $values) {
                        if ($_SESSION["shopping_cart"][$keys]["bookCartId"] == $_POST["bookCartId"]) {
                            $is_available++;
                            $_SESSION["shopping_cart"][$keys]["bookQuantity"] =
                                $_SESSION["shopping_cart"][$keys]["bookQuantity"] + 1;
                        }
                    }
                    if ($is_available == 0) {
                        $item_array = array(
                            'bookCartId' => $_POST['bookCartId'],
                            'bookPrice' => $_POST['bookPrice'],
                            'bookQuantity' => $_POST['bookQuantity']
                        );
                        $_SESSION["shopping_cart"][] = $item_array;
                    }
                } else {
                    $item_array = array(
                        'bookCartId' => $_POST['bookCartId'],
                        'bookPrice' => $_POST['bookPrice'],
                        'bookQuantity' => $_POST['bookQuantity']
                    );
                    $_SESSION["shopping_cart"][] = $item_array;
                }
            }
        }

        if ($_POST['action'] =="minus_qty") {
            if (isset($_POST['bookQuantity']) && $_POST['bookQuantity'] >1) {
                if (isset($_SESSION['shopping_cart'])) {
                    $is_available = 0;
                    foreach ($_SESSION['shopping_cart'] as $keys => $values) {
                        if ($_SESSION["shopping_cart"][$keys]["bookCartId"] == $_POST["bookCartId"]) {
                            $is_available++;
                            $_SESSION["shopping_cart"][$keys]["bookQuantity"] =
                                $_SESSION["shopping_cart"][$keys]["bookQuantity"] - 1;
                        }
                    }
                    if ($is_available == 0) {
                        $item_array = array(
                            'bookCartId' => $_POST['bookCartId'],
                            'bookPrice' => $_POST['bookPrice'],
                            'bookQuantity' => $_POST['bookQuantity']
                        );
                        $_SESSION["shopping_cart"][] = $item_array;
                    }
                } else {
                    $item_array = array(
                        'bookCartId' => $_POST['bookCartId'],
                        'bookPrice' => $_POST['bookPrice'],
                        'bookQuantity' => $_POST['bookQuantity']
                    );
                    $_SESSION["shopping_cart"][] = $item_array;
                }
            } else if ($_POST['bookQuantity'] < 1) {
                foreach ($_SESSION['shopping_cart'] as $keys => $values) {
                    if ($values["bookCartId"] == $_POST["bookCartId"]) {
                        unset($_SESSION["shopping_cart"][$keys]);
                    }
                }
            }
        }

        if ($_POST['action'] =="update") {
            if (isset($_POST['bookQuantity']) && $_POST['bookQuantity'] >=1) {
                if (isset($_SESSION['shopping_cart'])) {
                    $is_available = 0;
                    foreach ($_SESSION['shopping_cart'] as $keys => $values) {
                        if ($_SESSION["shopping_cart"][$keys]["bookCartId"] == $_POST["bookCartId"]) {
                            $is_available++;
                            $_SESSION["shopping_cart"][$keys]["bookQuantity"] = $_POST['bookQuantity'];
                        }
                    }
                    if ($is_available == 0) {
                        $item_array = array(
                            'bookCartId' => $_POST['bookCartId'],
                            'bookPrice' => $_POST['bookPrice'],
                            'bookQuantity' => $_POST['bookQuantity']
                        );
                        $_SESSION["shopping_cart"][] = $item_array;
                    }
                } else {
                    $item_array = array(
                        'bookCartId' => $_POST['bookCartId'],
                        'bookPrice' => $_POST['bookPrice'],
                        'bookQuantity' => $_POST['bookQuantity']
                    );
                    $_SESSION["shopping_cart"][] = $item_array;
                }
            } else if ($_POST['bookQuantity'] < 1) {
                foreach ($_SESSION['shopping_cart'] as $keys => $values) {
                    if ($values["bookCartId"] == $_POST["bookCartId"]) {
                        unset($_SESSION["shopping_cart"][$keys]);
                    }
                }
            }
        }

        if ($_POST['action'] =="remove") {
            foreach ($_SESSION['shopping_cart'] as $keys => $values) {
                if ($values["bookCartId"] == $_POST["bookCartId"]) {
                    unset($_SESSION["shopping_cart"][$keys]);
                }
            }
        }

        if ($_POST['action'] =="empty") {
            unset($_SESSION["shopping_cart"]);
        }

    }

    if (isset($_POST['save_review'])) {
        $url = 'http://localhost/mainlandbooks/products/review.php';
        $post_data = array(
            'bookId' => trim($_POST['bookId']),
            'name' => trim($_POST['name']),
            'ratedIndex' => trim($_POST['ratedIndex'] + 1),
            'comment' => trim($_POST['comment'])
        );
        $arr = $api->curlQueryPost($url, $post_data);
        if ($arr->status === true) {
            echo "true";
        } else {
            echo "error";
        }

    }

?>