<?php include 'utilities/autoload.php'; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $url = 'http://localhost/mainlandbooks/customers/signin.php';
    $post_data = array(
        'lemail' => $_POST['lemail'],
        'lpassword' => trim($_POST['lpassword'])
    );
    $arr = $api->curlQueryPost($url,$post_data);
    if ($arr->status === true) {
        Session::set("cmrName",$arr->name);
        Session::set("cmrEmail",$arr->email);
        Session::set("cmrId",$arr->cmrId);
        Session::set("cmrSession",$arr->cmrSession);
        Session::set("cmrLogin",true);
        header('Location: success');
    } else {
        $loginMsg = "<p class='text-danger'>". $arr->message."</p>";
    }
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    if($_POST['password'] != $_POST['cpassword']) {
        $msg = "<span class='text-danger'>Password combination do not match</span>";
    } else {
        if (strlen($_POST['password']) < 6) {
            $msg = "<span class='text-danger'>Password must be at least six(6) character</span>";
        } else {
            $url = 'http://localhost/mainlandbooks/customers/signup.php';
            $post_data = array(
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'cpassword' => trim($_POST['cpassword'])
            );
            $arr = $api->curlQueryPost($url, $post_data);
            if ($arr->status === true) {
                $msg = "<span class='text-success'>" . $arr->message . "</span>";
                echo "<script> window.onload = function() { clearform(); } </script>";
            } else {
                $msg = "<span class='text-danger'>" . $arr->message . "</span>";
            }
        }
    }
}
?>
<?php include 'inc/header.php'; ?>
<div class="container registration-page-wrapper">
    <div class="row">
        <div class="col col-lg-6 col-md-5 col-12">
            <div class="card">
                <!-- //////////////////////////////////////////////  -->
                <div class="card-body">
                    <form class="mr-5" id="form" method="post" action=" ">
                        <h5 class="form-title">LOGIN</h5>
                        <?php if (isset($loginMsg)) echo $loginMsg; ?>
                        <div class="form-group">
                            <label for="lemail">Email address</label>
                            <input type="email" class="form-control" id="lemail" name="lemail" value="<?= isset($_POST['lname']) ? $_POST['lname'] : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="lpassword">Password</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" name="lpassword" id="lpassword">
                                <div class="input-group-append">
                                    <button class="btn eye-btn" id="eyeBtn" type="button" onmousedown="pressMouse()" onmouseup="releaseMouse()"><i class="fa fa-eye" id="see-password"></i></button>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="login" id="login" class="btn btn-primary login-btn" style=" width:30%">Login</button>
                    </form>
                </div>
            </div>
        </div>
<!--////////////////////////////////////////////////-->
        <div class="col col-lg-6 col-md-5 col-12 border-left">
            <div class="card">
                <div class="card-body">
                    <form class="ml-3" id="form" method="post" action=" " onsubmit="$('#loading').show(); $('#loadingReg').show();">
                        <h5 class="form-title">SIGN UP</h5>
                        <div id="loading" style="display:none">
                            <span class='text-warning' style='font-size: 18px;'>Please wait we are creating your account</span>
                            <img src='images/gif/loading-arrow.gif' width='40px' height='40px' alt='loading-icon' />
                        </div>
                        <?php if (isset($msg)) echo $msg; ?>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= isset($_POST['name']) ? $_POST['name'] : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : ''; ?>" required>
                            <small class="form-text text-muted">
                                We'll never share your email with anyone else.
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" value="<?= isset($_POST['password']) ? $_POST['password'] : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="cpassword">Confirm Password</label>
                            <input type="password" class="form-control" id="cpassword" name="cpassword" required>
                        </div>
                        <div class="form-group form-check">
                            <label class="form-check-label info">
                                By clicking 'Register' button, you have agreed to the <a href="">Terms and Conditions</a>
                            </label>
                        </div>
                        <button name="register" id="register" type="submit" class="btn btn-primary register-btn" style=" width:30%">
                            <span id="loadingReg" style="display:none">
                                <img src='images/gif/loading-gear.gif' width='25px' height='25px' />
                            </span> Register
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>
<script>
    function clearform() {
        document.getElementById('name').value='';
        document.getElementById('email').value='';
        document.getElementById('password').value='';
    }
</script>