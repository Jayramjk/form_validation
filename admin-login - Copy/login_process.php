<?php
session_start();
          
require_once "login_validation.php";  // Function file

// Get form values
$username = $_POST['username'] ?? "";
$password = $_POST['password'] ?? "";

//create object
$auth = new Auth();

//call function inside class
$result = $auth->checkLogin($username);

//conditions here
if ($result->num_rows ===1){

    $row = $result->fetch_assoc();

    if (password_verify($password,$row['password'])){

        $_SESSION['admin'] = $row['username'];

        // redirect to admin folder
        header("Location: ../admin.php");
        exit();
    }else {
        $_SESSION['error'] = "Incorrect password!";
        header("Location: login.php");
        exit();
    }

}   else {
    $_SESSION['error'] = "Admin not found!";
    header("Location: login.php");
    exit();
}



