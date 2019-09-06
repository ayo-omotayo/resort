<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../inc/autoload.php');
?>
<?php
$cmr->email = isset($_POST['lemail']) ? $_POST['lemail'] : die();
$cmr->password = isset($_POST['lpassword']) ? md5($_POST['lpassword']) : die();

if(!empty($cmr->email) && !empty($cmr->password)) {
    // create the user
    if ($result=$cmr->customerLogin()) {
        http_response_code(200);
        $user_arr = array(
            "status" => true,
            "message" => "Successfully login",
            "email" => $result['email'],
            "name" => $result['name'],
            "cmrSession" => $result['token'],
            "cmrId" => $result['id']
        );
    } else {
        http_response_code(400);
        $user_arr = array(
            "status" => false,
            "message" => "Invalid Username / Password Combination",
        );
    }
} else {
    http_response_code(400);
    $user_arr = array(
        "status" => false,
        "message" => "Any of the field cannot be empty login"
    );
}
echo json_encode($user_arr);
?>