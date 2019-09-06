<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../inc/autoload.php');
?>
<?php
$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
function generate_string($input, $strength = 16) {
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    } return $random_string;
}
$token_generated = generate_string($permitted_chars, 25);

$cmr->name = isset($_POST['name']) ? $_POST['name'] : die();
$cmr->email = isset($_POST['email']) ? $_POST['email'] : die();
$cmr->token = $token_generated;
$cmr->password = isset($_POST['password']) ? md5($_POST['password']) : die();
$cmr->cpassword = isset($_POST['cpassword']) ? md5($_POST['cpassword']) : die();
//$data = json_decode(file_get_contents("php://input"));

if(!empty($cmr->name) && !empty($cmr->email) && !empty($cmr->password) && !empty($cmr->cpassword)) {

// create the user
    if ($cmr->customerRegistration()) {
        http_response_code(200);
        $user_arr = array(
            "status" => true,
            "message" => "Account successfully created, kindly check your mail to activate your account.",
            "email" => $cmr->email
        );
    } else {
        http_response_code(400);
        $user_arr = array(
            "status" => false,
            "message" => "Email already exists."
        );
    }
} else {
    http_response_code(400);
    $user_arr = array(
        "status" => false,
        "message" => "Any of the field cannot be empty."
    );
}
echo json_encode($user_arr);
?>