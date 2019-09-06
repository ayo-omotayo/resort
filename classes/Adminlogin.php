<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Session.php');
Session::checkLogin();
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
?>

<?php
    class Adminlogin {

        private $db;
        private $fn;

        public function __construct() {
            $this->db = new Database();
            $this->fn = new Format();
        }

        public function adminLogin($adminUser, $adminPass) {
            $adminUser = $this->fn->validation($adminUser);
            $adminPass = $this->fn->validation($adminPass);

            $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
            $adminPass = mysqli_real_escape_string($this->db->link, md5($adminPass));

            if(empty($adminUser) || empty($adminPass)) {
                $loginmsg = "User name or Password must no be empty";
                return $loginmsg;
            } else {
                $query = "SELECT * FROM tbl_admin WHERE adminUser='$adminUser' AND adminPass='$adminPass'";
                $result = $this->db->select($query);
                if($result) {
                    $value = $result->fetch_assoc();
                    Session::set("adminlogin", true);
                    Session::set("adminId", $value['adminId']);
                    Session::set("adminUser", $value['adminUser']);
                    Session::set("adminName", $value['adminName']);
                    header("location: dashboard.php");
                } else {
                    $loginmsg = "Username or password not match";
                    return $loginmsg;
                }
            }
        }
    }

?>