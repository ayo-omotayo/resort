<?php
include '../lib/Session.php';
Session::init();
include '../lib/Database.php';
include '../helpers/Format.php';
$db = new Database();
$fn = new Format();
?>
<?php
    if (isset($_GET['email']) && isset($_GET['session-token'])) {
        if (isset($_GET['session-token'])) {
            $token = trim(mysqli_real_escape_string($db->link, $_GET["session-token"]));
            $email = trim(mysqli_real_escape_string($db->link, $_GET["email"]));

            $confirm_login = mysqli_query($db->link, "SELECT * FROM tbl_customer where email='$email' AND token='$token' AND active=1 LIMIT 1");
            if (mysqli_num_rows($confirm_login) < 1) {
                $result = mysqli_query($db->link, "UPDATE tbl_customer set active = '1' WHERE email='$email' AND token='$token'");
                if (!empty($result) && (mysqli_affected_rows($db->link) > 0)) {
                    $result_login = mysqli_query($db->link, "SELECT * FROM tbl_customer where email='$email' AND active=1 LIMIT 1");
                    if (mysqli_num_rows($result_login) > 0) {
                        while ($row = mysqli_fetch_array($result_login, MYSQLI_BOTH)) {
                            Session::set("cmrName", $row['name']);
                            Session::set("cmrEmail", $row['email']);
                            Session::set("cmrLogin", true);
                        }
                        echo "Account activation successful, logging you in ... ";
                        echo "<script>
                            window.onload = function () {
                                toastr.success('Successfully activated, welcome.');
                                setTimeout(function () {
                                    window.location.replace('../success');
                                }, 3000);
                            }
                        </script>";
                    }
                } else {
                    echo $message_error = "<h6>Problem in account activation, kindly enter the correct verification code</h6>";
                    echo "<script>
                            window.onload = function () {
                                toastr.error('Unable to activate account, kindly contact our admin.');
                                setTimeout(function () {
                                    window.location.replace('../index');
                                }, 3000);
                            }
                        </script>";
                }
            } else {
                echo "<script>
                        window.onload = function () {
                            toastr.info('Account already activated. kindly login to proceed');
                            setTimeout(function () {
                                window.location.replace('../login');
                            }, 2000);
                        }
                    </script>";
            }
        }
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mainlandbooks</title>
    <link rel="icon" type="image/png" href="../images/brand-logo.png" sizes="16x16">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/toastr.css">
    <link rel="stylesheet" href="../css/jquery-confirm.min.css">
</head>
<body>

<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="../js/toastr.min.js"></script>
<script src="../js/jquery-confirm.min.js"></script>
</body>
</html>
