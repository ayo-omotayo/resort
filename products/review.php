<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../inc/autoload.php');
?>
<?php
$pd->bookId = isset($_POST['bookId']) ? $_POST['bookId'] : die();
$pd->cName = isset($_POST['name']) ? $_POST['name'] : die();
$pd->ratedIndex = isset($_POST['ratedIndex']) ? $_POST['ratedIndex'] : die();
$pd->comment = isset($_POST['comment']) ? $_POST['comment'] : die();
//$data = json_decode(file_get_contents("php://input"));

if(!empty($pd->bookId) && !empty($pd->cName) && !empty($pd->ratedIndex) && !empty($pd->comment)) {
// create the review rating
    if ($pd->reviewRating()) {
        http_response_code(200);
        $review_arr = array(
            "status" => true,
            "message" => "Feedback received. We are glad you did this, thanks.",
            "cName" => $pd->cName
        );
    } else {
        http_response_code(400);
        $review_arr = array(
            "status" => false,
            "message" => "Review no submitted, try again later."
        );
    }
} else {
    http_response_code(400);
    $review_arr = array(
        "status" => false,
        "message" => "Any of the field cannot be empty."
    );
}
echo json_encode($review_arr);
?>