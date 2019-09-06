<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../inc/autoload.php');
?>
<?php
// read the all product order by newly created
if($stmt = $pd->getFeaturedProduct()){
    // products array
    $products_arr=array();
    $products_arr["products"]=array();
    while ($row = mysqli_fetch_array($stmt)){
        $product_item=array(
            "bookId" => $row['bookId'],
            "bookName" => $row['bookName'],
            "bookSlug" => $row['bookSlug'],
            "catId" => $row['catId'],
            "subCatId" => $row['subCatId'],
            "body" => html_entity_decode($row['body']),
            "price" => $row['price'],
            "image" => $row['image'],
            "type" => $row['type'],
        );
        array_push($products_arr["products"], $product_item);
    }

    http_response_code(200);
    echo json_encode($products_arr);
} else{
    http_response_code(404);
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>