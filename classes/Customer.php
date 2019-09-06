<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
?>

<?php

class Customer {
    private $db;
    private $fn;

    public $id;
    public $name;
    public $email;
    public $phone;
    public $password;
    public $cpassword;
    public $token;

    public function __construct() {
        $this->db = new Database();
        $this->fn = new Format();
    }

    public function customerRegistration() {
        if($this->isAlreadyExist()){
            return false;
        }
        // query to insert record
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->password=htmlspecialchars(strip_tags($this->password));

        $query = "INSERT INTO tbl_customer SET
                name='$this->name', password='$this->password', email='$this->email', token='$this->token'";

        if($this->db->insert($query)){
            $sql_fet_cmr="SELECT * FROM tbl_customer WHERE email= '$this->email' LIMIT 1";
            $query_user = mysqli_query($this->db->link, $sql_fet_cmr);
            while($user=mysqli_fetch_assoc($query_user)){
                $toEmail = $user['email'];
                $token = $user['token'];
                $link="https://$_SERVER[HTTP_HOST]"."/mainlandbooks";
                $subject = "Mainlandbooks account activation";
                $content = "<html>
                                <head>
                                    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
                                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                                    <title>Mainlandbooks</title>
                                    <style type='text/css'>
                                        
                                    </style>
                                </head>
                                <body style='width:100% !important;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;'>
                                    <h4>Hello, ".$user['name']."</h4>
                                    click link below to activate your account:
                                    <a href='".$link."/users/auth/index?email=".$toEmail."&session-token=".$token."' style='font-size: 15px; color: blue;'>click here</a>
                                </body>
                                </html>";
                $mailHeaders ="MIME-Version: 1.0"."\r\n";
                $mailHeaders .="Content-type:text/html;charset=UTF-8"."\r\n";
                $mailHeaders .= "From: mainlandbooks <delivery@mainlandbooks.com>\r\n";
                if (mail($toEmail, $subject, $content, $mailHeaders)) {
                    return true;
                }
            }
        }
        return false;
    }

    public function customerLogin() {
        $this->email =htmlspecialchars(strip_tags($this->email));
        $this->password =htmlspecialchars(strip_tags($this->password));

        $query = "SELECT * FROM tbl_customer WHERE email='".$this->email."' AND password='".$this->password."' AND active=1";
        $result = $this->db->select($query);
        if ($result != false) {
            $stmt = $result->fetch_assoc();
            return $stmt;
        }
        return false;
    }

    public function getCustomerData($id) {
        $query = "SELECT * FROM tbl_customer WHERE id='$id' LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function customerProfileUpdate($data, $id) {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $phone       = mysqli_real_escape_string($this->db->link, $data['phone']);
        $email     = mysqli_real_escape_string($this->db->link, $data['email']);
        $address        = mysqli_real_escape_string($this->db->link, $data['address']);
        $city       = mysqli_real_escape_string($this->db->link, $data['city']);
        $zip        = mysqli_real_escape_string($this->db->link, $data['zip']);
        $country        = mysqli_real_escape_string($this->db->link, $data['country']);

        if($name=="" || $phone=="" || $email=="" || $address=="" || $city=="" || $zip=="" ||
            $country=="") {
            $msg = "<span class='error'>Any of the field cannot be empty.</span>";
            return $msg;
        } else {
            $query = "UPDATE tbl_customer SET name='$name',phone='$phone',
                    email='$email',address='$address',city='$city',zip='$zip',
                    country='$country' 
                WHERE  id='$id'";
            $updated_row = $this->db->update($query);

            if ($updated_row) {
                $msg = "<span class='success'>Customer Profile Updated Successfully.</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Unable To Update Customer Profile.</span>";
                return $msg;
            }
        }
    }

    function isAlreadyExist(){
        $query = "SELECT * FROM tbl_customer WHERE email='".$this->email."'";
        $stmt = $this->db->select($query);
        if($stmt){
            return true;
        }
        else {
            return false;
        }
    }

}

?>