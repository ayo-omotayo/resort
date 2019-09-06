<?php

include 'lib/Session.php';
Session::init();
include './lib/Database.php';
include './helpers/Format.php';

spl_autoload_register(function($class){
    include_once "classes/".$class.".php";
});

$db = new Database();
$fn = new Format();
$pd = new Book();
$cat= new Category();
$ct = new Cart();
$cmr = new Customer();
$api = new GlobalApi();

?>