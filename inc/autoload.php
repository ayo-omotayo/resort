<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//$filepath = realpath(dirname(__FILE__));

include '../lib/Session.php';
Session::init();
include '../lib/Database.php';
include '../helpers/Format.php';

spl_autoload_register(function($class){
    include_once "../classes/".$class.".php";
});

$db = new Database();
$fn = new Format();
$pd = new Book();
$cat= new Category();
$ct = new Cart();
$cmr = new Customer();

?>