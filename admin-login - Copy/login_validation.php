<?php
require_once "../config.php";  // your DB connection file

class Auth {
    private $conn;

    public function __construct(){
        $db = new Edit_Form();
        $this->conn = $db->conn;
    }

    //LOGIN QUERY FUNCTION
    public function checkLogin($username){

        $sql = "SELECT * FROM admin WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s",$username);
        $stmt->execute();
        return $stmt->get_result(); //return result to caller
    }
}
?>


