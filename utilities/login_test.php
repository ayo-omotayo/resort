<?php include_once 'utilities/autoload.php'; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
    $url = 'http://localhost/mainlandbooks/customers/signin.php';
    $post_data = array(
        'email' => $_POST['email'],
        'password' => $_POST['password']
    );
    $arr = $api->curlQueryPost($url,$post_data);

    if ($arr->status === true) {
        Session::set("cmrName",$arr->name);
        Session::set("cmrEmail",$arr->email);
        Session::set("cmrPhone",$arr->phone);
        Session::set("cmrId",$arr->cmrId);
        Session::set("cmrLogin",true);
        header('Location: 404.php');
    } else {
        $loginMsg = $arr->message;
    }
}
?>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $url = 'http://localhost/mainlandbooks/customers/signup.php';
    $post_data = array(
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'password' => $_POST['password'],
    );
    $arr = $api->curlQueryPost($url,$post_data);
    if ($arr->status === true) {
        $msg = $msg = $arr->message;
    } else {
        $msg = $arr->message;
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
    <title>Document</title>
</head>
<body>
<div style="display: inline-flex">
<div style="border: 2px solid #c4c4c4; padding: 25px; margin: 10px; width: 300px;">
    <h2>Login</h2>
    <?php if (isset($loginMsg)) echo $loginMsg; ?>
    <form action=" " method="post">
    <input type="text" name="email" id="email"> <br> <br>
    <input type="text" name="password" id="password"> <br><br>
        <button name="login"> login</button> <br>
    </form>
</div>

<div style="border: 2px solid #c4c4c4; padding: 25px; margin: 10px">
    <h2>SignUp</h2>
    <?php if (isset($msg)) echo $msg; ?>
    <form action=" " method="post">
        <input type="text" name="name" id="name" > <br><br>
        <input type="text" name="email" id="email" > <br><br>
        <input type="text" name="phone" id="phone" > <br><br>
        <input type="text" name="password" id="password" > <br><br>
        <button name="register"> Signup</button> <br>
    </form>
</div>
</div>
</body>
</html>
