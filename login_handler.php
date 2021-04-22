<?php
require_once 'database.php';
require_once 'user.php';

session_start();

$dao = new Database();
$result = $dao->getUserPassword($_POST['email']);

if(password_verify($_POST['password'], $result["password"])){
   
    $_SESSION['logged_in'] = TRUE;
    $_SESSION['login_error'] = FALSE;
    $row = $dao->getUserByEmail($_POST['email']);
    $_SESSION['user'] = new User($row['accountID'], $_POST['email']);
    header('Location: index.php');
    exit;
}
else{
    $_SESSION['login_error'] = TRUE;
    header("Location: login.php");
    exit;
}


