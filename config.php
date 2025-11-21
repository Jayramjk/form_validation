<?php 

class Edit_Form{

    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "form_validation";

    public $conn;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        $this->conn = new mysqli(
            $this->host,
            $this->user,
            $this->pass,
            $this->dbname
        );

        if ($this->conn->connect_error) {
            die("DB Connection Failed: " . $this->conn->connect_error);
        }
    }

    
}

$conn = new mysqli("localhost", "root", "", "form_validation");
?>