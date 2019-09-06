<?php include_once 'utilities/autoload.php';?>
<?php include_once 'inc/header.php';?>
<?php
$login = Session::get("cmrLogin");
//if($login != false) { header("location: login.php"); }
?>
<style>
    .notfound{}
    .notfound h2{font-size: 80px; line-height: 130px; text-align: center}
    .notfound h2 span{display: block; color: darkred; font-size: 150px}
</style>
<div class="main">
    <div class="content">

        <div class="section group">
            <div class="notfound">
                <h2><span>404</span> Not Found </h2>
                <h3><?php echo Session::get("cmrName")?></h3>
                <h3><?php echo Session::get("cmrEmail")?></h3>
                <h3><?php echo Session::get("cmrPhone")?></h3>
                <h3><?php echo Session::get("cmrId")?></h3>
            </div>
        </div>

        <div class="clear">

        </div>
    </div>
</div>
<?php
if (isset($_GET['cid']) && $_GET['cid'] != NULL) {
    Session::remove("name");
    Session::remove("cmrLogin");
    Session::remove("email");
    Session::remove("phone");
    header("location: login.php");
}
?>
<div>
    <?php
    $login = Session::get("cmrLogin");
    if($login == false) {
        ?>
        <a href="login.php">Login</a>
        <?php
    } else {
        ?>
        <a href="?cid=true">Logout</a>
        <?php
    }
    ?>
</div>


<?php include_once 'inc/footer.php';?>
