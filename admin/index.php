<?php include_once '../classes/Adminlogin.php'; ?>
<?php
    $al = new Adminlogin();
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $adminUser = $_POST['adminUser'];
        $adminPass = $_POST['adminPass'];

        $loginChk = $al->adminLogin($adminUser, $adminPass);
    }
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<style>
	.title-image {
		width: 35%;
	}
</style>
<body>
<div class="container">
	<section id="content">
	<img src="img/mbooks.png" alt="mainlandbooks" class="title-image">
		<form action="" method="post">
			<h1>Admin Login</h1>
            <span style="color: red; font-size: 18px;">
                <?php
                    if (isset($loginChk)) {
                        echo $loginChk;
                    }
                ?>
            </span>
			<div>
				<input type="text" placeholder="Username" name="adminUser" />
			</div>
			<div>
				<input type="password" placeholder="Password" name="adminPass"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#" style="color:#049940">@ Copyright Mainlandbooks</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>