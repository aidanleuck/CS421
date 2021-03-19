<?php
require_once 'database.php';

session_start();

$dao = new Database();

if($dao->verifyLogin($_POST['email'], $_POST['password'])){
    $_SESSION['logged_in'] = TRUE;
    $_SESSION['login_error'] = FALSE;
    header('Location: index.php');
    exit;
}
else{
    $_SESSION['login_error'] = TRUE;
    header("Location: login.php");
    exit;
}

