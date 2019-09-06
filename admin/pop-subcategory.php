<?php

$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/Database.php');
include_once($filepath . '/../helpers/Format.php');

if (isset($_GET['catId'])) {
    $db = new Database();
    $sql = "SELECT * FROM tbl_subcategory WHERE catId='". $_GET['catId']."'";
    $result = $db->select($sql);
    if ($result) {
        echo "<option>Select Subcategory</option>";
        while ($array = $result->fetch_array()) {
            echo "<option value='".$array['subCatId']."'>" . $array['subCatName'] . "</option>";
        }
    } else {
        echo "<option>select a valid category</option>";
    }

}


?>